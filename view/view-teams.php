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
                <h1>Faites connaissance de nos équipes et compétences de chacun.</h1>
            </div>
        </div>
        <div class="cube">
            <img src="../public/giphy.gif" alt="3D cube">
        </div>
    </div>

    <div class="banner">
        <div class="left clr-white">
            <h2>Filtrez par domaine de<br> compétences et découvrez les<br> prestataires de votre futur projet.</h2>
        </div>
        <div class="right">
            <select name="cars" id="cars" form="carform">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="opel">Opel</option>
                <option value="audi">Audi</option>
            </select>
            <div class="cta">
                <a class="btn" href="login.html">Appliquer<span class="arrow right"></span></a>
            </div>
        </div>
    </div>

    <div class="container-content">
        <div class="cards">
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
    </div>

    <?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/footer.php");
    ?>