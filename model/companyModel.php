<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

/**
 * This function inserts company data into the database.
 * It first checks if the required fields are not empty.
 * If there are any errors, it returns an array of error messages.
 * If there are no errors, it inserts the user data into the `identifier` and `client` tables.
 * It then retrieves the last inserted id and returns it.
 */

function insertOrUpdateCompany($name, $vat, $country, $locality, $zipcode, $street, $number, $comment, $identifier)
{
    // Check datas received
    $errors = [];
    if (empty($name)) {
        $errors[] = "Nom requis.";
    }
    if (empty($vat)) {
        $errors[] = "N° TVA requis.";
    }
    if (empty($country)) {
        $errors[] = "Pays requis.";
    }
    if (empty($locality)) {
        $errors[] = "Localité requise.";
    }
    if (empty($zipCode)) {
        $errors[] = "Code postal requis.";
    }
    if (empty($street)) {
        $errors[] = "Nom de rue requis.";
    }
    if (empty($number)) {
        $errors[] = "Numéro requis.";
    }

    // Retrieve db connection
    global $bdd;

    // Retrieve last record
    $id = $identifier[0];


    $querySqlIdentifier = "SELECT id FROM client WHERE id = :id";
    $stmtIdentifierCheck = $bdd->prepare($querySqlIdentifier);
    $stmtIdentifierCheck->bindParam(":id", $id);
    $stmtIdentifierCheck->execute();
    $clientId = $stmtIdentifierCheck->fetchColumn();

    // $querySqlClient = "SELECT id FROM client WHERE id_identifier = :id_identifier";
    // $stmtClientCheck = $bdd->prepare($querySqlClient);
    // $stmtClientCheck->bindParam(":id_identifier", $identifierId);
    // $stmtClientCheck->execute();
    // $clientId = $stmtClientCheck->fetchColumn();

    // Insert user's data
    $query = "INSERT INTO company (name, vat, country, locality, zip_code, street, number, comment, id_client) VALUES (:name, :vat, :country, :locality, :zip_code, :street, :number, :comment, :id_client)";

    // Prepare SQL request
    $stmtClientInsert = $bdd->prepare($query);

    // BindParam
    // Bind the values to the placeholders
    $stmtClientInsert->bindParam(':name', $name);
    $stmtClientInsert->bindParam(':vat', $vat);
    $stmtClientInsert->bindParam(':country', $country);
    $stmtClientInsert->bindParam(':locality', $locality);
    $stmtClientInsert->bindParam(':zip_code', $zipcode);
    $stmtClientInsert->bindParam(':street', $street);
    $stmtClientInsert->bindParam(':number', $number);
    $stmtClientInsert->bindParam(':comment', $comment);
    $stmtClientInsert->bindParam(':id_client', $clientId, PDO::PARAM_INT);


    // Execute SQL request
    try {
        $stmtClientInsert->execute();

        $_SESSION['client']['company'] = [
            'name' => $name,
            'vat' => $vat,
            'country' => $country,
            'locality' => $locality,
            'zipcode' => $zipcode,
            'street' => $street,
            'number' => $number,
            'comment' => $comment,
            'identifier' => $identifier
        ];
    } catch (PDOException $e) {
        $message = "Une erreur s'est produite lors de l'insertion des données client";
        $errors[] = $message;
    }
}
