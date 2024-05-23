<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

// Retrieve all categories
function categories()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM category";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

// Retrieve all active categories
function activeCategories()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM category WHERE actif = 1";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

// Retrieve specific category by its id
function category($id)
{
    // Retrieve db connection
    global $bdd;

    $sql = "SELECT * FROM category WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    return $category;
}

// Update or insert category if id is not defined
function insertOrUpdate($name, $description, $actif, $id = null)
{
    // Check datas received
    $errors = [];
    if (empty($name)) {
        $errors[] = "Nom requis";
    }
    if (empty($description)) {
        $errors[] = "Description requise";
    }

    if (!empty($errors)) {
        return $errors;
    }

    // Retrieve db connection
    global $bdd;

    if ($id != null) {
        $sql = "UPDATE category SET name = :name, description = :description, actif = :actif WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    } else {
        $sql = "INSERT INTO category (name, description, actif) VALUES (:name, :description, :actif)";
        $stmt = $bdd->prepare($sql);
    }

    // Bind parameters and execute the statement
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':actif', $actif);


    // Execute SQL request
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        //echo "Exception caught: " . $e->getMessage();
        $message = "Une erreur s'est produite";
    }
}
