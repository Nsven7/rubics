<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/requestModel.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

$categories = category();

$_SESSION['data'] += $categories;

if (isset($_POST['submit']) && isset($_SESSION['client'])) {

    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $description = htmlspecialchars($_POST['description']);
    $budget = htmlspecialchars(trim(ucfirst($_POST['budget'])));
    $category = htmlspecialchars(trim(ucfirst($_POST['category'])));

    $error = insertRequest($name, $description, $budget, $category);

    if (isset($error)) {
        //Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-user-admin-request.php?message=" . $message);
        exit;
    } else {
        $message = "success";
        header("Location: ../view/view-user-admin-request.php?message=" . $message);
        exit;
    }
} else {
    $_SESSION['data'];
    header("Location: ../view/view-home.php");
    exit;
}
