<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php "Rubics | " . $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/asset/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/asset/css/style-admin.css">
</head>

<body>
    <!-- Start session in header -->
    <?php session_start(); ?>

    <header>
        <div class="logo">
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-home.php">
                <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
            </a>
        </div>
        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
            <input class="btn" type="submit" value="Déconnexion" name="submit">
        </form>
    </header>


    <div class="container-items">
        <div class="container-content">

            <?php if (isset($_SESSION['admin'])) {
                include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-menu-desktop.php");
                include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-menu-mobile.php");

            } elseif (isset($_SESSION['employee'])) {
                include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-employee-admin-menu-desktop.php");
                include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-employee-admin-menu-mobile.php");

            } elseif (isset($_SESSION['client'])) {
                include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-admin-menu-desktop.php");
                include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-admin-menu-mobile.php");
            }


            // if (isset($_GET['message']) && strpos($_GET['message'], 'requis')) {
            //     $message = $_GET['message'];
            //     header("Location: ../view/view-user-registration.php?message=" . $message);
            //     exit;
            
            // } elseif (isset($_GET['message']) && strpos($_GET['message'], 'success')) {
            //     $message = $_GET['message'];
            //     header("Location: ../view/view-login.php?message=" . $message);
            //     exit;
            
            // } else {
            //     header("Location: ../view/view-login.php");
            //     exit;
            // }; ?>