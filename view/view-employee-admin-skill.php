<?php
$title = "Admin - Demande";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

// Check if session data exists
if (!isset($_SESSION['skills'])) {
    // Redirect back to the controller to fetch session data
    header("Location: ../controller/skillController.php");
    exit;
}
$skill = $_SESSION['skills'];

die(var_dump($_SESSION['skills']));
?>

