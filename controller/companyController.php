<?php
session_start();

// Include the model file
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/companyModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim(ucfirst($_POST['name'])));
    $vat = htmlspecialchars($_POST['vat']);
    $country = htmlspecialchars(trim(ucfirst($_POST['country'])));
    $locality = htmlspecialchars(trim(ucfirst($_POST['locality'])));
    $zipCode = htmlspecialchars(trim($_POST['zipCode']));
    $street = htmlspecialchars(trim(ucfirst($_POST['street'])));
    $number = htmlspecialchars(trim(ucfirst($_POST['number'])));
    $comment = htmlspecialchars(trim(ucfirst($_POST['comment'])));

    if (isset($_SESSION['client'])) {
        $identifier = $_SESSION['client'];
        $error = insertOrUpdateCompany($name, $vat, $country, $locality, $zipCode, $street, $number, $comment, $identifier);

        if (isset($error)) {
            //Redirection with error message
            $message = implode(" - ", $error);
            header("Location: ../view/view-user-admin-home.php?message=" . $message);
            exit;
        } else {
            $message = "success";
            var_dump($_SESSION['client']);
            header("Location: ../view/view-home.php?message=" . $message);
            exit;
        }
    } else {
        header("Location: ../view/view-home.php");
        exit;
    }
}
