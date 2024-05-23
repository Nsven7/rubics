<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

/**
 * This function inserts request data into the database.
 * It first checks if the required fields are not empty.
 * If there are no errors, it inserts the data into the `request` table.
 */
function insertRequest($name, $description, $budget, $category)
{
    // Check datas received
    $errors = [];
    if (empty($name)) {
        $errors[] = "Nom requis";
    }
    if (empty($description)) {
        $errors[] = "Description requise";
    }
    if (empty($budget)) {
        $errors[] = "Budget requis";
    }
    if (empty($category)) {
        $errors[] = "Catégorie requise";
    }

    if (!empty($errors)) {
        return $errors;
    }

    // Retrieve db connection
    global $bdd;

    // Retrieve id of current client
    $idClient = $_SESSION['client']['general']['id'];

    // Retrieve id of category selected
    $querySqlCategory = "SELECT id FROM category WHERE id = :category";
    $stmtCategoryCheck = $bdd->prepare($querySqlCategory);
    $stmtCategoryCheck->bindParam(":category", $category, PDO::PARAM_INT);
    $stmtCategoryCheck->execute();

    $idCategory = $stmtCategoryCheck->fetchColumn();

    // Insert new request
    $query = "INSERT INTO request (name, description, budget, client_id, category_id) VALUES (:name, :description, :budget, :client_id, :category_id)";
    $bdd->prepare($query);

    $stmt = $bdd->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":budget", $budget);
    $stmt->bindParam(":client_id", $idClient, PDO::PARAM_INT);
    $stmt->bindParam(":category_id", $idCategory, PDO::PARAM_INT);

    // Execute SQL request
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        // echo "Exception caught: " . $e->getMessage();
        $message = "Une erreur s'est produite lors de l'insertion de votre demande";
    }

    $query = "SELECT * FROM request WHERE client_id = :client_id";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(":client_id", $idClient, PDO::PARAM_INT);
    $stmt->execute();

    // Retrieve request
    $request = ['request' => $stmt->fetch(PDO::FETCH_ASSOC)];

    $_SESSION['client'] += $request;
}

// Retrieve requests where there aren't project in relation
function getRequests()
{
    global $bdd;

    // SQL query
    $sql = "SELECT * FROM request WHERE request.id NOT IN (SELECT request_id FROM project)";

    // Prepare the query
    $stmt = $bdd->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if any requests were found
    if ($requests) {
        return $requests;
    } else {
        return array(); // No requests without project found
    }
}
