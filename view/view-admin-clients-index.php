<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/userModel.php");
$title = "Admin - Home";

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else {
    $clients = clients();
?>

    <div class="main">
        <h1>Clients</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Liste</h3>
                <table id="read-data">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissnce</th>
                            <th>Création</th>
                            <th>Dernière connexion</th>
                            <th>Actif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($clients)) {
                            // Loop through the project data and display each row in the table
                            foreach ($clients as $client) {
                                echo "<tr>";
                                echo "<td>" . $client['id'] . "</td>";
                                echo "<td>" . $client['first_name'] . "</td>";
                                echo "<td>" . $client['last_name'] . "</td>";
                                echo "<td>" . $client['birthdate'] . "</td>";
                                echo "<td>" . $client['created_at'] . "</td>";
                                echo "<td>" . $client['last_connection'] . "</td>";
                                echo "<td style='text-align: center'>" .
                                    ($client['actif']
                                        ? "<img src='../public/icon/icon-check.svg' alt='Active'>"
                                        : "<img src='../public/icon/icon-cross.svg' alt='Inactive'>")
                                    . "</td>";
                        ?>
                        <?php
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>