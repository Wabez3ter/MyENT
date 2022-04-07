<?php
include('BDSystem.php');

if(isset($_GET['selectGroupeInput']) && isset($_GET['username'])){

    if(connectUserOk($_GET['selectGroupeInput'], $_GET['username']) == true){
        setcookie('username', $_GET['username'], time()+3600*24, '/');
        setcookie('user_group', $_GET['selectGroupeInput'], time()+3600*24, '/');
        header("Location: home.php");
    }else {
        header('Location: connexion.php?status=error');
    }
}

if(isset($_GET['view'])){
    if($_GET['view'] == "logout"){
        setcookie('username', '', time()-3600, '/');
        setcookie('user_group', '', time()-3600, '/');
        header("Location: index.php");
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
    <body id="connexionBody">
        <main>
            <h2>Connexion:</h2>
            <p>Vous pouvez vous connecter directement avec vos identifiant et votre groupe.</p>

            <?php
            if(isset($_GET['status']) AND $_GET['status'] == "error"){
                ?><p class="error">Erreur, dans la conenxion. Merci de réessayer.</p><?php
            }
            ?>

            <form action="connexion.php" method="GET">
                <input type="text" name="username" id="username"/>
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