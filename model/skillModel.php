<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function skills()
{
    global $bdd;

    $query = "SELECT * FROM skill";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $skills;
}

function activeSkills()
{
    global $bdd;

    $query = "SELECT * FROM skill WHERE actif = 1 ORDER BY name ASC";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $skills;
}

function skill($id)
{
    // Retrieve db connection
    global $bdd;

    $sql = "SELECT * FROM skill WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $skill = $stmt->fetch(PDO::FETCH_ASSOC);

    return $skill;
}


function getSkills($employeeId)
{
    // Retrieve db connection
    global $bdd;

    // Prepare SQL query
    $query = "SELECT skill_id
              FROM characterize c 
              INNER JOIN skill s ON c.skill_id = s.id 
              WHERE c.employee_id = :employee_id";

    // Prepare statement
    $stmt = $bdd->prepare($query);

    // Bind parameters
    $stmt->bindParam(":employee_id", $employeeId, PDO::PARAM_INT);

    // Execute statement
    $stmt->execute();

    // Fetch all records as associative arrays
    $skills = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // foreach ($arraySkills as $key => $value) {
    //     // Extract the skill name from each sub-array and add it to the transformed array
    //     $skills[$key] = $value["skill_name"];
    // }
    return $skills;
}

function insertOrUpdateSkill($name, $actif, $id = null)
{
    // Check datas received
    $errors = [];
    if (empty($name)) {
        $errors[] = "Nom requis";
    }

    if (!empty($errors)) {
        return $errors;
    }

    // Retrieve db connection
    global $bdd;

    if ($id != null) {
        $sql = "UPDATE skill SET name = :name, actif = :actif WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    } else {
        $sql = "INSERT INTO skill (name, actif) VALUES (:name, :actif)";
        $stmt = $bdd->prepare($sql);
    }

    // Bind parameters and execute the statement
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':actif', $actif);


    // Execute SQL request
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Exception caught: " . $e->getMessage();
        // $message = "Une erreur s'est produite";
    }
}