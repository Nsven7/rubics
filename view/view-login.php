<?php
$title = "Connexion";
include($_SERVER['DOCUMENT_ROOT']."/Rubics/view/component/header.php");
?>

<body>

<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
  <?php if(isset($_GET['message'])){ echo "<p class='alert alert-success'>Inscription finalisée, connectez-vous à l'aide de vos identifients</p>";}  ?>
    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" maxlength="100">
    </div>

    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" minlength="8" maxlength="20">
    </div>

    <div>
      <input type="submit" name="submit" value="Connexion" />
    </div>
  </form>

</body>

</html>

<?php ?>