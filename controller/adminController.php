<?php
session_start();

// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/adminModel.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['submit'];

    // Switch case to get the called action 
    switch ($action) {
        case 'Enregistrer':

            if (!empty($fileToUpload)) {
                $fileToUpload = $_POST['fileToUpload'];
            } else {
                $fileToUpload = "";
            }
            $firstName = htmlspecialchars(trim(ucfirst($_POST['firstName'])));
            $lastName = htmlspecialchars(trim(ucfirst($_POST['lastName'])));
            $birthdate = htmlspecialchars($_POST['birthdate']);
            $biography = htmlspecialchars(trim(ucfirst($_POST['biography'])));

            $pwd = htmlspecialchars(trim($_POST['pwd']));
            $confirmPassword = md5(htmlspecialchars(trim($_POST['confirm_password'])));

            $teamId = htmlspecialchars(($_POST['teamId']));
            $priority = intval(htmlspecialchars(($_POST['priority'])));
            $skills = $_POST['skills'];

            $actif = ($_POST['actif'] == 1 ? 1 : 0);
            $roleActif = ($_POST['roleActif'] == 1 ? 1 : 0);

            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $employee = employee($id);
            } else {
                $id = null;
            }

            if (empty($pwd) && empty($confirmPassword)) {
                $pwd = $employee['pwd'];
                $confirmPassword = $pwd;
            }

            if (isset($fileToUpload)) {
                $name = $firstName . $lastName;
                $newName = str_replace(' ', '', ucwords($name));
                $path = $_SERVER['DOCUMENT_ROOT'] . "/Rubics/public/uploads/employees/" . $newName . "/";
                $avatar = $path . $newName;

                $fileToUpload = uploadFile($path, $newName);
            } else {
                if (isset($employee)) {
                    $avatar = $employee['avatar'];
                }
            }
            
            $error = insertOrUpdateEmployee($id, $firstName, $lastName, $birthdate, $biography, $pwd, $confirmPassword, $avatar, $teamId, $priority, $skills, $actif, $roleActif);

            if (isset($error)) {
                //Redirection with error message
                $message = implode(" - ", $error);
                header("Location: ../view/view-employee-admin-home.php?message=" . $message);
                exit;
            } else {
                $message = "success-data-added";
                header("Location: ../view/view-admin-home.php?message=" . $message);
                exit;
            }

        // Action 'Connexion' from login page    
        case 'Connexion':
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $pwd = md5(htmlspecialchars(trim($_POST['pwd'])));

            $error = login($firstName, $lastName, $pwd);

            if (isset($error)) {
                //Redirection with error message
                $message = implode(" - ", $error);
                header("Location: ../view/view-admin-login.php?message=" . $message);
                exit;
            } else {
                if ($_SESSION['employee']) {
                    $message = "success-register";
                    header("Location: ../view/view-employee-admin-home.php?message=" . $message);
                    exit;
                } elseif ($_SESSION['admin']) {
                    $message = "success-register";
                    header("Location: ../view/view-admin-home.php?message=" . $message);
                    exit;
                }
            }

        case 'Déconnexion':
            logout();
            header("Location: ../index.php");
            exit;
            break;

        default:
            // Default case if none of the above match
            echo "Unknown action!";
            break;
    }
}
