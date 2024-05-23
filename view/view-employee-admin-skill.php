<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-header.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/skillModel.php");
$title = "Admin - Demande";

if (!isset($_SESSION['employee']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-login.php");
    exit;
} elseif (isset($_SESSION['admin'])) {
    header("Location: ../view/view-admin-home.php");
    exit;
} elseif (isset($_SESSION['client'])) {
    header("Location: ../view/view-user-admin-home.php");
    exit;
} else {
    $skills = getSkillsEmployee($_SESSION['employee']['general']['id']);
?>

    <div class="main">
        <h1>Mes compétences</h1>

        <div class="main-conent">
            <div class="data-card">
                <h3>Tags</h3>
                <?php foreach ($skills as $skill) : ?>
                    <span class="badge rounded-pill bg-success"><?php echo $skill['skill_name'] ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-admin-footer.php");
} ?>