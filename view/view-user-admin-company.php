<?php
$title = "Admin - Projet";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
?>

<div class="container-items">
    <div class="container-content">
        <div class="sidenav">
            <div class="accordionItem">
                <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-home.php">Modifier mes informations</a>
                <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-project.php">Project en cours</a>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Entreprise<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                <a href="#">Informations liées à mon entreprise</a>
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
            <h1>Mes entreprise</h1>

            <div class="main-conent">
                <div class="data-card">
                    <h3>Général</h3>
                    <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/companyController.php"
                        method="POST">
                        <div class="field-container">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" minlength="3" maxlength="25">
                        </div>
                        
                        <div class="field-container">
                            <label for="vat">TVA</label>
                            <input type="text" id="vat" name="vat" autofocus minlength="3" maxlength="25">
                        </div>

                        <div class="field-container">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" autofocus minlength="3" maxlength="25">
                        </div>

                        <div class="field-container">
                            <label for="locality">Localité</label>
                            <input type="text" id="locality" name="locality" maxlength="100">
                        </div>

                        <div class="field-container">
                            <label for="zipCode">Code Postal</label>
                            <input type="text" id="zipCode" name="zipCode" minlength="5" maxlength="20">
                        </div>

                        <div class="field-container">
                            <label for="street">Rue</label>
                            <input type="text" id="street" name="street" minlength="8" maxlength="20">
                        </div>

                        <div class="field-container">
                            <label for="number">Numéro</label>
                            <input type="number" id="number" name="number" minlength="8"
                                maxlength="20">
                        </div>

                        <div class="field-container">
                            <label for="comment">Commmentaire</label>
                            <input type="text" id="comment" name="comment" minlength="8"
                                maxlength="20">
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