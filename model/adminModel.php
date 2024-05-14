<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function insertOrUpdateEmployee($id, $firstName, $lastName, $birthdate, $biography, $pwd, $confirmPassword, $avatar, $teamId, $priority, $skills)
{

    // Check datas received
    $errors = [];
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
    if (strlen($pwd) < 8) {
        $errors[] = "Mot de passe doit contenir au moins 8 caractères";
    } elseif ($pwd !== $confirmPassword) {
        $errors[] = "Les mots de passe ne correspondent pas";
    } elseif (empty($confirmPassword)) {
        $errors[] = "Veuillez confirmer votre mot de passe";
    }

    // Retrieve db connection
    global $bdd;

    // Check if client exists
    $stmtEmployeeId = $bdd->prepare("SELECT id FROM employee WHERE employee.id = ?");
    $stmtEmployeeId->execute([$id]);
    $employeeId = $stmtEmployeeId->fetchColumn();

    if ($employeeId) {
        // Update role data
        $stmtRoleId = $bdd->prepare("SELECT role_id FROM employee WHERE employee.id = ?");
        $stmtRoleId->execute([$id]);
        $roleId = $stmtRoleId->fetchColumn();

        $querysqlUpdateEmployee = "UPDATE role SET pwd = :pwd, priority = :priority  WHERE id = :id";
        $stmtUpdateEmployee = $bdd->prepare($querysqlUpdateEmployee);
        $stmtUpdateEmployee->bindParam(":id", $roleId, PDO::PARAM_INT);
        $stmtUpdateEmployee->bindParam(":priority", $priority);
        $stmtUpdateEmployee->bindParam(":pwd", $pwd);

        try {
            $stmtUpdateEmployee->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des identifiants client";
            $errors[] = $message;
        }

        // Update employee data
        $sqlEmployee = "UPDATE `employee` SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, biography = :biography, avatar = :avatar, team_id = :team_id, role_id = :role_id WHERE id = :id";
        $stmtEmployee = $bdd->prepare($sqlEmployee);
        $stmtEmployee->bindParam(":id", $employeeId);
        $stmtEmployee->bindParam(":first_name", $firstName);
        $stmtEmployee->bindParam(":last_name", $lastName);
        $stmtEmployee->bindParam(":birthdate", $birthdate);
        $stmtEmployee->bindParam(":biography", $biography);
        $stmtEmployee->bindParam(":avatar", $avatar);
        $stmtEmployee->bindParam(":role_id", $roleId, PDO::PARAM_INT);
        $stmtEmployee->bindParam(":team_id", $teamId, PDO::PARAM_INT);

        try {
            $stmtEmployee->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des données de l'employé";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        // First, select the IDs that exist in the table for the current employee
        $stmt = $bdd->prepare("SELECT skill_id FROM characterize WHERE employee_id = :employee_id");
        $stmt->bindParam(':employee_id', $employeeId);
        $stmt->execute();
        $existingIds = $stmt->fetchAll(PDO::FETCH_COLUMN);


        // Loop over the array of IDs
        foreach ($skills as $skill) {
            // If the ID exists in the table, do nothing
            if (in_array($id, $existingIds)) {
                // If the ID doesn't exist in the table, insert it
                $stmt = $bdd->prepare("INSERT INTO characterize (employee_id, skill_id) VALUES (:employee_id, :skill_id)");
                $stmt->bindParam(':employee_id', $employeeId);
                $stmt->bindParam(':skill_id', $skill);
                $stmt->execute();
            }

        }

        // Now, delete IDs from the table that exist in the table but not in the array
        $idsToDelete = array_diff($existingIds, $skills);
        foreach ($idsToDelete as $id) {
            $stmt = $bdd->prepare("DELETE FROM characterize WHERE employee_id = :employee_id AND skill_id = :skill_id");
            $stmt->bindParam(':employee_id', $employeeId);
            $stmt->bindParam(':skill_id', $skill);
            $stmt->execute();
        }
    }
}
