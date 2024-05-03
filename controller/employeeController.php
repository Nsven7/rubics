<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['submit'];

    // Switch case to get the called action 
    switch ($action) {
            // Action 'Connexion' from login page    
        case 'Connexion':
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $pwd = md5(htmlspecialchars(trim($_POST['password'])));

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