<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/realizeModel.php");

// Retrieve employee's projects
$realisations = getOnGoingProject($_SESSION['employee']['general']['id']);

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
        $message = "success-request-added";
        header("Location: ../view/view-user-admin-project.php?message=" . $message);
        exit;
    }
} else {
    header("Location: ../view/view-user-admin-request.php");
    exit;
}
