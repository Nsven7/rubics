<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function getOnGoingProject($employeeId)
{
    // Retrieve db connection
    global $bdd;

    // Prepare SQL query
    $query = "SELECT s.name AS skill_name 
        FROM characterize c 
        INNER JOIN skill s ON c.id_skill = s.id 
        WHERE c.id_employee = :id_employee";


    // Prepare statement
    $stmt = $bdd->prepare($query);

    // Bind parameters
    $stmt->bindParam(":id_employee", $employeeId, PDO::PARAM_INT);

    // Execute statement
    $stmt->execute();

    // Fetch all records as associative arrays
    $arraySkills = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($arraySkills as $key => $value) {
        // Extract the skill name from each sub-array and add it to the transformed array
        $skills[$key] = $value["skill_name"];
    }

    return $skills;
}
