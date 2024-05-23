<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
$title = "Connexion";

if (isset($_SESSION['admin'])) {
  header("Location: ../view/view-admin-home.php");
  exit;
} elseif (isset($_SESSION['employee'])) {
  header("Location: ../view/view-employee-admin-home.php");
  exit;
} elseif (isset($_SESSION['client'])) {
  header("Location: ../view/view-user-admin-home.php");
  exit;
} else { ?>
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
      <ul>
        <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Projets</a></li>
        <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-teams.php">Équipes</a></li>
        <li><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-user-registration.php">Inscription</a></li>
      </ul>
    </div>
  </div>



  <form class="form-login" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
    <?php if (isset($_GET['message'])) {
      echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
    } elseif (isset($_GET['message']) && $_GET['message'] == 'success-register') {
      echo "<p class='alert alert-success'>Inscription finalisée, connectez-vous à l'aide de vos identifients</p>";
    } ?>
    <div class="form-group">
      <input type="text" id="lastName" name="lastName" placeholder="Nom" maxlength="100" required>
    </div>

    <div class="form-group">
      <input type="text" id="firstName" name="firstName" placeholder="Prénom" maxlength="100" autofocus required>
    </div>

    <div class="form-group">
      <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="20" required>
    </div>

    <div class="mrg-top-1 cta">
      <input type="submit" name="submit" class="btn" value="Connexion">
    </div>
  </form>
<?php
  include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>