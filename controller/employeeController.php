<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['submit'];

    // Switch case to get the called action 
    switch ($action) {
        case 'Enregistrer':

            $fileToUpload = $_POST['fileToUpload'];
            $firstName = htmlspecialchars(trim(ucfirst($_POST['firstName'])));
            $lastName = htmlspecialchars(trim(ucfirst($_POST['lastName'])));
            $birthdate = htmlspecialchars($_POST['birthdate']);
            $biography = htmlspecialchars(trim(ucfirst($_POST['biography'])));
            $pwd = htmlspecialchars(trim($_POST['pwd']));
            $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));

            $name = $_SESSION['employee']['general']['firstName'] . $_SESSION['employee']['general']['lastName'];
            $newName = str_replace(' ', '', ucwords($name));
            $path = $_SERVER['DOCUMENT_ROOT'] . "/Rubics/public/uploads/employees/" . $newName . "/";
            $avatar = $path . $newName . ".jpg";

            $fileToUpload = uploadFile($path, $newName);

            $error = updateData($firstName, $lastName, $birthdate, $biography, $pwd, $confirmPassword, $avatar);

            if (isset($error)) {
                //Redirection with error message
                $message = implode(" - ", $error);
                header("Location: ../view/view-employee-admin-home.php?message=" . $message);
                exit;
            } else {
                session_destroy();
                // Starts a new session
                session_start();
                // Retrieve employee's data from login function
                login($firstName, $lastName, $pwd);
                $message = "success-data-added";
                header("Location: ../view/view-employee-admin-home.php?message=" . $message);
                exit;
            }

            // Action 'Connexion' from login page    
        case 'Connexion':
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $pwd = md5(htmlspecialchars(trim($_POST['password'])));

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

        case 'Appliquer':

            if (isset($_POST['teamId'])) {
                $teamId = intval($_POST['teamId']);
                header("Location: ../view/view-teams.php?id=$teamId");
                exit();
            } else {
                header("Location: ../view/view-teams.php");
                exit();
            }

        default:
            // Default case if none of the above match
            echo "Unknown action!";
            break;
    }
}
