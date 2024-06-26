<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");
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
    if (isset($_GET['id-request'])) {
        $idRequest = intval($_GET['id-request']);
    }
    if (isset($_GET['id-project'])) {
        $idProject = intval($_GET['id-project']);
    }

    $projects = getAllProjects();
?>



    <div class="main">
        <h1>Projets</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Liste</h3>
                <table id="read-data">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date de commencement</th>
                            <th>Date de cloture</th>
                            <th>Réalisé</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($projects)) {
                            // Loop through the project data and display each row in the table
                            foreach ($projects as $project) {
                                echo "<tr>";

                                echo "<td>" . $project['name'] . "</td>";
                                echo "<td>" . $project['description'] . "</td>";
                                echo "<td>" . $project['created_at'] . "</td>";
                                echo "<td>" . $project['finished_at'] . "</td>";
                                echo "<td style='text-align: center'>" .
                                    ($project['finalized']
                                        ? "<img src='../public/icon/icon-check.svg' alt='Active'>"
                                        : "<img src='../public/icon/icon-cross.svg' alt='Inactive'>")
                                    . "</td>";
                        ?>
                                <td style="text-align: center">
                                    <a href="view-admin-project-new.php?id-project=<?php echo $project['id']; ?>">

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