<?php
$title = "Admin - Demande";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

// Check if session data exists
if (!isset($_SESSION['skills'])) {
    // Redirect back to the controller to fetch session data
    header("Location: ../controller/skillController.php");
    exit;
}
?>

<div class="container-items">
    <div class="container-content">
        <div class="sidenav">
            <div class="accordionItem">
                <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-employee-admin-home.php">Modifier mes informations</li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Projet<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-employee-admin-project.php">Projet(s) en cours</a></li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Mes compétences<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li class="actif-link">Voir mes compétencess</li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Liens<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <a href="index.php?action=updateUser">Home</a>
                </div>
            </div>
        </div>

        <div class="main">
            <h1>Mes compétences</h1>

            <div class="main-conent">
                <div class="data-card">
                    <h3>Tags</h3>
                    <?php foreach ($_SESSION['skills'] as $skill) : ?>
                        <span class="badge rounded-pill bg-success"><?php echo $skill ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
    </body>

    </html>