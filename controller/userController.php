<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/userModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['submit'];

    // Switch case to get the called action 
    switch ($action) {
            // If the action is 'S\'enregistrer' from register page
        case 'S\'enregistrer':

            if (isset($_SESSION['client'])) {
                $terms = 1;
            } else {
                $terms = htmlspecialchars($_POST['terms']);
            }

            $firstName = htmlspecialchars(trim(ucfirst($_POST['first_name'])));
            $lastName = htmlspecialchars(trim(ucfirst($_POST['last_name'])));
            $birthdate = htmlspecialchars($_POST['birthdate']);
            $mail = htmlspecialchars(trim($_POST['email']));
            $username = htmlspecialchars(trim(ucfirst($_POST['username'])));
            $pwd = md5(htmlspecialchars(trim($_POST['password'])));
            $confirmPassword = md5(htmlspecialchars(trim($_POST['confirm_password'])));
            $secretQuestion = htmlspecialchars($_POST['secret_question']);
            $answer = htmlspecialchars(trim($_POST['answer']));



            $error = insertOrUpdateData($firstName, $lastName, $birthdate, $mail, $username, $pwd, $confirmPassword, $secretQuestion, $answer, $terms);

            if (isset($error)) {
                //Redirection with error message
                $message = implode(" - ", $error);
                header("Location: ../view/view-user-admin-home.php?message=" . $message);
                exit;
            } else {
                session_destroy();
                // Starts a new session
                session_start();
                // Retrieve employee's data from login function
                login($firstName, $lastName, $pwd);
                $message = "success-data-updated";
                header("Location: ../view/view-user-admin-home.php?message=" . $message);
                exit;
            }

            // if (isset($error)) {
            //     //Redirection with error message
            //     $message = implode(" - ", $error);
            //     if (!isset($_SESSION['client'])) {
            //         header("Location: ../view/view-user-admin-home.php?message=" . $message);
            //         exit;
            //     } else {
            //         header("Location: ../view/view-user-registration.php?message=" . $message);
            //         exit;
            //     }
            // } else {
            //     if (!isset($_SESSION['client'])) {
            //         $message = "success";
            //         header("Location: ../view/view-login.php?message=" . $message);
            //         exit;
            //     } else {
            //         session_destroy();
            //         // Starts a new session
            //         session_start();
            //         // Retrieve user's data from login function
            //         login($mail, $password);
            //         $message = "success";
            //         header("Location: ../view/view-user-admin-home.php?message=" . $message);
            //         exit;
            //     }
            // }

            // Action 'Connexion' from login page    
        case 'Connexion':
            $mail = htmlspecialchars(trim($_POST['email']));
            $pwd = md5(htmlspecialchars(trim($_POST['password'])));

            $error = login($mail, $pwd);


            if (isset($error)) {
                //Redirection with error message
                $message = "bad-creditential";
                header("Location: ../view/view-login.php?message=" . $message);
                exit;
            } else {
                $message = "success-logged";
                header("Location: ../view/view-user-admin-home.php?message=" . $message);
                exit;
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
