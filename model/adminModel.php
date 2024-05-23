<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

// Insert or update admin
function insertOrUpdateEmployee($id, $firstName, $lastName, $birthdate, $biography, $pwd, $confirmPassword, $avatar, $teamId, $priority, $skills, $actif, $roleActif)
{

    // Check datas received
    $errors = [];
    if (!empty($pwd) && $pwd == $confirmPassword) {
        $pwd = md5($pwd);
        $confirmPassword = $pwd;
    } elseif (empty($pwd) && empty($confirmPassword)) {
        $pwd = $_SESSION['admin']['role']['pwd'];
        $confirmPassword = $pwd;
    } else {
        if (empty($firstName)) {
            $message = "Le prénom est obligatoire";
            $errors[] = $message;
        }
        if (empty($lastName)) {
            $message = "Le nom est obligatoire";
            $errors[] = $message;
        }
        if (empty($birthdate)) {
            $message = "La date de naissance est obligatoire";
            $errors[] = $message;
        }
        if (empty($biography)) {
            $message = "La biographie est obligatoire";
            $errors[] = $message;
        }
        if (empty($teamId)) {
            $message = "Sélection d'une équipe obligatoire";
            $errors[] = $message;
        }
        if (empty($priority)) {
            $message = "Rôle obligatoire";
            $errors[] = $message;
        }
        if (empty($skills)) {
            $message = "Veuillez sélectionner des compétences";
            $errors[] = $message;
        }
        if (empty($pwd)) {
            $errors[] = "Mot de passe requis";
        } elseif (strlen($pwd) < 8) {
            $errors[] = "Mot de passe doit contenir au moins 8 caractères";
        } elseif ($pwd !== $confirmPassword) {
            $errors[] = "Les mots de passe ne correspondent pas";
        } elseif (empty($confirmPassword)) {
            $errors[] = "Veuillez confirmer votre mot de passe";
        }
        if (empty($avatar)) {
            $avatar = $_SESSION['employee']['general']['avatar'];
        }
    }

    // Retrieve db connection
    global $bdd;

    if ($id != null) {
        // Check if employee exists
        $sqlEmployee = "SELECT * FROM `employee` WHERE id = :id";
        $stmtEmployee = $bdd->prepare($sqlEmployee);
        $stmtEmployee->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtEmployee->execute();
        $employee = $stmtEmployee->fetch(PDO::FETCH_ASSOC);

        if ($employee === false) {
            $message = "L'employé n'existe pas";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        // Update employee data
        $sqlEmployee = "UPDATE `employee` SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, biography = :biography, avatar = :avatar, team_id = :team_id, actif = :actif WHERE id = :id";
        $stmtEmployee = $bdd->prepare($sqlEmployee);
        $stmtEmployee->bindParam(":id", $id);
        $stmtEmployee->bindParam(":first_name", $firstName);
        $stmtEmployee->bindParam(":last_name", $lastName);
        $stmtEmployee->bindParam(":birthdate", $birthdate);
        $stmtEmployee->bindParam(":biography", $biography);
        $stmtEmployee->bindParam(":team_id", $teamId, PDO::PARAM_INT);
        $stmtEmployee->bindParam(":avatar", $avatar);
        $stmtEmployee->bindParam(":actif", $actif);
        $stmtEmployee->execute();

        try {
            $stmtEmployee->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des données de l'employé";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        $roleId = $employee['role_id'];

        $querysqlUpdateEmployee = "UPDATE role SET pwd = :pwd, priority = :priority WHERE id = :id";
        $stmtUpdateEmployee = $bdd->prepare($querysqlUpdateEmployee);
        $stmtUpdateEmployee->bindParam(":id", $roleId, PDO::PARAM_INT);
        $stmtUpdateEmployee->bindParam(":pwd", $pwd);
        $stmtUpdateEmployee->bindParam(":priority", $priority);

        try {
            $stmtUpdateEmployee->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des identifiants client";
            $errors[] = $message;
        }

        // First, select the IDs that exist in the table for the current employee
        $stmt = $bdd->prepare("SELECT skill_id FROM characterize WHERE employee_id = :employee_id");
        $stmt->bindParam(':employee_id', $id);
        $stmt->execute();
        $existingIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Loop over the array of IDs
        foreach ($skills as $skill) {
            // If the ID exists in the table, do nothing
            if (in_array($skill, $existingIds)) {
                continue;
            }

            // If the ID doesn't exist in the table, insert it
            $stmt = $bdd->prepare("INSERT INTO characterize (employee_id, skill_id) VALUES (:employee_id, :skill_id)");
            $stmt->bindParam(':employee_id', $id);
            $stmt->bindParam(':skill_id', $skill);
            $stmt->execute();
        }

        // Now, delete IDs from the table that exist in the table but not in the array
        $idsToDelete = array_diff($existingIds, $skills);

        foreach ($idsToDelete as $idToDelete) {
            $stmt = $bdd->prepare("DELETE FROM characterize WHERE employee_id = :employee_id AND skill_id = :skill_id");
            $stmt->bindParam(':employee_id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':skill_id', $idToDelete, PDO::PARAM_INT);
            $stmt->execute();
        }
    } else {
        // Insert user's identifiers
        $querysql = "INSERT INTO role (priority, pwd, created_at, actif) VALUES (:priority, :pwd, :created_at, :actif)";

        // Prepare SQL request
        $stmtRole = $bdd->prepare($querysql);

        // BindParam
        $stmtRole->bindParam(":priority", $priority);
        $stmtRole->bindParam(":pwd", $pwd);
        $stmtRole->bindValue(":created_at", date("Y/m/d"));
        $stmtRole->bindValue(":actif", $roleActif);

        // Execute SQL request
        try {
            $stmtRole->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de l'insertion du rôle";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        // Retrieve last record
        $sqlLastUser = "SELECT id FROM role ORDER BY id DESC LIMIT 1";
        $stmtUser = $bdd->prepare($sqlLastUser);
        $stmtUser->execute();

        // Retrieve last record's id
        $roleId = $stmtUser->fetchColumn();

        //Insert new employee
        $sqlInsertEmployee = "INSERT INTO employee (first_name, last_name, birthdate, biography, avatar, team_id, role_id, actif) VALUES (:first_name, :last_name, :birthdate, :biography, :avatar, :team_id, :role_id, :actif)";
        $stmtInsertEmployee = $bdd->prepare($sqlInsertEmployee);
        $stmtInsertEmployee->bindParam(":first_name", $firstName);
        $stmtInsertEmployee->bindParam(":last_name", $lastName);
        $stmtInsertEmployee->bindParam(":birthdate", $birthdate);
        $stmtInsertEmployee->bindParam(":biography", $biography);
        $stmtInsertEmployee->bindParam(":avatar", $avatar);
        $stmtInsertEmployee->bindParam(":role_id", $roleId, PDO::PARAM_INT);
        $stmtInsertEmployee->bindParam(":team_id", $teamId, PDO::PARAM_INT);
        $stmtInsertEmployee->bindParam(":actif", $actif);

        try {
            $stmtInsertEmployee->execute();
            //$employeeId = $bdd->lastInsertId();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de l'insertion des données de l'employé";
            $errors[] = $message;
        }

        $sqlLastEmployee = "SELECT id FROM employee ORDER BY id DESC LIMIT 1";
        $stmtEmployee = $bdd->prepare($sqlLastEmployee);
        $stmtEmployee->execute();

        // Retrieve last record's id
        $employeeId = $stmtEmployee->fetchColumn();

        //Insert skills for new employee
        foreach ($skills as $skill) {
            $stmt = $bdd->prepare("INSERT INTO characterize (employee_id, skill_id) VALUES (:employee_id, :skill_id)");
            $stmt->bindParam(':employee_id', $employeeId);
            $stmt->bindParam(':skill_id', $skill);
            $stmt->execute();
        }
    }
}
