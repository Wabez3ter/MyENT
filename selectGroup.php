<?php

if(isset($_GET['selectGroupeInput'])){
    setcookie('user_group', $_GET['selectGroupeInput'], time()+3600*24, '/');
    header("Location: home.php");

}

if(isset($_GET['view'])){
    if($_GET['view'] == "logout"){
        if(isset($_COOKIE['username'])){
            header("Location: connexion.php?view=logout");
        }else {
            setcookie('user_group', '', time()-3600, '/', '', false, false);
            header("Location: index.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/app.css"/>

    <title>MyENT - Selection des Groupes</title>
</head>
    <body id="selectGroupBody">
        <main>
            <h2>Selection du groupe:</h2>
            <p>Veuillez choisir votre groupe de TD pour accéder à l'emploi du temps, au devoirs et informations. Une fois sélectionné, cliquez sur "Enregistrer".</p>

            <form action="selectGroup.php" method="GET">
                <select name="selectGroupeInput" id="selectGroupeInput">
                    <option value="infoS1">Informatique - S1</option>
                    <option value="infoS2">Informatique - S2</option>
                    <option value="infoS3">Informatique - S3</option>
                    <option value="infoS4">Informatique - S4</option>
                    <option value="infoS5">Informatique - S5</option>
                    <option value="infoS6">Informatique - S6</option>
                </select>
                <input type="submit" value="Enregistrer"/>
            </form>
        </main>
        <footer>
            <p>Made by Wabezeter - SkytorStudio©2022</p>
        </footer>
    </body>
</html>