<?php

if(isset($_COOKIE['groupe'])){
    header("Location: header.php");
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

        <title>MyENT - Welcome</title>
    </head>
    <body id="indexBody">
        <header>
            <h2>Erreur,</h2>
            <h1>MyENT</h1>
            <img src="assets/Logo/Court.png" alt="Icone court MyENT" />
        </header>
        <main>
            <h1>ERREUR</h1>
            <?php
                if(isset($_GET['view'])){
                    ?><h2><?php echo($_GET['view']); ?></h2><?php
                }else {
                    ?><h2>Not found</h2><?php
                }
            ?>
        </main>
        <footer>
            <p>Ce site est encore en développement.</p>
            <p>Made by Wabezeter - SkytorStudio©2022</p>
        </footer>
    </body>
</html>