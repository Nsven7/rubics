<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

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
 INNER JOIN category ON request.category_id = category.id
 WHERE request.client_id = :id";

    // Prepare the statement
    $stmt = $bdd->prepare($query);

    // Bind the parameter :id with the actual client id
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Fetch all requests as associative arrays
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Replace category_id with category_name in each request
    foreach ($requests as &$request) {
        $request['category_id'] = $request['category_name'];
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

    $query = "SELECT * FROM company WHERE client_id = :client_id";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(":client_id", $idClient, PDO::PARAM_INT);
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

function uploadFile($path, $name)
{
    $originalFileName = basename($_FILES["fileToUpload"]["name"]); // Original file name
    $targetFile = $path . $name . "." . pathinfo($originalFileName, PATHINFO_EXTENSION); // Path to store the uploaded file with a custom name

    // Initialize $uploadOk
    $uploadOk = 1;

    // Create directory if it doesn't exist
    if (!file_exists($path)) {
        if (!mkdir($path, 0777, true)) {
            return "Failed to create directory.";
        }
    }

    // Check if file has been uploaded
    if (isset($_POST["submit"])) {
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file size (You can adjust this according to your needs)
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            return "Sorry, your file is too large.";
        }

        // Allow only certain file formats (You can adjust this according to your needs)
        if (
            $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
        ) {
            return "Sorry, only JPG, JPEG, PNG files are allowed.";
        }

        // If everything is ok, try to upload file with custom name
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            return "The file " . $originalFileName . " has been uploaded with custom name.";
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }
}