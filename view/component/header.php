<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php "Rubics | " . $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/asset/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/asset/css/style.css">
</head>

<body>
    <header>
        <!-- Start session in header -->
        <?php session_start();

        // Check wich user is connected
        if (isset($_SESSION['client']) || isset($_SESSION['employee']) || isset($_SESSION['admin'])) { ?>

            <!-- If it's the case: display "logout" button -->
            <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                <input type="submit" value="Déconnexion" name="submit">
            </form>

            <!-- Else: display "connextion" button -->
        <?php
        } else {
        ?>
            <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-login.php">Connexion</a>

        <?php }; ?>
    </header>