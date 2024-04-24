<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/requestModel.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

if (!isset($_SESSION['categories'])) {
    $categories = category();
}

foreach ($categories as $category) {
    $_SESSION['categories'][] = $category;
}

// Handle form submission
if (isset($_POST['submit']) && isset($_SESSION['client'])) {
    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $description = htmlspecialchars($_POST['description']);
    $budget = htmlspecialchars(trim($_POST['budget']));
    $category = $_POST['category'];
    
    $error = insertRequest($name, $description, $budget, $category);

    if (isset($error)) {
        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-user-admin-request.php?message=" . $message);
        exit;
    } else {
        $message = "success";
        header("Location: ../view/view-user-admin-request.php");
        exit;
    }
} else {
    header("Location: ../view/view-user-admin-request.php");
    exit;
}
