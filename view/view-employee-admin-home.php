<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

if (!isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else { ?>


    <div class="main">
        <?php if (isset($_GET['message']) && $_GET['message'] == 'success-data-added') {
            echo "<p class='alert alert-success'>Informations enregistrées avec succés</p>";
        } elseif (isset($_GET['message']) && $_GET['message'] == 'success-register') {
            $employee = $_SESSION['employee']['general']['firstName'] . " " . $_SESSION['employee']['general']['lastName'];
            echo "<p class='alert alert-success'>Bienvenu " . $employee . "</p>";
        } elseif (isset($_GET['message'])) {
            echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
        } ?>
        <h1>Mes informations</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST" enctype="multipart/form-data">
                    <?php if ($_SESSION['employee']['general']['avatar'] != "") { ?>
                        <div class="avatar">
                            <img src="<?php echo $_SESSION['employee']['general']['avatar']; ?>" alt="avatar" />
                        </div>
                    <?php }
                    ?>
                    <div class="field-container">
                        <label for="avatar">Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="field-container">
                        <label for="lastName">Nom</label>
                        <input type="text" id="lastName" name="lastName" minlength="3" maxlength="25" value="<?php echo $_SESSION['employee']['general']['lastName']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="firstName">Prénom</label>
                        <input type="text" id="firstName" name="firstName" autofocus minlength="3" maxlength="25" value="<?php echo $_SESSION['employee']['general']['firstName']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31" value="<?php echo $_SESSION['employee']['general']['birthdate']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="biography">Descrption</label>
                        <input type="text" id="biography" name="biography" value="<?php echo $_SESSION['employee']['general']['biography']; ?>">
                    </div>
                    <div class="field-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="pwd" name="pwd" minlength="8" maxlength="20">
                    </div>
                    <div class="field-container">
                        <label for="confirm_password">Répétez le mot de passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20">
                    </div>
                    <div class="field-container">
                        <label for="team">Équipe</label>
                        <input type="text" id="team" name="team" min="25" max="250" disabled value="<?php echo $_SESSION['employee']['team']['name']; ?>">
                    </div>

                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>