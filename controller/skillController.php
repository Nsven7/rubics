<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/skilltModel.php");

header("Location: ../view/view-employee-admin-skill.php");
exit;
