<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function category()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM category";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $category = ['category' => $stmt->fetch(PDO::FETCH_ASSOC)];

    return $category
}
