<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
$title = "Admin - Home";

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} else { ?>



    <div class="main">
        <?php if (isset($_GET['message']) && $_GET['message'] == 'success-data-updated') {
            echo "<p class='alert alert-success'>Informations mises à jours avec succés</p>";
        }
        if (isset($_GET['message']) && $_GET['message'] == 'success-logged') {
            echo "<p class='alert alert-success'>Bienvenu " . $_SESSION['client']['general']['first_name'] . "</p>";
        }
        if (isset($_GET['message']) && $_GET['message'] == 'reinitialize-password') {
            echo "<p class='alert alert-success'>Veuillez réinitialiser votre mot de passe</p>";
        } ?>

        <h1>Mes informations</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                    <div class="field-container">
                        <label for="last_name">Nom</label>
                        <input type="text" id="last_name" name="last_name" minlength="3" maxlength="25" value="<?php echo $_SESSION['client']['general']['last_name']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="first_name">Prénom</label>
                        <input type="text" id="first_name" name="first_name" autofocus minlength="3" maxlength="25" value="<?php echo $_SESSION['client']['general']['first_name']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31" value="<?php echo $_SESSION['client']['general']['birthdate']; ?>">
                    </div>

                    <div class="field-container">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" maxlength="100" value="<?php echo $_SESSION['client']['identifier']['mail']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" minlength="5" maxlength="20" value="<?php echo $_SESSION['client']['identifier']['username']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" minlength="8" maxlength="20">
                    </div>
                    <div class="field-container">
                        <label for="confirm_password">Répétez le mot de passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20">
                    </div>

                    <div>
                        <label for="secret_question">Secret Question:</label>
                        <select id="secret_question" name="secret_question">
                            <option value="pet" <?php if ($_SESSION['client']['identifier']['secret_question'] == "pet") {
                                                    echo "selected";
                                                } ?>>What is your pet name?</option>
                            <option value="color" <?php if ($_SESSION['client']['identifier']['secret_question'] == "color") {
                                                        echo "selected";
                                                    } ?>>What is your favorite color?</option>
                            <option value="school" <?php if ($_SESSION['client']['identifier']['secret_question'] == "school") {
                                                        echo "selected";
                                                    } ?>>What is your mother's maiden name?</option>
                        </select>
                    </div>
                    <div>
                        <label for="answer">Answer:</label>
                        <input type="text" id="answer" name="answer" minlength="5" maxlength="100" value="<?php echo $_SESSION['client']['identifier']['secret_answer']; ?>">
                    </div>

                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>