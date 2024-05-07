<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/skilltModel.php");
// require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

// If the session with categories doesn't exist then we retrieve an array of categories
if (!isset($_SESSION['skills'])) {
    $skills = getSkills($_SESSION['employee']['general']['id']);
}

//We store the categories in the session
// foreach ($skills as $skill) {
//     $_SESSION['skills'][] = $skill;
// }

header("Location: ../view/view-employee-admin-skill.php");
exit;
