<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $team = team($id);
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
        <h1>Nouvelle équipe</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Général</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/teamController.php" method="POST">
                    <div class="field-container">
                        <label for="name">Nom</label>
                        <?php if (isset($team)) { ?>
                            <input type="hidden" name="teamId" value="<?php echo $team['id']; ?>">
                        <?php } ?>
                        <input type="text" id="name" name="name" minlength="2" maxlength="25" value="<?php if (isset($team)) {
                                                                                                            echo $team['name'];
                                                                                                        } ?>">
                    </div>

                    <div class="field-container">
                        <label for="actif">Actif</label>
                        <input type="checkbox" id="actif" name="actif" value="1" <?php if (isset($team) && $team['actif']) {
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