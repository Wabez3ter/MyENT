<?php

if(!isset($_COOKIE['user_group'])){
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
<body id="homeBody">
<header>
    <div class="navHeader">
        <a href="selectGroup.php?view=logout"><img src="./assets/Utils/power-off.png" alt="Logout icone"/></a>
        <a href="home.php"><img src="./assets/Utils/house.png" alt="Home icone"/></a>
    </div>
    <h2><?php echo($_COOKIE['user_group']); ?></h2>
</header>
<main>
    <section class="homeMain">
        <section class="top">
            <h2>Bonjour, <?php echo($_COOKIE['user_group']); ?></h2>
        </section>
        <section class="edt">
            <form action="edtHome.php" method="post">
                <input type="date" name="date" id="date"/>
                <input type="submit" value="Envoyer">
            </form>
            <div class="selection">
                <select onchange="redirectSelectSettings(this)">
                    <option value="">Sélectionner un paramètre</option>
                    <option value="addProjet">Projet - Ajouter</option>
                </select>

                <script>
                    function redirectSelectSettings(event){
                        var view = event.value;
                        if(view == ""){
                            window.location.href = "settings.php";

                        }else {
                            window.location.href = "settings.php?view=" + view;
                        }
                    }
                </script>
            </div>
            <h2>Aujourd'hui, <?php echo(date('d/m/Y')); ?> <a href="#"><img src="assets/Utils/loupe.png" alt="Icone loupe"/></a></h2>
            <section class="edtBD">
                <?php

                if(isset($_GET['view'])){

                }else {
                    afficheEDTDayAndStopMoreNow();
                }
                ?>
            </section>
        </section>
    </section>
</main>
</body>
</html>