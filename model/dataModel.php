<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

function category()
{
    // Retrieve db connection
    global $bdd;

    $query = "SELECT * FROM category";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetch(PDO::FETCH_ASSOC);
    

    //$_SESSION['data'] = $stmt->fetch(PDO::FETCH_ASSOC);

    // $_SESSION['categories'] = $stmt->fetch(PDO::FETCH_ASSOC);

    // $category = ['categories' => $stmt->fetch(PDO::FETCH_ASSOC)];

    // return $_SESSION['categories'];

}
