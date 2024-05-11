<?php
$title = "Admin - Home";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

if (isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} else { ?>

    <div class="container-items">
        <div class="container-content">
            <div class="sidenav">
                <div class="accordionItem">
                    <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li class="actif-link">Modifier mes informations</li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Projet<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-request.php">Nouveau
                                    projet</a></li>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-project.php">Projet(s)
                                    en cours</a></li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Entreprise<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-company.php">Informations
                                    liées à mon entreprise</a></li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Liens<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <a href="index.php?action=updateUser">Home</a>
                    </div>
                </div>
            </div>

            <div class="main">
                <h1>Mes informations</h1>

                <div class="main-conent">
                    <div class="data-card">
                        <h3>Général</h3>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php"
                            method="POST">
                            <div class="field-container">
                                <label for="last_name">Nom</label>
                                <input type="text" id="last_name" name="last_name" minlength="3" maxlength="25"
                                    value="<?php echo $_SESSION['client']['general']['last_name']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="first_name">Prénom</label>
                                <input type="text" id="first_name" name="first_name" autofocus minlength="3" maxlength="25"
                                    value="<?php echo $_SESSION['client']['general']['first_name']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="birthdate">Date de naissance</label>
                                <input type="date" id="birthdate" name="birthdate" min="1950-01-01" max="2006-12-31"
                                    value="<?php echo $_SESSION['client']['general']['birthdate']; ?>">
                            </div>

                            <div class="field-container">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" maxlength="100"
                                    value="<?php echo $_SESSION['client']['identifier']['mail']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" id="username" name="username" minlength="5" maxlength="20"
                                    value="<?php echo $_SESSION['client']['identifier']['username']; ?>">
                            </div>
                            <div class="field-container">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" minlength="8" maxlength="20">
                            </div>
                            <div class="field-container">
                                <label for="confirm_password">Répétez le mot de passe</label>
                                <input type="password" id="confirm_password" name="confirm_password" minlength="8"
                                    maxlength="20">
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
                                <input type="text" id="answer" name="answer" minlength="5" maxlength="100"
                                    value="<?php echo $_SESSION['client']['identifier']['secret_answer']; ?>">
                            </div>

                            <input class="btn" type="submit" name="submit" value="S'enregistrer" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="index.js"></script>
        </body>

        </html>
    <?php } ?>