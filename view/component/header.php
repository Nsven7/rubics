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

                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } elseif (isset($_SESSION['employee']) || isset($_SESSION['admin'])) { ?>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
                            <input class="btn" type="submit" value="Déconnexion" name="submit">
                        </form>
                    </li>
                <?php } else { ?>
                    <li>
                        <div class="cta">
                            <a class="btn" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-login.php">Connextion<span class="arrow right"></span></a>
                        </div>
                    </li> <?php } ?>
            </ul>




        </nav>
    </header>