<?php ?>
<footer>
    <div class="content-footer">
        <div>
            <div class="logo">
                <img class="logo" src="../public/logo_rubics.svg" alt="Logo" />
            </div>
            <div class="clr-white">
                <p>
                    <strong>Siège social</strong><br>
                    59 rue de Caraman<br>
                    7300 Boussu - Belgique<br>
                    0032 (0)472 45 07 03
                </p>
            </div>
        </div>
        <div class="link">
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Projets</a>
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-teams.php">Équipes</a>
            <a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-rgpd.php">R.G.P.D</a>
        </div>
        <div>
            <?php
            if (isset($_SESSION['client'])) { ?>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                    <input class="btn" type="submit" value="Déconnexion" name="submit">
                </form>

            <?php } elseif (isset($_SESSION['employee']) || isset($_SESSION['admin'])) { ?>

                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
                    <input class="btn" type="submit" value="Déconnexion" name="submit">
                </form>

            <?php } else { ?>
                <div class="cta">
                    <a class="btn" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-login.php">Connexion<span class="arrow right"></span></a>
                </div>
                <div class="cta">
                    <a class="btn secondary" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-user-registration.php">S'enregistrer<span class="arrow right"></span></a>
                </div>
            <?php } ?>
        </div>
    </div>
</footer>
<script src="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/asset/js/script-user.js"></script>
</body>
<?php ?>