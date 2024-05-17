<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

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
    if (isset($_SESSION['client']['identifier'])) {
        if (empty($pwd) && empty($confirmPassword)) {
            $pwd = $_SESSION['client']['identifier']['pwd'];
        }
        if (empty($secretQuestion)) {
            $secretQuestion = $_SESSION['client']['identifier']['secret_question'];
        }
        if (empty($answer)) {
            $answer = $_SESSION['client']['identifier']['secret_answer'];
        }
    } else {
        if (empty($lastName)) {
            $errors[] = "Nom requis";
        }
        if (empty($firstName)) {
            $errors[] = "Prénom requis";
        }
        if (empty($birthdate)) {
            $errors[] = "Date de naissance requise";
        }
        if (empty($mail)) {
            $errors[] = "Email requis";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email invalide.";
        }
        if (empty($username)) {
            $errors[] = "Nom d'utilisateur requis";
        }

        if (empty($pwd)) {
            $errors[] = "Mot de passe requis";
        } elseif (strlen($pwd) < 8) {
            $errors[] = "Mot de passe doit contenir au moins 8 caractères";
        } elseif ($pwd !== $confirmPassword) {
            $errors[] = "Les mots de passe ne correspondent pas";
        } elseif (empty($confirmPassword)) {
            $errors[] = "Veuillez confirmer votre mot de passe";
        }

        if (empty($secretQuestion)) {
            $errors[] = "Choisissez une question secrète";
        }
        if (empty($answer)) {
            $errors[] = "Réponse à la question secrète requise";
        }
        if (empty($terms)) {
            $errors[] = "Vous devez accepter les termes et conditions";
        }
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

        if (!empty($errors)) {
            return $errors;
        }

        // Update user's data
        $querysqlUpdateClient = "UPDATE client SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, last_connection = :last_connection, actif = :actif WHERE identifier_id = :identifier_id";
        $stmtUpdateClient = $bdd->prepare($querysqlUpdateClient);
        $stmtUpdateClient->bindParam(":first_name", $firstName);
        $stmtUpdateClient->bindParam(":last_name", $lastName);
        $stmtUpdateClient->bindParam(":birthdate", $birthdate);
        $stmtUpdateClient->bindValue(":last_connection", date("Y/m/d"));
        $stmtUpdateClient->bindValue(":actif", 1);
        $stmtUpdateClient->bindParam(":identifier_id", $userExists, PDO::PARAM_INT);

        try {
            $stmtUpdateClient->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de la mise à jour des données client";
            $errors[] = $message;
        }
        if (!empty($errors)) {
            return $errors;
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

        if (!empty($errors)) {
            return $errors;
        }

        // Retrieve last record
        $sqlLastUser = "SELECT id FROM identifier ORDER BY id DESC LIMIT 1";
        $stmtUser = $bdd->prepare($sqlLastUser);
        $stmtUser->execute();

        // Retrieve last record's id
        $identifierId = $stmtUser->fetchColumn();

        // Insert user's data
        $querysqlData = "INSERT INTO client (first_name, last_name, birthdate, created_at, last_connection, actif, identifier_id) VALUES (:first_name, :last_name, :birthdate, :created_at, :last_connection, :actif,  :identifier_id)";

        // Prepare SQL request
        $stmtClientInsert = $bdd->prepare($querysqlData);

        // BindParam
        $stmtClientInsert->bindParam(":first_name", $firstName);
        $stmtClientInsert->bindParam(":last_name", $lastName);
        $stmtClientInsert->bindParam(":birthdate", $birthdate);
        $stmtClientInsert->bindValue(":created_at", date("Y/m/d"));
        $stmtClientInsert->bindValue(":last_connection", date("Y/m/d"));
        $stmtClientInsert->bindValue(":actif", 1);
        $stmtClientInsert->bindParam(":identifier_id", $identifierId);

        // Execute SQL request
        try {
            $stmtClientInsert->execute();
        } catch (PDOException $e) {
            $message = "Une erreur s'est produite lors de l'insertion des données client";
            $errors[] = $message;
        }
        if (!empty($errors)) {
            return $errors;
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
    $sqlClient = "SELECT * FROM `client` join identifier where client.identifier_id = identifier.id AND mail = :mail AND pwd = :pwd";
    $stmtClient = $bdd->prepare($sqlClient);
    $stmtClient->bindParam(":mail", $mail);
    $stmtClient->bindParam(":pwd", $pwd);


    // Execute SQL request
    try {
        $stmtClient->execute();
    } catch (PDOException $e) {
        //echo "Exception caught: " . $e->getMessage();
        $message = "Adresse mail ou mot de passe incorect";
    }

    // Retrieves client data from the database in an array
    $client = $stmtClient->fetch(PDO::FETCH_ASSOC);

    if ($client === false) {
        $message = "Adresse mail ou mot de passe incorect";
        return $message;
    }

    // $sqlClientId = "SELECT id FROM client WHERE identifier_id = :identifier_id";
    // $stmtClientId = $bdd->prepare($sqlClientId);
    // $stmtClientId->bindParam(":identifier_id", $client['identifier_id']);
    // $stmtClientId->execute();
    // $clientId = $stmtClientId->fetchColumn();

    // Stocks datas in session 'client'
    $_SESSION['client'] = [
        'general' => [
            'id' => $client['id'],
            'first_name' => $client['first_name'],
            'last_name' => $client['last_name'],
            'birthdate' => $client['birthdate'],
            'created_at' => $client['created_at'],
            'last_connection' => $client['last_connection'],
            'actif' => $client['actif'],
            'identifier_id' => $client['identifier_id'],

        ],
        'identifier' => [
            'id' => $client['identifier_id'],
            'username' => $client['username'],
            'mail' => $client['mail'],
            'pwd' => $client['pwd'],
            'secret_question' => $client['secret_question'],
            'secret_answer' => $client['secret_answer'],
        ]
    ];
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

function clients()
{
    global $bdd;

    $query = "SELECT * FROM client";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $clients;
}