<?php
$title = "Admin - Demande";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/realizeModel.php");


if (!isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else {
    $projects = getOnGoingProject($_SESSION['employee']['general']['id']);
    ?>

    <div class="container-items">
        <div class="container-content">
            <div class="sidenav">
                <div class="accordionItem">
                    <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-employee-admin-home.php">Modifier
                                    mes informations</a></li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Projet<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li class="actif-link">Projet(s) en cours</li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Mes compétences<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-employee-admin-skill.php">Voir
                                    mes compétencess</a></li>
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
                <h1>Demande(s) de projet</h1>
                <div class="main-conent">
                    <div class="data-card">
                        <h3>Général</h3>

                        <table id="read-data">
                            <thead>
                                <tr>
                                    <th>Nom du projet</th>
                                    <th>Description</th>
                                    <th>Finalisé</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Loop through the project data and display each row in the table
                                foreach ($projects as $project) {
                                    echo "<tr>";
                                    echo "<td>" . $project["name"] . "</td>";
                                    echo "<td>" . $project["description"] . "</td>";
                                    echo "<td>" . ($project["finalized"] ? "Oui" : "Non") . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="index.js"></script>
        </body>

        </html>
    <?php } ?>