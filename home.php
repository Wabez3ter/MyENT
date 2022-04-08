<?php

if(!isset($_COOKIE['user_group'])){
    header("Location: index.php");
}

if(!isset($_GET['l'])){
    ?>
    <script type="text/javascript">
        document.location="home.php?l=" + screen.width;
    </script>
    <?php
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
    <body id="homeBody">
        <header>
            <div class="navHeader">
                <a href="selectGroup.php?view=logout"><img src="./assets/Utils/power-off.png" alt="Logout icone"/></a>
                <a href="home.php"><img src="./assets/Utils/house.png" alt="Home icone"/></a>
            </div>
            <h2><?php echo(getTxtByGroup($_COOKIE['user_group'])); ?></h2>
        </header>
        <main>
            <section class="homeMain">
                <section class="top">
                    <h2><?php echo(getNameToWelcome()); ?></h2>
                    <div class="counterDiv">
                        <div class="examCounter">
                            <h3>Examen</h3>
                            <p><?php echo(counterExam()); ?></p>
                        </div class="devoirCounter">
                        <div class="devoirCounter">
                            <h3>Devoir</h3>
                            <p><?php echo(counterDevoir()); ?></p>
                        </div>
                    </div>
                </section>
                <section class="devoir">
                    <h2>A faire pour aujourd'hui <a href="devoirHome.php"><img src="assets/Utils/loupe.png" alt="Icone loupe"/></a></h2>
                    <secetion class="devoirBD">
                        <?php
                            homeDevoirDiv();
                        ?>
                    </secetion>
                </section>
                <?php
                if($_GET['l'] >= 1000){
                    $mtop = 200;
                    $mtop = 200+(counterNbDevoirHOME()*110);
                }
                ?>
                <section class="edt" style="margin-top: -<?php echo($mtop); ?>px">
                    <h2>Aujourd'hui, <?php echo(date('d/m/Y')); ?> <a href="edtHome.php"><img src="assets/Utils/loupe.png" alt="Icone loupe"/></a></h2>
                    <section class="edtBD">
                        <?php
                        afficheEDTDayAndStopMoreNow();
                        ?>
                    </section>
                </section>
            </section>
        </main>
    </body>
</html>