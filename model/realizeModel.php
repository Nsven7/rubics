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

function getEmployeesOnProject($id) {
    global $bdd;

    $query = "SELECT e.*, t.name AS team_name FROM employee e 
    INNER JOIN realize r ON r.employee_id = e.id
    INNER JOIN team t ON e.team_id = t.id
    WHERE r.project_id = :project_id";

    //$query = "SELECT employee_id FROM realize WHERE project_id = :project_id";

    $stmt = $bdd->prepare($query);

    $stmt->bindParam(":project_id", $id, PDO::PARAM_INT);

    $stmt->execute();

    $employees = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $employees[] = $row;
    }

    return $employees;
}
