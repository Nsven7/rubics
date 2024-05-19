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
            <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
        </div>
        <nav>
            <ul>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Projets</a></li>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-teams.php">Équipes</a></li>
                <li><a class="btn secondary" href="register.html">Sign in<span class="arrow"></span></a></li>
            </ul>
        </nav>
    </header>