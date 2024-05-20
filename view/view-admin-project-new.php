<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/requestModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");

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



    <div class="container-items">
        <div class="container-content">
            <div class="sidenav">
                <div class="accordionItem">
                    <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li>
                                <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-home.php">
                                    Modifier mes informations
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Projets<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li class="actif-link">
                                <?php echo (isset($_GET['id-project']) ? "Modifier projet" : "Nouveau projet"); ?>
                            </li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-project-index.php">Liste
                                    projets</a></li>
                                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-media-new.php">Nouveau média</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-category-new.php">Nouvelle
                                    catégorie</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-category-index.php">Catégories</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Équipes<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-team-new.php">Nouvelle
                                    équipe</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-team-index.php">Liste
                                    équipes</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-employee-new.php">Nouvel employé
                                </a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-employee-index.php">Liste
                                    employés</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-skill-new.php">Nouvelle
                                    compétence</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-skill-index.php">Liste
                                    compétences</a></li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Clients<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-request-index.php">Liste
                                    demandes</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-clients-index.php">Liste
                                    clients</a></li>
                        </ul>
                    </div>
                </div>
            </div>

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
        </div>

        <script src="index.js"></script>
        </body>

        </html>
    <?php } ?>