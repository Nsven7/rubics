<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/requestModel.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

// If the session with categories doesn't exist then we retrieve an array of categories
if (!isset($_SESSION['categories'])) {
    $categories = category();
}

// We store the categories in the session
foreach ($categories as $category) {
    $_SESSION['categories'][] = $category;
}

// Handle form submission
if (isset($_POST['submit']) && isset($_SESSION['client'])) {
    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $description = htmlspecialchars($_POST['description']);
    $budget = htmlspecialchars(trim($_POST['budget']));
    $category = $_POST['category'];
    
    // Call to the function inside the model file
    $error = insertRequest($name, $description, $budget, $category);

    if (isset($error)) {
        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-user-admin-request.php?message=" . $message);
        exit;
    } else {
        // Redirection with success message
        $message = "success";
        header("Location: ../view/view-user-admin-request.php?message=" . $message);
        exit;
    }
} else {
    header("Location: ../view/view-user-admin-request.php");
    exit;
}
