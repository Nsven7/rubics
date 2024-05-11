<?php
session_start();

// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/categoryModel.php");

// Handle form submission
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $description = htmlspecialchars($_POST['description']);
    $actif = ($_POST['actif'] == 1 ? 1 : 0);
    if (isset($_POST['categoryId'])) {
        $id = htmlspecialchars(trim($_POST['categoryId']));
    } else {
        $id = null;
    }


    // Call to the function inside the model file
    $error = insertOrUpdate($name, $description, $actif, $id);

    if (isset($error)) {
        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-admin-category-index.php?message=" . $message);
        exit;
    } else {
        // Redirection with success message
        $message = "success";
        header("Location: ../view/view-admin-category-index.php?message=" . $message);
        exit;
    }
} else {
    header("Location: ../view/view-admin-category.php");
    exit;
}
