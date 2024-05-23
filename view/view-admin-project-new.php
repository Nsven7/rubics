<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/requestModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
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
    $employees = getActiveEmployeesByTeam();

    if (isset($_GET['id-project'])) {
        $idProject = intval($_GET['id-project']);
        $project = getProjectId(intval($idProject));
        $projectEmployees = getEmployees(intval($idProject));
    } else {
        $idRequest = intval($_GET['id-request']);
    }

?>


    <div class="main">
        <h1>Mes informations</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/projectController.php<?php if (isset($idProject)) echo "?id-project=" . $idProject;
                                                                                                        else echo "?id-request=" . $idRequest; ?>" method="POST">

                    <div class="field-container">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" minlength="3" maxlength="25" autofocus value="<?php if (isset($project)) {
                                                                                                                    echo $project['name'];
                                                                                                                } ?>">
                    </div>

                    <div class="field-container">
                        <label for="description">Descrption</label>
                        <input type="text" id="description" name="description" value="<?php if (isset($project)) {
                                                                                            echo $project['description'];
                                                                                        } ?>">
                    </div>

                    <div class="field-container">
                        <label for="createdAt">Date de commencement</label>
                        <input type="date" id="createdAt" name="createdAt" min="1950-01-01" max="2006-12-31" value="<?php if (isset($project)) {
                                                                                                                        echo $project['created_at'];
                                                                                                                    } ?>">
                    </div>

                    <div class="field-container">
                        <label for="finishedAt">Date de fin</label>
                        <input type="date" id="finishedAt" name="finishedAt" min="1950-01-01" max="2006-12-31" value="<?php if (isset($project)) {
                                                                                                                            echo $project['finished_at'];
                                                                                                                        } ?>">
                    </div>

                    <div class="field-container">
                        <label for="finalized">Finalisé</label>
                        <input type="checkbox" id="finalized" name="finalized" value="1">
                    </div>


                    <?php foreach ($employees as $employee) {
                        $isChecked = isset($projectEmployees) && in_array($employee['id'], $projectEmployees);
                        $checkbox = '<input type="checkbox" name="employees[]" style="margin-right: 1rem" value="' . $employee['id'] . '"';
                        $checkbox .= $isChecked ? ' checked' : '';
                        $checkbox .= '>' . $employee['last_name'] . ' ' . $employee['first_name'] . '<br>';
                        echo $checkbox;
                    } ?>


                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>