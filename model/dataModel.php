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
