<?php
$title = "Accueil";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/header.php");
?>
<div class="container-items">
    <div class="container-content section-one">
        <div class="intro">
            <div class="clr-white">
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
            <div class="clr-white">
                <h2>Nos<br>compétences<br>à votre service.</h2>
                <div class="cta">
                    <a class="btn" href="login.html">Réalisations<span class="arrow right"></span></a>
                </div>
            </div>
        </div>
        <div class="right clr-white">
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
        <div class="right clr-white">
            <h2>Faîtes connaissance de notre grande famille.</h2>
            <div class="cta">
                <a class="btn" href="login.html">Découvrir<span class="arrow right"></span></a>
            </div>
        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/footer.php");
    ?>