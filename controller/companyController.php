<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/companyModel.php");

// Handle form submission
if (isset($_POST['submit']) && isset($_SESSION['client'])) {

    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $vat = htmlspecialchars($_POST['vat']);
    $country = htmlspecialchars(trim(ucfirst($_POST['country'])));
    $locality = htmlspecialchars(trim(ucfirst($_POST['locality'])));
    $zipCode = htmlspecialchars(trim($_POST['zipCode']));
    $street = htmlspecialchars(trim(ucfirst($_POST['street'])));
    $number = htmlspecialchars(trim(ucfirst($_POST['number'])));
    $comment = htmlspecialchars(trim(ucfirst($_POST['comment'])));

    // Call to the function inside the model file
    $error = insertOrUpdateCompany($name, $vat, $country, $locality, $zipCode, $street, $number, $comment);

    if (isset($error)) {
        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-user-admin-company.php?message=" . $message);
        exit;
        // Redirection with success message
    } else {
        $message = "success-company-added";
        header("Location: ../view/view-user-admin-company.php?message=" . $message);
        exit;
    }
} else {
    header("Location: ../view/view-home.php");
    exit;
}
