<?php
$title = "Connexion";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/header.php");
?>

<body>

  <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
    <?php if (isset($_GET['message']) && $_GET['message'] == 'bad-creditential') {
      echo "<p class='alert alert-danger'>Adresse mail ou mot de passe incorrect</p>";
    } elseif (isset($_GET['message'])  && $_GET['message'] == 'success-register') {
      echo "<p class='alert alert-success'>Inscription finalisée, connectez-vous à l'aide de vos identifients</p>";
    }  ?>
    <div>
      <label for="firstName">first name:</label>
      <input type="firstName" id="firstName" name="firstName" maxlength="100">
    </div>

    <div>
      <label for="lastName">last name:</label>
      <input type="lastName" id="lastName" name="lastName" maxlength="100">
    </div>

    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
    </div>

    <div>
      <input type="submit" name="submit" value="Connexion" />
    </div>
  </form>

</body>

</html>

<?php ?>