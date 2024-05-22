<?php
$title = "Accueil";
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-header.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/projectModel.php");

$projects = getAllProjects();
?>
<div class="container-items">
    <div class="container-content section-one">
        <div class="intro">
            <div>
                <h1>Rubics, l'agence multi-facettes aux servvices de votre projet.</h1>
                <p>Charte graphique, développement web, print, vidéo... Nous vous accompagnons dans votre projet.</p>
            </div>
        </div>
        <div class="cube">
            <img src="../public/giphy.gif" alt="3D cube">
        </div>
    </div>

    <div class="container-content section-two">
        <div class="left">
            <div>
                <h2>Nos compétences à votre service.</h2>
                <div class="cta">
                    <a class="btn"
                        href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-projects.php">Réalisations<span
                            class="arrow right"></span></a>
                </div>
            </div>
        </div>
        <div class="right">
            <div>
                <img src="../public/icon/icon-designer.svg" alt="designer icon">
                <h3>Infographie</h3>
                <p>Charte graphique, création de logo, print, réseaux sociaux, nous réaliserons votre identité visuelle
                    du début à la fin.</p>
            </div>

            <div>
                <img src="../public/icon/icon-camera.svg" alt="camera icon">
                <h3>Photographie</h3>
                <p>Produit, images d’ambiance, shooting model… Nous avons le matériel et les idées pour sublimer votre
                    projet.</p>
            </div>

            <div>
                <img src="../public/icon/icon-video.svg" alt="video icon">
                <h3>Monteur vidéo</h3>
                <p>Découper des scènes, incruster un arrière-plan, ajouter des effets visuels, du texte, des voix-off,
                    nous mettons tout en oeuvre pour enrichir l'expérience audiovisuelle.</p>
            </div>

            <div>
                <img src="../public/icon/icon-code.svg" alt="code icon">
                <h3>Web</h3>
                <p>Back-end, front-end, refonte… Faites-nous confiance et laissez votre site entre les mains de nos
                    développeurs.</p>
            </div>
        </div>
    </div>

    <div class="container-content section-three">
        <div class="left">
            <div class="card-item">
                <img src="../public/uploads/employees/AliceDoe/AliceDoe.jpg" alt="designer icon">
                <h3>Henry</h3>
                <p class="ft-weight-bold clr-third">Développeur web<br> front-end</p>
            </div>

            <div class="card-item">
                <img src="../public/uploads/employees/AliceDoe/AliceDoe.jpg" alt="designer icon">
                <h3>Henry</h3>
                <p class="ft-weight-bold clr-third">Développeur web<br> front-end</p>
            </div>

            <div class="card-item">
                <img src="../public/uploads/employees/AliceDoe/AliceDoe.jpg" alt="designer icon">
                <h3>Henry</h3>
                <p class="ft-weight-bold clr-third">Développeur web<br> front-end</p>
            </div>

            <div class="card-item">
                <img src="../public/uploads/employees/AliceDoe/AliceDoe.jpg" alt="designer icon">
                <h3>Henry</h3>
                <p class="ft-weight-bold clr-third">Développeur web<br> front-end</p>
            </div>
        </div>
        <div class="right">
            <h2>Faîtes connaissance de notre grande famille.</h2>
            <div class="cta">
                <a class="btn" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/view/view-teams.php">Découvrir<span
                        class="arrow right"></span></a>
            </div>
        </div>
    </div>
    <div class="slider">

        <?php
        foreach ($projects as $project) {
            echo "<div class='slide'>";
            echo "<h3>" . $project['name'] . "</h3><br>";
            echo "<p class='clr-white'>" . $project['comment'] . "</p>";

            echo "<div class='cta'>";
            echo "<a class='btn' href='view-project-details.php?id=" . $project['id'] . "'>Voir projet<span class='arrow right'></span></a>";
            echo "</div>";
            echo "</div>";
        }

        ?>

        <a class="prev" onclick="plusSlides(-1)"><img
                src="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/public/icon/icon-arrow-left.svg"
                alt="left arrow icon"></a>
        <a class="next" onclick="plusSlides(1)"><img
                src="<?php $_SERVER['DOCUMENT_ROOT']; ?>/Rubics/public/icon/icon-arrow-right.svg"
                alt="right arrow icon"></a>


    </div>

    <?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/view-user-footer.php");
    ?>