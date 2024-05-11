<?php
session_start();

// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");

// Handle form submission
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $actif = ($_POST['actif'] == 1 ? 1 : 0);
    if (isset($_POST['teamId'])) {
        $id = htmlspecialchars(trim($_POST['teamId']));
    } else {
        $id = null;
    }


    // Call to the function inside the model file
    $error = insertOrUpdate($name, $actif, $id);

    if (isset($error)) {
        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-admin-team-index.php?message=" . $message);
        exit;
    } else {
        // Redirection with success message
        $message = "success";
        header("Location: ../view/view-admin-team-index.php?message=" . $message);
        exit;
    }
} else {
    header("Location: ../view/view-admin-team.php");
    exit;
}
