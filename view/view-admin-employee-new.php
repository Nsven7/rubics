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
        $skillsEmployee = getSkills(intval($id));
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

                            <li class="actif-link">
                                <?php echo (isset($employee) ? "Modifier employé" : "Nouvel employé"); ?>
                            </li>

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
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/adminController.php<?php if (isset($id))
                                                                                                                    echo "?id=" . $id; ?>" method="POST" enctype="multipart/form-data">
                            <?php if (isset($employee)) { ?>
                                <div class="avatar">
                                    <img src="<?php echo $employee['avatar']; ?>" alt="avatar" />
                                </div>
                            <?php }
                            ?>
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
                                <input type="password" id="pwd" name="pwd" minlength="8" maxlength="20">
                            </div>
                            <div class="field-container">
                                <label for="confirm_password">Répétez le mot de passe</label>
                                <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20">
                            </div>
                            <div class="field-container">
                                <label for="teamId">Équipe</label>
                                <select name="teamId" id="teamId">
                                    <?php foreach ($teams as $team) : ?>
                                        <option value="<?php echo $team['id']; ?>" <?php if (isset($employee) && $employee['team_id'] == $team['id'])
                                                                                        echo 'selected'; ?>>
                                            <?php echo $team['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="field-container">
                                <label for="priority">Rôle</label>
                                <select name="priority" id="priority">
                                    <option value="1" <?php (isset($employee) && $employee['priority'] == 1) ? 'selected' : ''; ?>>Admin</option>
                                    <option value="2" <?php (isset($employee) && $employee['priority'] == 2) ? 'selected' : ''; ?>>Employee</option>
                                </select>
                            </div>

                            <div class="field-container">
                                <label for="actif">Role actif</label>
                                <input type="checkbox" id="actif" name="actif" value="1" <?php if (isset($employee) && $employee['actif'] == 1) {
                                                                                                echo 'checked';
                                                                                            } ?>>
                            </div>

                            <div class="field-container">
                                <label for="actif">Role actif</label>
                                <input type="checkbox" id="actif" name="roleActif" value="1">
                            </div>

                            <?php
                            foreach ($skills as $skill) {
                                $isChecked = isset($skillsEmployee) && in_array($skill['id'], $skillsEmployee);
                                $checkbox = '<input type="checkbox" name="skills[]" style="margin-right: 1rem" value="' . $skill['id'] . '"';
                                $checkbox .= $isChecked ? ' checked' : '';
                                $checkbox .= '>' . $skill['name'] . '<br>';
                                echo $checkbox;
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