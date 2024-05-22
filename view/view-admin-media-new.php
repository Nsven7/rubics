<?php
$title = "Admin - Home";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");

if (!isset($_SESSION['client']) && !isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-login.php");
    exit;
} elseif (isset($_SESSION['employee'])) {
    header("Location: ../view/view-employee-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else {
    $projects = getAllProjects();
?>

    <div class="main">
        <h1>Nouveau media</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Projet</h3>
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/mediaController.php" method="POST" enctype="multipart/form-data">
                    <div class="field-container">
                        <label for="projectId">Projet</label>
                        <select name="projectId" id="projectId">
                            <?php foreach ($projects as $project) : ?>
                                <option value="<?php echo $project['id']; ?>">
                                    <?php echo $project['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field-container">
                        <label for="files">Images</label>
                        <input type="file" name="files[]" multiple>
                    </div>

                    <input class="btn" type="submit" name="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>