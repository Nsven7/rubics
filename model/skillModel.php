<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");
function getSkills($employeeId)
{
    // Retrieve db connection
    global $bdd;

    // Prepare SQL query
    $query = "SELECT s.name AS skill_name 
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
    $arraySkills = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($arraySkills as $key => $value) {
        // Extract the skill name from each sub-array and add it to the transformed array
        $skills[$key] = $value["skill_name"];
    }
    return $skills;
}