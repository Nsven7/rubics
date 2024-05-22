<?php
$title = "Admin - Projet(s)";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dataModel.php");

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} else {
    $projects = requests($_SESSION['client']['general']['id']);
?>



    <div class="main">

        <?php if (isset($_GET['message']) && $_GET['message'] == 'success-request-added') {
            echo "<p class='alert alert-success'>Demande enregistrée avec succés</p>";
        } elseif (!isset($projects)) {
            echo "<p class='alert alert-danger'>Auncune demande enregistrée</p>";
        }
        ?>



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
                        if (isset($projects)) {
                            // Loop through the project data and display each row in the table
                            foreach ($projects as $project) {
                                echo "<tr>";
                                echo "<td>" . $project['id'] . "</td>";
                                echo "<td>" . $project['name'] . "</td>";
                                echo "<td>" . $project['description'] . "</td>";
                                echo "<td>" . $project['budget'] . "</td>";
                                echo "<td>" . $project['category_id'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>