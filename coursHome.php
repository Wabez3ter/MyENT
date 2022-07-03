<?php

if(!isset($_COOKIE['user_group']) && !isset($_GET['matiere'])){
    header("Location: index.php");
}

date_default_timezone_set("Europe/Paris");
include 'BDSystem.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/app.css"/>
    <link rel="shortcut icon" href="assets/Logo/Court.png" type="image/png"/>

    <title>MyENT - Homes</title>
</head>
    <body id="coursHome">
        <header>
            <div class="navHeader">
                <a href="selectGroup.php?view=logout"><img src="./assets/Utils/power-off.png" alt="Logout icone"/></a>
                <a href="home.php"><img src="./assets/Utils/house.png" alt="Home icone"/></a>
            </div>
            <h2><?php echo(getTxtByGroup($_COOKIE['user_group'])); ?></h2>
        </header>
        <main>
            <div class="coursHomeTop" style="background-image: url('assets/Cours/<?php echo($_GET['matiere']); ?>.svg')">
                <h2><?php echo($_GET['matiere']) ?></h2>
            </div>
            <section id="allMainCoursHome">
                <section class="nextCours">
                    <section class="edtBD">
                        <h3 class="txtSectionTitle">Prochain cour: </h3>
                        <?php
                        afficheNextCoursOfMatiere($_GET['matiere']);
                        ?>
                    </section>
                </section>
                <section class="devoirAll">
                    <section class="allDevoir">
                        <h3 class="txtSectionTitle">Tous les Devoirs: </h3>
                        <secetion class="devoirBD">
                            <?php
                            afficheAllDevoirOfMatiere($_GET['matiere']);
                            ?>
                        </secetion>
                    </section>
                    <section class="allExam">
                        <h3 class="txtSectionTitle">Tous les Examens: </h3>
                        <secetion class="devoirBD">
                            <?php
                            afficheAllExamenOfMatiere($_GET['matiere']);
                            ?>
                        </secetion>
                    </section>
                </section>
            </section>
        </main>
    </body>
</html>