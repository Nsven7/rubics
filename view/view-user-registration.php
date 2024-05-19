<?php
$title = "S'enregistrer";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/header.php");

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
      <div class="clr-white">
        <h1>Pas de compte ?</h1>
        <p>Inscrivez-vous pour accéder à toutes les fonctionnalités de notre service.<br>
          Gérez vos projets au même endroit.
        </p>
      </div>
    </div>
    <div class="form-right blur">
      <h3>S'enregistrer</h3>
      <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
        <?php if (isset($_GET['message'])) {
          echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
        } ?>


        <div class="form-group">
          <input type="text" id="last_name" name="last_name" placeholder="Nom" autofocus minlength="3" maxlength="25">
          <input type="text" id="first_name" name="first_name" placeholder="Prénom" minlength="3" maxlength="25">
        </div>

        <div class="form-group">
          <input type="date" id="birthdate" name="birthdate" placeholder="Date de naissance" min="1950-01-01"
            max="2006-12-31">
          <input type="email" id="email" name="email" placeholder="Adresse mail" maxlength="100">
        </div>

        <div class="form-group">
          <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" minlength="5" maxlength="20">
          <div></div>
        </div>

        <div class="form-group">
          <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="20">
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmer mot de passe"
            minlength="8" maxlength="20">
        </div>

        <div class="form-group">
          <div class="custom-select-wrapper">
            <select class="custom-select" id="secret_question" name="secret_question" placeholder="Question secrète">
              <option value="">Select...</option>
              <option value="pet">Quel est le nom de votre premier animal de compagnie ?</option>
              <option value="city">Dans quelle ville êtes-vous naî ?</option>
              <option value="school">Quel est le nom de votre première école ?</option>
            </select>
          </div>
          <input type="text" id="answer" name="answer" placeholder="Réponse" minlength="2" maxlength="100">
        </div>

        <div>
          <span class="terms"><input type="checkbox" id="terms" name="terms">
            <label class="clr-white" for="terms">J'accepte les termes et conditions</label>
        </div>
        <div>
          <div class="cta">
            <input type="submit" class="btn" value="Enregistrer">
            <span class="arrow right"></span>
          </div>
        </div>
        <div>
          <h3 class="mrg-top-2">Déjà inscrit ?</h3>
          <div class="cta">
            <a class="btn" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-login.php">Connection</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php
  include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/footer.php");
} ?>