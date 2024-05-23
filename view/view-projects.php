<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/categoryModel.php");
$title = "Projets";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else
    $id = null;

//$projects = getAllProjects();
$projects = finalizedProjects($id);
$categories = activeCategories();

?>

<div class="container-items">
    <div class="container-content section-one">
        <div class="intro">
            <div>
                <h1>Visionner nos projets et laissez-vous séduire.</h1>
            </div>
        </div>
        <div class="cube">
            <img src="../public/giphy.gif" alt="3D cube">
        </div>
    </div>

    <div class="banner">
        <div class="left">
            <h2>Filtrez par type selon votre projet ou découvrez nos réalisations.</h2>
        </div>
        <div class="right">
            <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/projectController.php" method="POST">
                <div class="field-container">
                    <select name="categoryId" id="categoryId">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>" <?php if (isset($id) && $id == $category['id'])
                                                                                echo 'selected'; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input class="btn" type="submit" name="submit" value="Appliquer" />
                </div>

            </form>
        </div>
    </div>

    <div class="container-content">
        <div class="cards">
            <?php
            if (isset($projects)) {
                $projectCount = count($projects);
                $divisibleByFour = $projectCount % 4;

                foreach ($projects as $project) {

                    echo "<div class='card-item rectangle'>";
                    echo "<a href='view-project-details.php?id=" . $project['id'] . "'>";
                    echo "<img src='../public/uploads/employees/AliceDoe/AliceDoe.jpg' alt='designer icon'>";
                    echo "<h3>" . $project['name'] . "</h3>";
                    echo "<p class='ft-weight-bold clr-third'>" . $project['description'] . "</p>";
                    echo "</a>";
                    echo "</div>";
                }

                if ($divisibleByFour !== 0) {
                    $additionalDivs = 4 - $divisibleByFour;
                    for ($i = 0; $i < $additionalDivs; $i++) {
                        echo "<div class='card-item empty'></div>";
                    }
                }
            }
            ?>

        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-footer.php");
    ?>