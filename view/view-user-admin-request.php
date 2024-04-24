<?php
$title = "Admin - Projet";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

// Check if session data exists
if (!isset($_SESSION['test'])) {
    // Redirect back to the controller to fetch session data
    header("Location: ../controller/requestController.php");
    exit;
}

?>

<div class="container-items">
    <!-- <div class="container-content">
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
        </div> -->

    <div class="main">
        <!-- <h1>Nouvelle demande</h1> -->

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/requestController.php" method="POST">

                    <div class="field-container">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" minlength="3" maxlength="25">
                    </div>

                    <div class="field-container">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" minlength="3" maxlength="25">
                    </div>

                    <div class="field-container">
                        <label for="budget">Bugget</label>
                        <input type="number" id="budget" name="budget" minlength="3" maxlength="25">
                    </div>

                    <?php die(var_dump($_SESSION['test'])); ?>
                    <select name="options">
                        <?php
                        // Loop through options and populate select
                        foreach ($selectOptions as $option) {
                            echo "<option value=\"$option\">$option</option>";
                        }
                        ?>
                    </select>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="index.js"></script>
</body>

</html>