<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

/**
 * This function inserts company data into the database.
 * It first checks if the required fields are not empty.
 * If there are any errors, it returns an array of error messages.
 * If there are no errors, it inserts the user data into the `company` table.
 */

function insertOrUpdateCompany($name, $vat, $country, $locality, $zipcode, $street, $number, $comment)
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

    // Retrieve id of current client
    $idClient = $_SESSION['client']['general']['id'];

    // Check if company already exists
    $querySqlCompany = "SELECT id FROM company WHERE id_client = :id_client";
    $stmtCompanyCheck = $bdd->prepare($querySqlCompany);
    $stmtCompanyCheck->bindParam(":id_client", $idClient, PDO::PARAM_INT);
    $stmtCompanyCheck->execute();
    
    $companyId = $stmtCompanyCheck->fetchColumn();

    if ($companyId) {
        // Update existing company
        $query = ("UPDATE company SET name = :name, country = :country, locality = :locality, zip_code = :zip_code, street = :street, number = :number, comment = :comment, vat = :vat WHERE id_client = :id_client");
        $stmt = $bdd->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":country", $country);
        $stmt->bindParam(":locality", $locality);
        $stmt->bindParam(":zip_code", $zipcode);
        $stmt->bindParam(":street", $street);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":comment", $comment);
        $stmt->bindParam(":vat", $vat);
        $stmt->bindParam(":id_client", $idClient, PDO::PARAM_INT);
        $stmt->execute();
        
    } else {
        // Insert new company
        $query = "INSERT INTO company (name, vat, country, locality, zip_code, street, number, comment, id_client) VALUES (:name, :vat, :country, :locality, :zip_code, :street, :number, :comment, :id_client)";
        $bdd->prepare($query);
       
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":vat", $vat);
        $stmt->bindParam(":country", $country);
        $stmt->bindParam(":locality", $locality);
        $stmt->bindParam(":zip_code", $zipcode);
        $stmt->bindParam(":street", $street);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":comment", $comment);
        $stmt->bindParam(":id_client", $idClient, PDO::PARAM_INT);
        $stmt->execute();
    }

    $query = "SELECT * FROM company WHERE id_client = :id_client";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(":id_client", $idClient, PDO::PARAM_INT);
    $stmt->execute();

    $company = ['company' => $stmt->fetch(PDO::FETCH_ASSOC)];


    $_SESSION['client'] += $company;
}
