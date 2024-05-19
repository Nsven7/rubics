<?php
$title = "Projets";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/header.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");

$projects = getActiveAndFinalizedProjects();
?>

<div class="container-items">
    <div class="container-content section-one">
        <div class="intro">
            <div class="clr-white">
                <h1>Visionner nos projets et laissez-vous séduire.</h1>
            </div>
        </div>
        <div class="cube">
            <img src="../public/giphy.gif" alt="3D cube">
        </div>
    </div>

    <div class="banner">
        <div class="left clr-white">
            <h2>Filtrez par type selon<br> votre projet ou découvrez<br> nos réalisations.</h2>
        </div>
        <div class="right">
            <select name="cars" id="cars" form="carform">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="opel">Opel</option>
                <option value="audi">Audi</option>
            </select>
            <div class="cta">
                <a class="btn" href="login.html">Réalisations<span class="arrow right"></span></a>
            </div>
        </div>
    </div>

    <div class="container-content">
        <div class="cards">
            <?php
            if (isset($projects)) {
                $projectCount = count($projects);
                $divisibleByFour = $projectCount % 4;

                foreach ($projects as $project) {
                    echo "<div class='card-item'>";
                    echo "<img src='../public/uploads/employees/AliceDoe/AliceDoe.jpg' alt='designer icon'>";
                    echo "<h3>" . $project['name'] . "</h3>";
                    echo "<p class='ft-weight-bold clr-third'>" . $project['description'] . "</p>";
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
    include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/footer.php");
    ?>