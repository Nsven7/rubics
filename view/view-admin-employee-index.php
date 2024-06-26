<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
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
    $employees = employees($_SESSION['admin']['general']['id']);
?>



    <div class="main">
        <h1>Employés</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Liste</h3>
                <table id="read-data">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Création</th>
                            <th>Actif</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($employees)) {
                            // Loop through the project data and display each row in the table
                            foreach ($employees as $employee) {
                                echo "<tr>";
                                echo "<td>" . $employee['id'] . "</td>";
                                echo "<td>" . $employee['first_name'] . "</td>";
                                echo "<td>" . $employee['last_name'] . "</td>";
                                echo "<td>" . $employee['birthdate'] . "</td>";
                                echo "<td>" . $employee['created_at'] . "</td>";
                                echo "<td style='text-align: center'>" .
                                    ($employee['actif']
                                        ? "<img src='../public/icon/icon-check.svg' alt='Active'>"
                                        : "<img src='../public/icon/icon-cross.svg' alt='Inactive'>")
                                    . "</td>";


                        ?>
                                <td style="text-align: center">
                                    <a href="view-admin-employee-new.php?id=<?php echo $employee['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                </td>
                        <?php
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