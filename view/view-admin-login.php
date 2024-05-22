<?php
$title = "Connexion";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

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

  <body>

    <div class="container-content section-one">
      <div class="form-centre blur">
        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
          <?php if (isset($_GET['message'])) {
            echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
          } elseif (isset($_GET['message']) && $_GET['message'] == 'success-register') {
            echo "<p class='alert alert-success'>Inscription finalisée, connectez-vous à l'aide de vos identifients</p>";
          } ?>
          <div class="form-group">
            <input type="text" id="lastName" name="lastName" placeholder="Nom" maxlength="100" required>
          </div>

          <div class="form-group">
            <input type="text" id="firstName" name="firstName" placeholder="Prénom" maxlength="100" autofocus
              required>
          </div>

          <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="8" maxlength="20"
              required>
          </div>

          <div class="mrg-top-1 cta">
            <input type="submit" name="submit" class="btn" value="Connexion">
          </div>
        </form>
      </div>
    </div>
  <?php } ?>