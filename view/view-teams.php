<?php
$title = "Projets";
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/teamModel.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/employeeModel.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else $id = null;

$employees = getActiveEmployees($id);
$teams = activeTeams();

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
            <div class="right">
                <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/Rubics/controller/employeeController.php" method="POST">
                    <div class="field-container">
                        <select name="teamId" id="teamId">
                            <?php foreach ($teams as $team) : ?>
                                <option value="<?php echo $team['id']; ?>" <?php if (isset($id) && $id == $team['id'])
                                                                                echo 'selected'; ?>>
                                    <?php echo $team['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input class="btn" type="submit" name="submit" value="Appliquer" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-content">
        <div class="cards">
            <?php
            if (isset($employees)) {

                $employeeCount = count($employees);
                $divisibleByFour = $employeeCount % 4;

                foreach ($employees as $employee) {
                    echo "<div class='card-item rectangle'>";
                    echo "<img src=" . $employee['avatar'] . " " . "alt='designer icon'>";
                    //echo "<br><span class='badge badge-primary'>" . $employee['team_name'] . "</span>";
                    echo "<h3>" . $employee['last_name'] . " " . $employee['first_name'] . "</h3>";
                    echo "<p class='ft-weight-bold clr-third'>" . $employee['team_name'] . "</p>";
                    echo "<p class='ft-weight-bold clr-white'>" . $employee['biography'] . "</p>";
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
    include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/view/component/footer.php");
    ?>