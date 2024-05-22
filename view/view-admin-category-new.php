<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/categoryModel.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $category = category($id);
}

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else { ?>


    <div class="main">
        <h1>Nouvelle catégorie</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/categoryController.php" method="POST">
                    <div class="field-container">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" minlength="3" maxlength="25" value="<?php if (isset($category)) {
                                                                                                            echo $category['name'];
                                                                                                        } ?>">
                    </div>

                    <div class="field-container">
                        <label for="description">Description</label>
                        <?php if (isset($category)) { ?>
                            <input type="hidden" name="categoryId" value="<?php echo $category['id']; ?>">
                        <?php } ?>

                        <input type="text" id="description" name="description" minlength="10" maxlength="100" value="<?php if (isset($category)) {
                                                                                                                            echo $category['description'];
                                                                                                                        } ?>">
                    </div>

                    <div class="field-container">
                        <label for="actif">Actif</label>
                        <input type="checkbox" id="actif" name="actif" value="1" <?php if (isset($category) && $category['actif']) {
                                                                                        echo 'checked';
                                                                                    } ?>>
                    </div>



                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>