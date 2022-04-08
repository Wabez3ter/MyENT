<?php
date_default_timezone_set("Europe/Paris");
include 'BDSystem.php';

if(!isset($_COOKIE['user_group'])){
    header("Location: index.php");
}

if(isset($_GET['view']) && $_GET['view'] == "refresh"){
    refreshEDT();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/app.css"/>
    <link rel="shortcut icon" href="assets/Logo/Court.png" type="image/png"/>

    <title>MyENT - EDT</title>
</head>
<body id="homeBody">
<header>
    <div class="navHeader">
        <a href="selectGroup.php?view=logout"><img src="./assets/Utils/power-off.png" alt="Logout icone"/></a>
        <a href="home.php"><img src="./assets/Utils/house.png" alt="Home icone"/></a>
        <?php
        if(isset($_COOKIE['username'])){
            ?><a href="edtHome.php?view=refresh"><img src="assets/Utils/refresh.png" alt="Icone refresh"/></a><?php
        }
        ?>
    </div>
    <h2><?php echo($_COOKIE['user_group']); ?></h2>
</header>
<main>
    <section class="homeMain">
        <section class="top">
            <div class="selectDiv">
                <form action="edtHome.php" method="GET">
                    <input class="dateSelect" type="date" name="date" id="date"/>
                    <input type="image" src="assets/Utils/check-mark.png" value="submit"/>
                </form>
            </div>
            <h2>Bonjour, <?php echo($_COOKIE['user_group']); ?></h2>
        </section>
        <section class="edt">
            <?php
            if(isset($_GET['date'])){
                $dateString = $_GET['date'];
                $newDate = substr($dateString, -5, 2)."/".substr($dateString, -2, 2)."/".substr($dateString, 0, 4);
                $dateNew = strtotime($newDate);
                $dateOk = date('d/m/Y', $dateNew);
                ?><h2><?php echo($dateOk); ?></h2><?php
            }else {
                ?><h2>Aujourd'hui, <?php echo(date('d/m/Y')); ?></h2><?php
            }
            ?>
            <section class="edtBD">
                <?php
                if(isset($_GET['date'])){
                    afficheEDTHomeNotNow($dateString);
                }else {
                    afficheEDTHomeNow();
                }
                ?>
            </section>
        </section>
    </section>
</main>
</body>
</html>