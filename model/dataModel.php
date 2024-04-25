<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

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

function requests($id)
{
    // Retrieve db connection
    global $bdd;

    // SQL request to retrieve all requests of a client by its id and the corresponding category name
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

    if ($stmt === false) {
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
