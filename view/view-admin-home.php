<?php
$title = "Admin - Home";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
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
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-category-index.php">Catégories</a></li>
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
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-employee-new.php">Nouvel
                                    employé</a></li>
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
                <?php if (isset($_GET['message']) && $_GET['message'] == 'success-data-added') {
                    echo "<p class='alert alert-success'>Informations enregistrées avec succés</p>";
                } elseif (isset($_GET['message']) && $_GET['message'] == 'success-register') {
                    $admin = $_SESSION['admin']['general']['firstName'] . " " . $_SESSION['admin']['general']['lastName'];
                    echo "<p class='alert alert-success'>Bienvenu " . $admin . "</p>";
                } elseif (isset($_GET['message'])) {
                    echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
                } ?>
                <h1>Mes informations</h1>

                <div class="main-conent">
                    <div class="data-card">
                        <h3>Général</h3>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php"
                            method="POST" enctype="multipart/form-data">
                            <?php if ($_SESSION['admin']['general']['avatar'] != "") { ?>
                                <div class="avatar">
                                    <img src="<?php echo $_SESSION['admin']['general']['avatar']; ?>" alt="avatar" />
                                </div>
                            <?php }
                            ?>
                            <div class="field-container">
                                <label for="avatar">Image</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <div class="field-container">
                                <label for="lastName">Nom</label>
                                <input type="text" id="lastName" name="lastName" minlength="3" maxlength="25"
                                    value="<?php echo $_SESSION['admin']['general']['lastName']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="firstName">Prénom</label>
                                <input type="text" id="firstName" name="firstName" autofocus minlength="3" maxlength="25"
                                    value="<?php echo $_SESSION['admin']['general']['firstName']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="birthdate">Date de naissance</label>
                                <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31"
                                    value="<?php echo $_SESSION['admin']['general']['birthdate']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="biography">Descrption</label>
                                <input type="text" id="biography" name="biography"
                                    value="<?php echo $_SESSION['admin']['general']['biography']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="pwd" name="pwd" minlength="8" maxlength="20">
                            </div>
                            <div class="field-container">
                                <label for="confirm_password">Répétez le mot de passe</label>
                                <input type="password" id="confirm_password" name="confirm_password" minlength="8"
                                    maxlength="20">
                            </div>
                            <div class="field-container">
                                <label for="team">Équipe</label>
                                <input type="text" id="team" name="team" min="25" max="250" disabled
                                    value="<?php echo $_SESSION['admin']['team']['name']; ?>">
                            </div>

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