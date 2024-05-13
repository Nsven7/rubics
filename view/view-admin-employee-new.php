<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/skillModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");

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
    $teams = activeTeams();
    $skills = activeSkills();

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $employee = employee($id);
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
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-project-new.php">Nouveau
                                    projet</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-project-index.php">Liste
                                    projets</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-project-relation.php">Assigner
                                    projet</a></li>
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
                            <li class="actif-link">Nouvel employé</li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-employee-index.php">Liste
                                    employés</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-skill-new.php">Nouvelle
                                    compétence</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-skill-index.php">Liste
                                    compétences</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-skill-relation.php">Lier
                                    compétence</a></li>
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
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/adminController.php" method="POST" enctype="multipart/form-data">
                            <div class="field-container">
                                <label for="avatar">Image</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <div class="field-container">
                                <label for="lastName">Nom</label>
                                <input type="text" id="lastName" name="lastName" minlength="3" maxlength="25" value="<?php if (isset($employee)) {
                                                                                                                            echo $employee['last_name'];
                                                                                                                        } ?>">
                            </div>
                            <div class="field-container">
                                <label for="firstName">Prénom</label>
                                <input type="text" id="firstName" name="firstName" autofocus minlength="3" maxlength="25" value="<?php if (isset($employee)) {
                                                                                                                                        echo $employee['first_name'];
                                                                                                                                    } ?>">
                            </div>
                            <div class="field-container">
                                <label for="birthdate">Date de naissance</label>
                                <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31" value="<?php if (isset($employee)) {
                                                                                                                                echo $employee['birthdate'];
                                                                                                                            } ?>">
                            </div>
                            <div class="field-container">
                                <label for="biography">Descrption</label>
                                <input type="text" id="biography" name="biography" value="<?php if (isset($employee)) {
                                                                                                echo $employee['biography'];
                                                                                            } ?>">
                            </div>
                            <div class="field-container">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="pwd" name="pwd" minlength="8" maxlength="20" value="<?php if (isset($employee)) {
                                                                                                                    echo $employee[''];
                                                                                                                } ?>">
                            </div>
                            <div class="field-container">
                                <label for="confirm_password">Répétez le mot de passe</label>
                                <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20" value="<?php if (isset($employee)) {
                                                                                                                                                echo $employee[''];
                                                                                                                                            } ?>">
                            </div>
                            <div class="field-container">
                                <label for="teamId">Équipe</label>
                                <select name="teamId" id="teamId">
                                    <?php
                                    // Assuming $teams contains an array of teams fetched from the database where "actif" is 1
                                    foreach ($teams as $team) {
                                        echo '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="field-container">
                                <label for="roleId">Rôle</label>
                                <select name="roleId" id="roleId">
                                    <option value="1">Admin</option>
                                    <option value="2">Employé</option>
                                </select>
                            </div>

                            <?php
                            // Assuming $skills contains an array of skills fetched from the database
                            foreach ($skills as $skill) {
                                echo '<input type="checkbox" name="skills[]" style="margin-right: 1rem" value="' . $skill['id'] . '">' .  $skill['name'] . '<br>';
                            }
                            ?>

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