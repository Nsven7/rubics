<?php
$title = "S'enregistrer";
include($_SERVER['DOCUMENT_ROOT']."/Rubics/view/component/header.php");

if (isset($_SESSION['client']) && !isset($_SESSION['employee'])) {
  header("Location: ../view/view-user-admin-home.php");
  exit;
} elseif (isset($_SESSION['employee'])) {
  header("Location: ../view/view-employee-admin-home.php");
  exit;
} else { ?>

<body>

  <h2>Registration Form</h2>

  <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
  <?php if(isset($_GET['message'])){ echo "<p class='alert alert-danger'>". $_GET['message'] . "</p>";}  ?>
  

    <div>
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" autofocus minlength="3" maxlength="25">
    </div>
    <div>
      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" minlength="3" maxlength="25">
    </div>
    <div>
      <label for="birthdate">Birthdate:</label>
      <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31">
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" maxlength="100">
    </div>
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" minlength="5" maxlength="20">
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" minlength="8" maxlength="20">
    </div>
    <div>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20">
    </div>
    <div>
      <label for="secret_question">Secret Question:</label>
      <select id="secret_question" name="secret_question">
        <option value="">Select...</option>
        <option value="pet">What is the name of your first pet?</option>
        <option value="city">What city were you born in?</option>
        <option value="school">What is the name of your first school?</option>
      </select>
    </div>
    <div>
      <label for="answer">Answer:</label>
      <input type="text" id="answer" name="answer" minlength="2" maxlength="100">
    </div>
    <div>
      <input type="checkbox" id="terms" name="terms">
      <label for="terms">I agree to the terms and conditions</label>
    </div>
    <div>
      <input type="submit" name="submit" value="S'enregistrer" />
    </div>
  </form>

</body>

</html>

<?php } ?>