<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

/**
 * This function inserts user data into the database.
 * It first checks if the required fields are not empty and if the passwords match.
 * If there are any errors, it returns an array of error messages.
 * If there are no errors, it inserts the user data into the `identifier` and `client` tables.
 * It then retrieves the last inserted id and returns it.
 */

function insertOrUpdateData($firstName, $lastName, $birthdate, $mail, $username, $pwd, $confirmPassword, $secretQuestion, $answer, $terms)
{
    // Check datas received
    $errors = [];
    if (empty($lastName)) {
        $errors[] = "Nom requis.";
    }
    if (empty($firstName)) {
        $errors[] = "Prénom requis.";
    }
    if (empty($birthdate)) {
        $errors[] = "Date de naissance requise.";
    }
    if (empty($mail)) {
        $errors[] = "Email requis.";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email invalide.";
    }
    if (empty($username)) {
        $errors[] = "Nom d'utilisateur requis.";
    }
    if (empty($pwd)) {
        $errors[] = "Mot de passe requis.";
    } elseif (strlen($pwd) < 8) {
        $errors[] = "Mot de passe doit contenir au moins 8 caractères.";
    }
    if (empty($confirmPassword) && empty($_SESSION['client'])) {
        $errors[] = "Veuillez confirmer votre mot de passe";
    } elseif ($pwd !== $confirmPassword) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    } elseif ($pwd > 8 and $pwd === $confirmPassword) {
        $pwd = md5($pwd);
    } elseif (empty($pwd) && isset($_SESSION['client'])) {
        $pwd = $_SESSION['client']['pwd'];
    }
    if (empty($secretQuestion)) {
        $errors[] = "Choisissez une question secrète.";
    }
    if (empty($answer)) {
        $errors[] = "Réponse à la question secrète requise.";
    }
    if (empty($terms)) {
        $errors[] = "Vous devez accepter les termes et conditions.";
    }

    // Retrieve db connection
    global $bdd;

    // Check if client exists
    $querysqlCheck = "SELECT id FROM identifier WHERE mail = :mail";
    $stmtCheck = $bdd->prepare($querysqlCheck);
    $stmtCheck->bindParam(":mail", $mail);
    $stmtCheck->execute();
    $userExists = $stmtCheck->fetchColumn();

    if ($userExists) {
        // Update user's identifiers
        $querysqlUpdateIdentifier = "UPDATE identifier SET username = :username, mail = :mail, pwd = :pwd, secret_question = :secret_question, secret_answer = :secret_answer WHERE id = :id";
        $stmtUpdateIdentifier = $bdd->prepare($querysqlUpdateIdentifier);
        $stmtUpdateIdentifier->bindParam(":username", $username);
        $stmtUpdateIdentifier->bindParam(":mail", $mail);
        $stmtUpdateIdentifier->bindParam(":pwd", $pwd);
        $stmtUpdateIdentifier->bindParam(":secret_question", $secretQuestion);
        $stmtUpdateIdentifier->bindParam(":secret_answer", $answer);
        $stmtUpdateIdentifier->bindParam(":id", $userExists);

        try {
            $stmtUpdateIdentifier->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des identifiants client";
            $errors[] = $message;
        }

        // Update user's data
        $querysqlUpdateClient = "UPDATE client SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, last_connection = :last_connection, actif = :actif WHERE id_identifier = :id_identifier";
        $stmtUpdateClient = $bdd->prepare($querysqlUpdateClient);
        $stmtUpdateClient->bindParam(":first_name", $firstName);
        $stmtUpdateClient->bindParam(":last_name", $lastName);
        $stmtUpdateClient->bindParam(":birthdate", $birthdate);
        $stmtUpdateClient->bindValue(":last_connection", date("Y/m/d"));
        $stmtUpdateClient->bindValue(":actif", 1);
        $stmtUpdateClient->bindParam(":id_identifier", $userExists, PDO::PARAM_INT);

        try {
            $stmtUpdateClient->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des données client";
            $errors[] = $message;
        }
    } else {
        // Insert user's identifiers
        $querysql = "INSERT INTO identifier (username, mail, pwd, secret_question, secret_answer) VALUES (:username, :mail, :pwd, :secret_question, :secret_answer)";

        // Prepare SQL request
        $stmtClientData = $bdd->prepare($querysql);

        // BindParam
        $stmtClientData->bindParam(":username", $username);
        $stmtClientData->bindParam(":mail", $mail);
        $stmtClientData->bindParam(":pwd", $pwd);
        $stmtClientData->bindParam(":secret_question", $secretQuestion);
        $stmtClientData->bindParam(":secret_answer", $answer);

        // Execute SQL request
        try {
            $stmtClientData->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de l'insertion des identifiants client";
            $errors[] = $message;
        }

        // Retrieve last record
        $sqlLastUser = "SELECT id FROM identifier ORDER BY id DESC LIMIT 1";
        $stmtUser = $bdd->prepare($sqlLastUser);
        $stmtUser->execute();

        // Retrieve last record's id
        $identifierId = $stmtUser->fetchColumn();

        // Insert user's data
        $querysqlData = "INSERT INTO client (first_name, last_name, birthdate, created_at, last_connection, actif, id_identifier) VALUES (:first_name, :last_name, :birthdate, :created_at, :last_connection, :actif,  :id_identifier)";

        // Prepare SQL request
        $stmtClientInsert = $bdd->prepare($querysqlData);

        // BindParam
        $stmtClientInsert->bindParam(":first_name", $firstName);
        $stmtClientInsert->bindParam(":last_name", $lastName);
        $stmtClientInsert->bindParam(":birthdate", $birthdate);
        $stmtClientInsert->bindValue(":created_at", date("Y/m/d"));
        $stmtClientInsert->bindValue(":last_connection", date("Y/m/d"));
        $stmtClientInsert->bindValue(":actif", 1);
        $stmtClientInsert->bindParam(":id_identifier", $identifierId);

        // Execute SQL request
        try {
            $stmtClientInsert->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de l'insertion des données client";
            $errors[] = $message;
        }
    }
}

/**
 * This function logs the client
 * It takes two parameters: the mail and the password.
 * It then retrieves the client with the identifiers.
 * If there are no errors, it returns the client data with its identifiers.
 * It then stocks this array in session.
 */
function login($mail, $pwd)
{
    // Retrieve db connection
    global $bdd;

    // Retrieve client with identifiers
    $sqlClient = "SELECT * FROM `client` join identifier where client.id_identifier = identifier.id AND mail = :mail AND pwd = :pwd";

    $stmtClient = $bdd->prepare($sqlClient);
    $stmtClient->bindParam(":mail", $mail);
    $stmtClient->bindParam(":pwd", $pwd);

    // Execute SQL request
    try {
        $stmtClient->execute();
    } catch (PDOException $e) {
        // echo "Exception caught: " . $e->getMessage();
        $message = "Adresse mail ou mot de passe incorect";
    }

    // Retrieves client data from the database in an array
    $client = $stmtClient->fetch();

    // Stocks this array in session
    $_SESSION['client'] = $client;
}


/**
 * This function 
 * logout the client
 * and destroy
 * the session
 */
function logout()
{
    session_destroy();
}
