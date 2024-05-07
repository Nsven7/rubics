<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function getOnGoingProject($employeeId)
{
    // Retrieve db connection
    global $bdd;

    // Prepare SQL query
    $query = "SELECT p.* FROM project p 
    INNER JOIN realize r ON r.project_id = p.id 
    WHERE r.employee_id = :employee_id";

    // Prepare statement
    $stmt = $bdd->prepare($query);

    $stmt->bindParam(":employee_id", $employeeId, PDO::PARAM_INT);

    $stmt->execute();

    $projects = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $projects[] = $row;
    }

    return $projects;
}
