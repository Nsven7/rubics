<?php
$title = "Connexion";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-header.php");

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
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/userController.php" method="POST">
                    <?php if (isset($_GET['message']) && $_GET['message'] == "bad-creditential") {
                        echo "<p class='alert alert-danger'>Informations incorrectes</p>";
                    } ?>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Adresse mail" maxlength="100">
                    </div>

                    <div class="form-group mrg-top-3">
                        <div class="custom-select-wrapper">
                            <select class="custom-select" id="secret_question" name="secret_question"
                                placeholder="Question secrète">
                                <option value="">Select...</option>
                                <option value="pet">Quel est le nom de votre premier animal de compagnie ?</option>
                                <option value="city">Dans quelle ville êtes-vous naî ?</option>
                                <option value="school">Quel est le nom de votre première école ?</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mrg-top-3">
                        <input type="text" id="answer" name="answer" placeholder="Réponse" minlength="2" maxlength="100">
                    </div>

                    <div class="mrg-top-3 cta">
                        <input type="submit" name="submit" class="btn" value="Réinitialiser">
                    </div>
                </form>
            </div>
        </div>


        <?php
        include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-footer.php");
} ?>