<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/categoryModel.php");
$title = "Admin - Demande";

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
    $categories = activeCategories();
?>


    <div class="main">
        <?php if (isset($_GET['message'])) {
            echo "<p class='alert alert-danger'>" . $_GET['message'] . "</p>";
        } ?>
        <h1>Nouvelle demande</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/requestController.php" method="POST">
                    <div class="field-container">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" minlength="3" maxlength="50" required autofocus>
                    </div>

                    <div class="field-container">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" minlength="10" maxlength="255" required>
                    </div>

                    <div class="field-container">
                        <label for="budget">Budget</label>
                        <input type="number" id="budget" name="budget" min="1" max="10000" required>
                    </div>

                    <label for="category">Catégorie</label>
                    <select name="category">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>