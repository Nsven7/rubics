<?php
session_start();

// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

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
            $pwd = htmlspecialchars(trim($_POST['password']));
            $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));

            $name = $_SESSION['employee']['general']['firstName'] . $_SESSION['employee']['general']['lastName'];
            $newName = str_replace(' ', '', ucwords($name));
            $path = $_SERVER['DOCUMENT_ROOT'] . "/Rubics/public/uploads/employees/" . $newName . "/";
            $avatar = $path + $newName;

            $fileToUpload = uploadFile($path, $newName);

            die();

        // $error = updateData($firstName, $lastName, $birthdate, $biography, $pwd, $confirmPassword);

        // if (isset($error)) {
        //     //Redirection with error message
        //     $message = implode(" - ", $error);
        //     if (!isset($_SESSION['client'])) {
        //         header("Location: ../view/view-employee-admin-home.php?message=" . $message);
        //         exit;
        //     } else {
        //         header("Location: ../view/view-employee-registration.php?message=" . $message);
        //         exit;
        //     }
        // } else {
        //     if (!isset($_SESSION['client'])) {
        //         $message = "success";
        //         header("Location: ../view/view-admin-login.php?message=" . $message);
        //         exit;
        //     } else {
        //         session_destroy();
        //         // Starts a new session
        //         session_start();
        //         // Retrieve user's data from login function
        //         login($mail, $password);
        //         $message = "success";
        //         header("Location: ../view/view-employee-admin-home.php?message=" . $message);
        //         exit;
        //     }
        // }

        // Action 'Connexion' from login page    
        case 'Connexion':
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            //$pwd = md5(htmlspecialchars(trim($_POST['password'])));
            $pwd = trim($_POST['password']);

            $error = login($firstName, $lastName, $pwd);

            if (isset($error)) {
                //Redirection with error message
                $message = "bad-creditential";
                header("Location: ../view/view-admin-login.php?message=" . $message);
                exit;
            } else {
                if ($_SESSION['employee']['role']['priority'] == 2) {
                    $message = "success-register";
                    header("Location: ../view/view-employee-admin-home.php?message=" . $message);
                    exit;
                } elseif ($_SESSION['employee']['role']['priority'] == 1) {
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