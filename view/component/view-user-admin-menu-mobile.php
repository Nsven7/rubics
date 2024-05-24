<?php ?>
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
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-home.php">Modifier
                            mes informations</a>
                    </li>
                    <li>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                            <input class="btn" type="submit" value="Supprimer" name="submit">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="dropdown" id="dropdown2">
            <div class="dropdown-btn">Projets</div>
            <div class="dropdown-content">
                <ul>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-request.php">Nouveau
                            projet</a></li>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-project.php">Projet(s)
                            en cours</a></li>
                </ul>
            </div>
        </div>
        <div class="dropdown" id="dropdown3">
            <div class="dropdown-btn">Entreprise</div>
            <div class="dropdown-content">
                <ul>
                    <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-company.php">Informations
                            liées à mon entreprise</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>