<?php ?>

<div class="sidenav">
    <div class="accordionItem">
        <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
        <div class="accordionContent">
            <ul>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-home.php">Modifier
                        mes informations</a></li>
                <li>
                    <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                        <input class="btn" type="submit" value="Supprimer" name="submit">
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="accordionItem">
        <h2 class="accordionTitle">Projet<span class="accordionIcon"></span></h2>
        <div class="accordionContent">
            <ul>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-request.php">Nouveau
                        projet</a></li>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-project.php">Projet(s)
                        en cours</a></li>
            </ul>
        </div>
    </div>

    <div class="accordionItem">
        <h2 class="accordionTitle">Entreprise<span class="accordionIcon"></span></h2>
        <div class="accordionContent">
            <ul>
                <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-company.php">Informations
                        liées à mon entreprise</a></li>
            </ul>
        </div>
    </div>
</div>