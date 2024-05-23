<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

// Retrieve all projects
function getAllProjects()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM project";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $projects;
}

function getAllProjectsActive()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM project WHERE finalized = 1";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $projects;
}

// Retrieve all projects if id is not defined. Else return projects by specific category
function finalizedProjects($id)
{
    // Retrieve db connection
    global $bdd;

    if ($id === null) {
        $query = "SELECT * FROM project WHERE finalized = 1";
        $stmt = $bdd->prepare($query);
    } else {
        $query = "SELECT p.*
        FROM project p
        JOIN request r ON p.request_id = r.id
        WHERE r.category_id = :category_id AND p.finalized = 1";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':category_id', $id, PDO::PARAM_INT);
    }

    $stmt->execute();

    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $projects;
}

// Get specific project by its id
function getProjectId($id)
{
    // Retrieve db connection
    global $bdd;

    $sql = "SELECT * FROM project WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    return $project;
}

// Retrieve all employees in relation with specific project
function getEmployees($projectId)
{
    // Retrieve db connection
    global $bdd;

    // Prepare SQL query
    $query = "SELECT employee_id
              FROM realize r 
              INNER JOIN employee e ON r.employee_id = e.id 
              WHERE r.project_id = :project_id";

    // Prepare statement
    $stmt = $bdd->prepare($query);

    // Bind parameters
    $stmt->bindParam(":project_id", $projectId, PDO::PARAM_INT);

    // Execute statement
    $stmt->execute();

    // Fetch all records as associative arrays
    $employees = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return $employees;
}

// Insert or update project
function insertOrUpdateProject($projectId, $requestId, $name, $description, $createdAt, $finishedAt, $finalized, $employees)
{

    $timestamp = time();
    $createdAt = date("Y-m-d H:i:s", $timestamp);
    $finishedAt = date("Y-m-d H:i:s", $timestamp);

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
    // if (empty($createdAt)) {
    //     //$message = "La date de lancement est obligatoire";
    //     $timestamp = time();
    //     $createdAt = date("Y-m-d H:i:s", $timestamp);

    //     $errors[] = $message;
    // }
    if (empty($employees)) {
        $message = "Veuillez sélectionner des employés";
        $errors[] = $message;
    }

    // Retrieve db connection
    global $bdd;

    
    if ($projectId != null) {
        // Check if employee exists
        $sqlProject = "SELECT * FROM `project` WHERE id = :id";
        $stmtProject = $bdd->prepare($sqlProject);
        $stmtProject->bindParam(":id", $projectId, PDO::PARAM_INT);
        $stmtProject->execute();
        $project = $stmtProject->fetchAll(PDO::FETCH_ASSOC);

        if ($project === false) {
            $message = "Le projet n'existe pas";
            $errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }


        // Update employee data
        $sqlProject = "UPDATE `project` SET name = :name, description = :description, created_at = :created_at, finished_at = :finished_at, finalized = :finalized, WHERE id = :id";
        $stmtProject = $bdd->prepare($sqlProject);
        $stmtProject->bindValue(":id", $projectId, PDO::PARAM_INT);
        $stmtProject->bindParam(":name", $name);
        $stmtProject->bindParam(":description", $description);
        $stmtProject->bindParam(":created_at", $createdAt);
        $stmtProject->bindParam(":finished_at", $finishedAt);
        $stmtProject->bindParam(":finalized", $finalized);

        try {
            $stmtProject->execute();
        } catch (PDOException $e) {
            echo "Exception caught: " . $e->getMessage();
            //$message = "Une erreur s'est produite lors de la mise à jour des données du projet";
            //$errors[] = $message;
        }

        if (!empty($errors)) {
            return $errors;
        }

        // First, select the IDs that exist in the table for the current employee
        $stmt = $bdd->prepare("SELECT employee_id FROM realize WHERE project_id = :project_id");
        $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $stmt->execute();
        $existingIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Loop over the array of IDs
        foreach ($employees as $employee) {
            // If the ID exists in the table, do nothing
            if (in_array($employee, $existingIds)) {
                continue;
            }

            // If the ID doesn't exist in the table, insert it
            $stmt = $bdd->prepare("INSERT INTO realize (project_id, employee_id) VALUES (:project_id, :employee_id)");
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
            $stmt->bindParam(':employee_id', $employee);
            $stmt->execute();
        }

        // Now, delete IDs from the table that exist in the table but not in the array
        $idsToDelete = array_diff($existingIds, $employees);

        foreach ($idsToDelete as $idToDelete) {
            $stmt = $bdd->prepare("DELETE FROM realize WHERE project_id = :project_id AND employee_id = :employee_id");
            $stmt->bindParam(':project_id', $projectId, PDO::PARAM_INT);
            $stmt->bindParam(':employee_id', $idToDelete, PDO::PARAM_INT);
            $stmt->execute();
        }
    } else {

        if ($finishedAt != null) {
        } else {
            $finishedAt = null;
        }
        // Insert user's identifiers
        $querysql = "INSERT INTO project (name, description, created_at, finished_at, finalized, request_id) VALUES (:name, :description, :created_at, :finished_at, :finalized, :request_id)";

        // Prepare SQL request
        $stmtProject = $bdd->prepare($querysql);

        // BindParam
        $stmtProject->bindParam(":name", $name);
        $stmtProject->bindParam(":description", $description);
        $stmtProject->bindParam(":created_at", $createdAt);
        $stmtProject->bindParam(":finished_at", $finishedAt);
        $stmtProject->bindParam(":finalized", $finalized);
        $stmtProject->bindParam(':request_id', $requestId, PDO::PARAM_INT);

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

        $sqlLastProject = "SELECT id FROM project ORDER BY id DESC LIMIT 1";
        $stmtProject = $bdd->prepare($sqlLastProject);
        $stmtProject->execute();

        // Retrieve last record's id
        $projectId = $stmtProject->fetchColumn();


        //Insert skills for new employee
        foreach ($employees as $employee) {
            $stmt = $bdd->prepare("INSERT INTO realize (project_id, employee_id) VALUES (:project_id, :employee_id)");
            $stmt->bindParam(':project_id', $projectId);
            $stmt->bindParam(':employee_id', $employee);
            $stmt->execute();
        }
    }
}
