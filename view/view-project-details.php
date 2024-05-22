<?php
$title = "Projets";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-header.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/realizeModel.php");


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("location" . $_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/view-projects.php");
    exit();
}

$project = getProjectId($id);
$employees = getEmployeesOnProject($id);

?>

<div class="container-items">
    <div class="container-content section-one">
        <div class="intro">
            <div>
                <h1>Visionnez nos projets<br>et laissez-vous séduire.</h1>
            </div>
        </div>
        <div class="cube">
            <img src="../public/giphy.gif" alt="3D cube">
        </div>
    </div>

    <div class="container-content">
        <div class="project-image">
            <img src="../public/uploads/admins/DianaBrown/DianaBrown.jpg" alt="Image du projet">
        </div>
        <div class="project-details">
            <?php if (isset($project)) {
                echo "<h2>" . $project['name'] . "</h2>";
                echo "<p class='ft-weight-bold'>" . $project['description'] . "</p><br><br>";
            }

            if (isset($employees)) {

                $teams = [];
                foreach ($employees as $employee) {
                    $teams[] = $employee['team_name'];
                    $names[] = $employee['first_name'];
                }
                $teams = array_unique($teams);
                $headingTeam = count($teams) > 1 ? "<h3>Équipes</h3>" : "<h3>Équipe</h3>";
                echo $headingTeam;
                echo "<p class='ft-weight-thin'>" . implode(", ", $teams) . "</p><br>";

                $headingEmployee = count($employees) > 1 ? "<h3>Membres</h3>" : "<h3>Membre</h3>";
                echo $headingEmployee;
                echo "<p class='ft-weight-thin'>" . implode(", ", $names) . "</p><br>";

                echo "<h3>Retour client</h3>";
                echo "<p class='ft-weight-thin'>" . $project['comment'] . "</p><br>";
            }
            ?>
        </div>
    </div>

    <?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-footer.php");
    ?>