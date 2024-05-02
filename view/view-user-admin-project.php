<?php
$title = "Admin - Projet(s)";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

$id = $_SESSION['client']['general']['id'];

$projects = requests($id);
?>

<div class="container-items">
    <div class="container-content">
        <div class="sidenav">
            <div class="accordionItem">
                <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li class="actif-link"><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-home.php">Modifier mes informations</a></li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Projet(s)<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-request.php">Nouveau projet</a></li>
                        <li class="actif-link">Projet(s) en cours</li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Entreprise<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-company.php">Informations liées à mon entreprise</a></li>
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

            <?php if (isset($_GET['message']) && $_GET['message'] == 'success-request-added') {
                echo "<p class='alert alert-success'>Demande enregistrée avec succés</p>";
            }  ?>

            <h1>Demande(s) de projet</h1>


            <div class="main-conent">
                <div class="data-card">
                    <h3>Général</h3>

                    <table id="read-data">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom du projet</th>
                                <th>Description</th>
                                <th>Budget</th>
                                <th>Catégorie</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // Loop through the project data and display each row in the table
                            foreach ($projects as $project) {
                                echo "<tr>";
                                echo "<td>" . $project['id'] . "</td>";
                                echo "<td>" . $project['name'] . "</td>";
                                echo "<td>" . $project['description'] . "</td>";
                                echo "<td>" . $project['budget'] . "</td>";
                                echo "<td>" . $project['id_category'] . "</td>";
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