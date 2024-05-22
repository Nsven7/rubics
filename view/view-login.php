<?php
$title = "Connection";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-header.php");

if (isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
  header("Location: ../view/view-user-admin-home.php");
  exit;
} elseif (isset($_SESSION['admin'])) {
  header("Location: ../view/view-admin-home.php");
  exit;
} elseif (isset($_SESSION['employee'])) {
  header("Location: ../view/view-employee-admin-home.php");
  exit;
} else { ?>

  <div class="container-form section-one">
    <div class="form-left">
      <div>
        <h1>Déjà inscrit ?</h1>
        <p>Connectez-vous à votre compte pour suivre et gérer vos projets.
        </p>
      </div>
    </div>
    <div class="form-right blur">
      <h3>Se connecter</h3>
      <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
        <?php if (isset($_GET['message']) && $_GET['message'] == 'bad-creditential') {
          echo "<p class='alert alert-danger'>Adresse mail ou mot de passe incorrect</p>";
        } elseif (isset($_GET['message']) && $_GET['message'] == 'success-register') {
          echo "<p class='alert alert-success'>Inscription finalisée, connectez-vous à l'aide de vos identifients</p>";
        } ?>
        <div class="'mrg-top-2 form-group">
          <input type="email" id="email" autofocus placeholder="Adresse mail" name="email" maxlength="100" required>
        </div>

        <div class="'mrg-top-2 form-group" required>
          <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="20"
            required required>
        </div>

        <div>
          <a class='mrg-top-2' href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-user-password.php">Mot de passe
            oublié</a>
        </div>
        <div>
          <div class="mrg-top-1 cta">
            <input type="submit" name="submit" class="btn" value="Connexion">
            <span class="arrow right"></span>
          </div>
        </div>

        <div>
          <h3 class="mrg-top-2">Pas de compte ?</h3>
          <div class="cta">
            <a class="btn"
              href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-user-registration.php">S'enregistrer</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php
  include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-footer.php");
} ?>