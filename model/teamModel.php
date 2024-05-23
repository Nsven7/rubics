<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

// Retrieve active teams
function activeTeams()
{
    global $bdd;

    $query = "SELECT * FROM team WHERE actif = 1";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $teams;
}

// Retrieve all teams, active or not
function teams()
{
    global $bdd;

    $query = "SELECT * FROM team";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $teams;
}

// Retrieve specific team by its id
function team($id)
{
    // Retrieve db connection
    global $bdd;

    $sql = "SELECT * FROM team WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $team = $stmt->fetch(PDO::FETCH_ASSOC);

    return $team;
}

// Update team or insert if id doens't exist
function insertOrUpdate($name, $actif, $id = null)
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
        $sql = "UPDATE team SET name = :name, actif = :actif WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    } else {
        $sql = "INSERT INTO team (name, actif) VALUES (:name, :actif)";
        $stmt = $bdd->prepare($sql);
    }

    // Bind parameters and execute the statement
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':actif', $actif);


    // Execute SQL request
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        // echo "Exception caught: " . $e->getMessage();
        $message = "Une erreur s'est produite";
    }
}