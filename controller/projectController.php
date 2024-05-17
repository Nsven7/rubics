<?php
session_start();

// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/adminModel.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['submit'];

    // Switch case to get the called action 
    switch ($action) {
        case 'Enregistrer':

            $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
            $description = htmlspecialchars(trim(ucfirst($_POST['description'])));
            $createdAt = htmlspecialchars($_POST['createdAt']);
            $finishedAt = htmlspecialchars($_POST['finishedAt']);
            $finalized = (isset($_POST['finalized']) == 1 ? 1 : 0);
            $employees = $_POST['employees'];

            if (isset($_GET['id-project'])) {
                $projectId = intval($_GET['id-project']);
                $project = getProjectId($projectId);
                $requestId = intval($project['request_id']);
            } else {
                $requestId = intval($_GET['id-request']);
                $projectId = null;
            }

            $error = insertOrUpdateProject($projectId, $requestId, $name, $description, $createdAt, $finishedAt, $finalized, $employees);

            if (isset($error)) {
                //Redirection with error message
                $message = implode(" - ", $error);
                header("Location: ../view/view-admin-home.php?message=" . $message);
                exit;
            } else {
                $message = "success-data-added";
                header("Location: ../view/view-admin-home.php?message=" . $message);
                exit;
            }

        default:
            // Default case if none of the above match
            echo "Unknown action!";
            break;
    }
}
