<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function insertOrUpdateProject($requestId, $projectId, $name, $description, $createdAt, $finishedAt, $finalized, $employees)
{

    // Check datas received
    $errors = [];
    if (empty($name)) {
        $message = "Le nom est obligatoire";
        $errors[] = $message;
    }
    if (empty($description)) {
        $message = "La desciption est obligatoire";
        $errors[] = $message;
    }
    if (empty($createdAt)) {
        $message = "La date de lancement est obligatoire";
        $errors[] = $message;
    }
    if (empty($skills)) {
        $message = "Veuillez sélectionner des employés";
        $errors[] = $message;
    }

    // Retrieve db connection
    global $bdd;

    if ($projectId != null) {
        // Check if employee exists
        $sqlProject = "SELECT * FROM `project` WHERE id = :id";
        $stmtProject = $bdd->prepare($sqlProject);
        $stmtProject->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtProject->execute();
        $project = $stmtProject->fetch(PDO::FETCH_ASSOC);

        if ($project === false) {
            $message = "Le projet n'existe pas";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        // Update employee data
        $sqlProject = "UPDATE `employee` SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, biography = :biography, avatar = :avatar, team_id = :team_id, actif = :actif WHERE id = :id";
        $stmtProject = $bdd->prepare($sqlProject);
        $stmtProject->bindParam(":id", $id);
        $stmtProject->bindParam(":name", $name);
        $stmtProject->bindParam(":request_id", $requestId, PDO::PARAM_INT);
        $stmtProject->bindParam(":actif", $actif);
        $stmtProject->execute();

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
        $querysql = "INSERT INTO project (request, name, description, createdAt, finishedAt, finalized) VALUES (:request, :name, :description, :createdAt, :finishedAt, :finalized)";

        // Prepare SQL request
        $stmtProject = $bdd->prepare($querysql);

        // BindParam
        $stmtProject->bindParam(":request", $request);
        $stmtProject->bindParam(":name", $name);
        $stmtProject->bindParam(":description", $description);
        $stmtProject->bindParam(":createdAt", $createdAt);
        $stmtProject->bindParam(":finishedAt", $finishedAt);
        $stmtProject->bindParam(":finalized", $finalized);

        // Execute SQL request
        try {
            $stmtProject->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de l'insertion du rôle";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        //Insert skills for new employee
        // foreach ($employees as $employee) {
        //     $stmt = $bdd->prepare("INSERT INTO characterize (employee_id, employee_id) VALUES (:employee_id, :employee_id)");
        //     $stmt->bindParam(':employee_id', $employeeId);
        //     $stmt->bindParam(':employee_id', $employee);
        //     $stmt->execute();
        // }
    }
}
