<div class="menu">
    <div class="logo-mobile">
        <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-home.php">
            <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
        </a>
    </div>
    <div class="burger-menu" id="burger-menu">
        &#9776; <!-- Unicode for burger menu icon -->
    </div>
</div>
<div class="menu-overlay" id="menu-overlay">
    <div class="menu-header">
        <span class="close-menu" id="close-menu">&times;</span>
        <div class="logo-mobile">
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-home.php">
                <img class="logo" src="../public/logo_rubics_black.svg" alt="Logo" />
            </a>
        </div>
    </div>
    <div class="menu-content">
        <div class="dropdown" id="dropdown1">
            <div class="dropdown-btn">Mes informations</div>
            <div class="dropdown-content">
                <ul>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-home.php">Modifier mes
                            informations</a></li>
                </ul>
            </div>
        </div>
        <div class="dropdown" id="dropdown2">
            <div class="dropdown-btn">Projets</div>
            <div class="dropdown-content">
                <ul>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-project-index.php">Liste
                            projets</a></li>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-media-new.php">Nouveau
                            média</a></li>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-category-new.php">Nouvelle
                            catégorie</a></li>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-category-index.php">Catégories</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="dropdown" id="dropdown3">
            <div class="dropdown-btn">Équipes</div>
            <div class="dropdown-content">
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
                </ul>
            </div>
        </div>
        <div class="dropdown" id="dropdown4">
            <div class="dropdown-btn">Clients</div>
            <div class="dropdown-content">
                <ul>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-request-index.php">Liste
                            demandes</a></li>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-admin-clients-index.php">Liste
                            clients</a></li>
                </ul>
            </div>
        </div>
        <?php if (isset($_SESSION['admin'])) { ?>
            <li>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/adminController.php" method="POST">
                    <input class="btn" type="submit" value="Déconnexion" name="submit">
                </form>
            </li>
        <?php } elseif (isset($_SESSION['employee'])) { ?>
            <li>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
                    <input class="btn" type="submit" value="Déconnexion" name="submit">
                </form>
            </li>
        <?php } elseif (isset($_SESSION['client'])) { ?>
            <li>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                    <input class="btn" type="submit" value="Déconnexion" name="submit">
                </form>
            </li>
        <?php } ?>
    </div>
</div>
<?php ?>