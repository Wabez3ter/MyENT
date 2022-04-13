<?php

if(isset($_COOKIE['groupe'])){
    header("Location: header.php");
}

if(!isset($_COOKIE['username'])){
    header("Location: devoirHome.php");
}

include('BDSystem.php');

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
    <body id="settingsBody">
        <header>
        </header>
        <main>
            <a href="devoirHome.php"><h3><img src="assets/Logo/Court.png" alt="Logo MyENT"/> MyENT</h3></a>
                <div class="settings--container">
            <?php
            if(isset($_GET['view'])){
                if($_GET['view'] == "devoirAdd"){
                    ?>
                    <form action="settings.php?view=BDdevoirAdd" method="post">
                        <h2>Ajouter un devoir</h2>
                        <input type="text" name="name" id="name" placeholder="Nom du devoir"/>
                        <select name="categorie" id="categorie">
                            <option value="Examen">Examen</option>
                            <option value="Devoir">Devoir</option>
                        </select>
                        <select name="matiere" id="matiere">
                            <?php
                            if($_COOKIE['user_group'] == "infoS1" || $_COOKIE['user_group'] == "infoS2" || $_COOKIE['user_group'] == "infoS3" || $_COOKIE['user_group'] == "infoS4" || $_COOKIE['user_group'] == "infoS5" || $_COOKIE['user_group'] == "infoS6"){
                                ?>
                                <option value="Exploitation BD">Exploitation BD</option>
                                <option value="Dev. Objets">Dev. Objets</option>
                                <option value="Graphes">Graphes</option>
                                <option value="SAE">SAE</option>
                                <option value="Communication Milieu Professionnel">Communication</option>
                                <option value="PPP">PPP</option>
                                <option value="Gestion de projet et des organisations">Gestion de projet & des organisations</option>
                                <option value="Dev. Apps avec IHM">Dev. Apps avec IHM</option>
                                <option value="Anglais entreprise">Anglais entreprise</option>
                                <option value="Réseau et Prog bas niveau">Réseau & Prob bas niveau</option>
                                <option value="Services Réseau">Services Réseau</option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="date" name="date" id="date"/>
                        <input type="submit" value="Ajouter"/>
                    </form>
                    <?php
                }else if($_GET['view'] == "devoirEditSupp"){
                    //http://localhost/MyENT/settings.php?view=devoirEditSupp?name=Test&categorie=Examen&matiere=Graphes&date=2022-07-01
                    if(isset($_GET['name']) AND isset($_GET['categorie']) AND isset($_GET['matiere']) AND isset($_GET['id']) AND isset($_GET['date'])){
                        ?>
                        <form action="settings.php?view=BDdevoirEdit" method="post">
                            <h2>Modifier/Supprimer un devoir</h2>
                            <input type="number" name="id" id="id" placeholder="ID du devoir" value="<?php echo($_GET['id']); ?>"/>
                            <input type="text" name="name" id="name" placeholder="Nom du devoir" value="<?php echo($_GET['name']); ?>"/>
                            <select name="categorie" id="categorie">
                                <?php
                                if($_GET['categorie'] == "Examen"){
                                    ?>
                                    <option value="Examen" selected>Examen</option>
                                    <option value="Devoir">Devoir</option>
                                    <?php
                                }else {
                                    ?>
                                    <option value="Examen">Examen</option>
                                    <option value="Devoir" selected>Devoir</option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="matiere" id="matiere">
                                <?php
                                if($_COOKIE['user_group'] == "infoS1" || $_COOKIE['user_group'] == "infoS2" || $_COOKIE['user_group'] == "infoS3" || $_COOKIE['user_group'] == "infoS4" || $_COOKIE['user_group'] == "infoS5" || $_COOKIE['user_group'] == "infoS6"){

                                    ?>
                                    <option value="Exploitation BD" <?php if($_GET['matiere'] == "Exploitation BD"){
                                        echo("selected");
                                    } ?>>Exploitation BD</option>
                                    <option value="Dev. Objets" <?php if($_GET['matiere'] == "Dev. Objets"){
                                        echo("selected");
                                    } ?> >Dev. Objets</option>
                                    <option value="Graphes" <?php if($_GET['matiere'] == "Graphes"){
                                        echo("selected");
                                    } ?> >Graphes</option>
                                    <option value="SAE" <?php if($_GET['matiere'] == "SAE"){
                                        echo("selected");
                                    } ?> >SAE</option>
                                    <option value="Communication Milieu Professionnel" <?php if($_GET['matiere'] == "Communication Milieu Professionnel"){
                                        echo("selected");
                                    } ?> >Communication</option>
                                    <option value="PPP" <?php if($_GET['matiere'] == "PPP"){
                                        echo("selected");
                                    } ?> >PPP</option>
                                    <option value="Gestion de projet et des organisations" <?php if($_GET['matiere'] == "Gestion de projet & des organisations"){
                                        echo("selected");
                                    } ?> >Gestion de projet & des organisations</option>
                                    <option value="Dev. Apps avec IHM" <?php if($_GET['matiere'] == "Dev. Apps avec IHM"){
                                        echo("selected");
                                    } ?> >Dev. Apps avec IHM</option>
                                    <option value="Anglais entreprise" <?php if($_GET['matiere'] == "Anglais entreprise"){
                                        echo("selected");
                                    } ?> >Anglais entreprise</option>
                                    <option value="Réseau et Prog bas niveau" <?php if($_GET['matiere'] == "Réseau & Prog bas niveau"){
                                        echo("selected");
                                    } ?> >Réseau & Prob bas niveau</option>
                                    <option value="Services Réseau" <?php if($_GET['matiere'] == "Services Réseau"){
                                        echo("selected");
                                    } ?> >Services Réseau</option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="date" name="date" id="date" value="<?php echo($_GET['date']); ?>"/>
                            <span><input type="submit" style="margin-top: 7vh;" value="Modifier"/><a href="settings.php?view=BDdevoirDelete&id=<?php echo($_GET['id']); ?>"><img src="assets/Utils/trash.png" alt="Icone delete" /></a></span>
                        </form>
                        <?php
                    }else {
                        ?>
                        <form action="settings.php?view=BDdevoirEdit" method="post">
                            <h2>Modifier/Supprimer un devoir</h2>
                            <input type="number" name="id" id="id" placeholder="ID du devoir"/>
                            <input type="text" name="name" id="name" placeholder="Nom du devoir"/>
                            <select name="categorie" id="categorie">
                                <option value="Examen">Examen</option>
                                <option value="Devoir">Devoir</option>
                            </select>
                            <select name="matiere" id="matiere">
                                <?php
                                if($_COOKIE['user_group'] == "infoS1" || $_COOKIE['user_group'] == "infoS2" || $_COOKIE['user_group'] == "infoS3" || $_COOKIE['user_group'] == "infoS4" || $_COOKIE['user_group'] == "infoS5" || $_COOKIE['user_group'] == "infoS6"){
                                    ?>
                                    <option value="Exploitation BD">Exploitation BD</option>
                                    <option value="Dev. Objets">Dev. Objets</option>
                                    <option value="Graphes">Graphes</option>
                                    <option value="SAE">SAE</option>
                                    <option value="Communication Milieu Professionnel">Communication</option>
                                    <option value="PPP">PPP</option>
                                    <option value="Gestion de projet et des organisations">Gestion de projet & des organisations</option>
                                    <option value="Dev. Apps avec IHM">Dev. Apps avec IHM</option>
                                    <option value="Anglais entreprise">Anglais entreprise</option>
                                    <option value="Réseau et Prog bas niveau">Réseau & Prob bas niveau</option>
                                    <option value="Services Réseau">Services Réseau</option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="date" name="date" id="date"/>
                            <span><input type="submit" style="margin-top: 7vh; width: 90%" value="Modifier"/></span>
                        </form>
                        <?php
                    }
                }else if($_GET['view'] == "BDdevoirAdd" AND isset($_POST['date']) AND isset($_POST['matiere']) AND isset($_POST['categorie']) AND isset($_POST['name'])){
                    //BD Add Devoir
                    $date = $_POST['date'];
                    $matiere = $_POST['matiere'];
                    $categorie = $_POST['categorie'];
                    $name = $_POST['name'];

                    addDevoirBD($name, $categorie, $matiere, $date);
                    header("Location: home.php");
                }else if($_GET['view'] == "BDdevoirEdit" AND isset($_POST['id']) AND isset($_POST['date']) AND isset($_POST['matiere']) AND isset($_POST['categorie']) AND isset($_POST['name'])){
                    //BD Add Devoir
                    $id = $_POST['id'];
                    $date = $_POST['date'];
                    $matiere = $_POST['matiere'];
                    $categorie = $_POST['categorie'];
                    $name = $_POST['name'];

                    editDevoirBD($id, $name, $categorie, $matiere, $date);
                    header("Location: home.php");
                }else if($_GET['view'] == "BDdevoirDelete" AND isset($_GET['id'])){
                    //BD Add Devoir
                    $id = $_GET['id'];

                    deleteDevoirBD($id);
                    header("Location: home.php");
                }else {
                    header("Location: error.php?view=Parametre impossible.");
                }
            }else {
                header("Location: error.php?view=Parametre impossible.");
            }
            ?>
            </div>
        </main>
        <footer>
            <p>Ce site est encore en développement.</p>
            <p>Made by Wabezeter - SkytorStudio©2022</p>
        </footer>
    </body>
</html>