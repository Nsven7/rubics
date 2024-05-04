<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

// Retrieve all categories
function category()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM category";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

// Retrieve all requests of a client by its id
function requests($id)
{
    // Retrieve db connection
    global $bdd;

    // SQL request to retrieve all requests of a client by its id
    $query = "SELECT request.*, category.name AS category_name
 FROM request
 INNER JOIN category ON request.id_category = category.id
 WHERE request.id_client = :id";

    // Prepare the statement
    $stmt = $bdd->prepare($query);

    // Bind the parameter :id with the actual client id
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Fetch all requests as associative arrays
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Replace id_category with category_name in each request
    foreach ($requests as &$request) {
        $request['id_category'] = $request['category_name'];
        unset($request['category_name']);
    }

    return $requests;
}

// Retrieve the company of the current client
function retrieveCompany()
{
    // Retrieve db connection
    global $bdd;

    // Retrieve id of current client
    $idClient = $_SESSION['client']['general']['id'];

    $query = "SELECT * FROM company WHERE id_client = :id_client";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(":id_client", $idClient, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt == false) {
        $_SESSION['client']['company'] = [
            'name' => "",
            'country' => "",
            'locality' => "",
            'zip_code' => "",
            'street' => "",
            'number' => "",
            'comment' => "",
            'vat' => ""
        ];
        header("Location: ../view/view-user-admin-company.php?");
        exit;
    } else {
        // Fetch the company as an associative array
        $company = ['company' => $stmt->fetch(PDO::FETCH_ASSOC)];
        $_SESSION['client'] += $company;
        header("Location: ../view/view-user-admin-company.php?");
        exit;
    }
}

function getSkills($employeeId)
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
    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $skills;

    
}
