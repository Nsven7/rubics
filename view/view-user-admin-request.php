<?php
$title = "Admin - Demande";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");

// Check if session data exists
if (!isset($_SESSION['categories'])) {
    // Redirect back to the controller to fetch session data
    header("Location: ../controller/requestController.php");
    exit;
}
$categories = $_SESSION['categories'];
?>

<div class="container-items">
    <div class="container-content">
        <div class="sidenav">
            <div class="accordionItem">
                <h2 class="accordionTitle">Mes informations<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-home.php">Modifier mes informations</a></li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Projet<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li class="actif-link">Nouveau projet</li>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-project.php">Projet(s) en cours</a></li>
                    </ul>
                </div>
            </div>

            <div class="accordionItem">
                <h2 class="accordionTitle">Entreprise<span class="accordionIcon"></span></h2>
                <div class="accordionContent">
                    <ul>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/view/view-user-admin-company.php">Informations liées à mon entreprise</a></li>
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
        <h1>Nouvelle demande</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/requestController.php" method="POST">
                    <div class="field-container">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name">
                    </div>

                    <div class="field-container">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description">
                    </div>

                    <div class="field-container">
                        <label for="budget">Bugget</label>
                        <input type="number" id="budget" name="budget">
                    </div>

                    <label for="category">Catégorie</label>
                    <select name="category">
                        <?php foreach ($_SESSION['categories'] as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
</div>

<script src="index.js"></script>
</body>

</html>