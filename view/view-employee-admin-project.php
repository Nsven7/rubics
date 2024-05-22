<?php
$title = "Admin - Demande";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/realizeModel.php");


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
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>