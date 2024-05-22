<!DOCTYPE html>
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
        <div class="logo">
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-home.php">
                <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Projets</a></li>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-teams.php">Équipes</a></li>

                <!-- Start session in header -->
                <?php session_start();

                // Check wich user is connected
                if (isset($_SESSION['client'])) { ?>

                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-user-admin-home.php">Mon compte</a>
                    </li>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } elseif (isset($_SESSION['admin'])) { ?>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-admin-home.php">Mon compte</a></li>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/adminController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } elseif (isset($_SESSION['employee'])) { ?>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-employee-admin-home.php">Mon
                            compte</a></li>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } elseif (isset($_SESSION['client'])) { ?>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <div class="menu">
        <div class="logo-mobile">
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-home.php">
                <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
            </a>
        </div>
        <div class="burger-menu" id="burger-menu">
            &#9776; <!-- Unicode for burger menu icon -->
        </div>
    </div>
    <div class="menu-overlay" id="menu-overlay">
        <div class="menu-header">
            <span class="close-menu" id="close-menu">&times;</span>
            <div class="logo-mobile">
                <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-home.php">
                    <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
                </a>
            </div>
        </div>
        <div class="menu-content">
            <ul>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Projets</a></li>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-teams.php">Équipes</a></li>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Projets</a></li>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-rgpd.php">R.G.P.D</a></li>

                <?php if (isset($_SESSION['admin'])) { ?>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-admin-home.php">Mon compte</a></li>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/adminController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } elseif (isset($_SESSION['employee'])) { ?>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-employee-admin-home.php">Mon
                            compte</a></li>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } elseif (isset($_SESSION['client'])) { ?>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php"
                            method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>