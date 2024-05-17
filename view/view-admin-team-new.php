<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $team = team($id);
}

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

                            <li class="actif-link">
                                <?php echo (isset($team) ? "Modifier équipe" : "Nouvelle équipe"); ?>
                            </li>
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
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/teamController.php" method="POST">
                            <div class="field-container">
                                <label for="name">Nom</label>
                                <?php if (isset($team)) { ?>
                                    <input type="hidden" name="teamId" value="<?php echo $team['id']; ?>">
                                <?php } ?>
                                <input type="text" id="name" name="name" minlength="2" maxlength="25" value="<?php if (isset($team)) {
                                                                                                                    echo $team['name'];
                                                                                                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="actif">Actif</label>
                                <input type="checkbox" id="actif" name="actif" value="1" <?php if (isset($team) && $team['actif']) {
                                                                                                echo 'checked';
                                                                                            } ?>>
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