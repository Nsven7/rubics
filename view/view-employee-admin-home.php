<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

if (!isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else { ?>

<div class="container-items">
    <div class="container-content">
        <div class="sidenav">
            <div class="accordionItem">
                <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li class="actif-link">Modifier mes informations</li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Projet<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-employee-admin-project.php">Projet(s) en cours</a></li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Mes compétences<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-employee-admin-skill.php">Voir mes compétencess</a></li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Liens<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <a href="index.php?action=updateUser">Home</a>
                </div>
            </div>
        </div>

        <div class="main">
            <h1>Mes informations</h1>

            <div class="main-conent">
                <div class="data-card">
                    <h3>Général</h3>
                    <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                        <div class="field-container">
                            <label for="avatar">Image</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                        <div class="field-container">
                            <label for="last_name">Nom</label>
                            <input type="text" id="last_name" name="last_name" minlength="3" maxlength="25" value="<?php echo $_SESSION['employee']['general']['last_name']; ?>">
                        </div>
                        <div class="field-container">
                            <label for="first_name">Prénom</label>
                            <input type="text" id="first_name" name="first_name" autofocus minlength="3" maxlength="25" value="<?php echo $_SESSION['employee']['general']['first_name']; ?>">
                        </div>
                        <div class="field-container">
                            <label for="birthdate">Date de naissance</label>
                            <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31" value="<?php echo $_SESSION['employee']['general']['birthdate']; ?>">
                        </div>
                        <div class="field-container">
                            <label for="biography">Descrption</label>
                            <input type="text" id="biography" name="biography" value="<?php echo $_SESSION['employee']['general']['biography']; ?>">
                        </div>
                        <div class="field-container">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" minlength="8" maxlength="20">
                        </div>
                        <div class="field-container">
                            <label for="confirm_password">Répétez le mot de passe</label>
                            <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20">
                        </div>
                        <div class="field-container">
                            <label for="team">Équipe</label>
                            <input type="text" id="team" name="team" min="25" max="250" disabled value="<?php echo $_SESSION['employee']['team']['name']; ?>">
                        </div>

                        <input class="btn" type="submit" name="submit" value="S'enregistrer" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
    </body>

    </html>

<?php } ?>