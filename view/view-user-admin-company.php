<?php
$title = "Admin - Projet";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/companyModel.php");

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} else { 
    $id = $_SESSION['client']['general']['id'];
    $company = getCompany($id)?>

    <div class="container-items">
        <div class="container-content">
            <div class="sidenav">
                <div class="accordionItem">
                    <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                    <div class="accordionContent">
                        <ul>
                            <li class="actif-link"><a
                                    href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-home.php">Modifier
                                    mes informations</a></li>
                        </ul>
                    </div>
                </div>

                <div class="accordionItem">
                    <h2 class="accordionTitle">Projet(s)<span class="accordionIcon"></span></h2>
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
                            <li class="actif-link">Informations liées à mon entreprise</li>
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
                <?php if (isset($_GET['message']) && $_GET['message'] == 'success-company-added') {
                    echo "<p class='alert alert-success'>Informations enregistrées avec succés</p>";
                } elseif (isset($_GET['message'])) {
                    echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
                } ?>

                <h1>Ma société</h1>

                <div class="main-conent">
                    <div class="data-card">
                        <h3>Général</h3>
                        <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/companyController.php"
                            method="POST">
                            <div class="field-container">
                                <label for="name">Nom</label>
                                <input type="text" id="name" name="name" minlength="3" maxlength="25" autofocus value="<?php if (isset($company)) {
                                    echo $company['name'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="vat">TVA</label>
                                <input type="text" id="vat" name="vat" minlength="3" maxlength="25" value="<?php if (isset($company)) {
                                    echo $company['vat'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="country">Country</label>
                                <input type="text" id="country" name="country" minlength="3" maxlength="25" value="<?php if (isset($company)) {
                                    echo $company['country'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="locality">Localité</label>
                                <input type="text" id="locality" name="locality" value="<?php if (isset($company)) {
                                    echo $company['locality'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="zipCode">Code Postal</label>
                                <input type="text" id="zipCode" name="zipCode" minlength="5" maxlength="20" value="<?php if (isset($company)) {
                                    echo $company['zip_code'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="street">Rue</label>
                                <input type="text" id="street" name="street" minlength="8" maxlength="20" value="<?php if (isset($company)) {
                                    echo $company['street'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="number">Numéro</label>
                                <input type="number" id="number" name="number" minlength="8" value="<?php if (isset($company)) {
                                    echo $company['number'];
                                } ?>">
                            </div>

                            <div class="field-container">
                                <label for="comment">Commmentaire</label>
                                <input type="text" id="comment" name="comment" minlength="8" maxlength="20" value="<?php if (isset($company)) {
                                    echo $company['comment'];
                                } ?>">
                            </div>

                            <input class="btn" type="submit" name="submit" value="Enregistrer" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="index.js"></script>
        </body>

        </html>
    <?php } ?>