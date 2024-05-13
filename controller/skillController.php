<?php
session_start();

// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/skillModel.php");

// Handle form submission
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $actif = ($_POST['actif'] == 1 ? 1 : 0);
    if (isset($_POST['skillId'])) {
        $id = htmlspecialchars(trim($_POST['skillId']));
    } else {
        $id = null;
    }


    // Call to the function inside the model file
    $error = insertOrUpdateSkill($name, $actif, $id);

    if (isset($error)) {
        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-admin-skill-index.php?message=" . $message);
        exit;
    } else {
        // Redirection with success message
        $message = "success";
        header("Location: ../view/view-admin-skill-index.php?message=" . $message);
        exit;
    }
} else {
    header("Location: ../view/view-admin-skill.php");
    exit;
}
