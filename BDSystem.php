<?php
date_default_timezone_set("Europe/Paris");
include('php/manager.php');

function connectUserOk($username, $groupe){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $sql = "SELECT * FROM users WHERE groupeUser='$groupe' AND identifiantUser='$username'";

    if($result = mysqli_query($con, $sql)){
        return true;
    }else {
        return false;
    }
}

function counterDevoir(){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $groupeUser = $_COOKIE['user_group'];
    $nowDate = date('Y-m-d');

    $sql = "SELECT * from devoir WHERE categorieDevoir='devoir' AND groupeDevoir='$groupeUser' AND dateDevoir>='$nowDate'";

    if ($result = mysqli_query($con, $sql)) {
        $rowcount = mysqli_num_rows( $result );
    }

    mysqli_close($con);
    return $rowcount;
}

function counterExam(){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $groupeUser = $_COOKIE['user_group'];
    $nowDate = date('Y-m-d');

    $sql = "SELECT * from devoir WHERE categorieDevoir='Examen' AND groupeDevoir='$groupeUser' AND dateDevoir>='$nowDate'";

    if ($result = mysqli_query($con, $sql)) {
        $rowcount = mysqli_num_rows( $result );
    }

    mysqli_close($con);
    return $rowcount;
}

function refreshEDT(){
    $con = mysqli_connect("localhost", "root", "", "myent");

    $groupeUser = $_COOKIE['user_group'];
    $sqlRemoveTuple = "DELETE FROM edt WHERE groupeEDT='$groupeUser'";
    mysqli_query($con, $sqlRemoveTuple);

    //URLS
    $url_file = "";
    if(isset($_COOKIE['user_group'])){
        if($_COOKIE['user_group'] == "infoS1"){
            $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae12fa5989f2758552375cc5c53d9043bee7ff8e44acf541b2e2b7394758cd4205,1';
            $group = "infoS1";
        }else if($_COOKIE['user_group'] == "infoS2"){
            $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae664a3fdc9fdc896a22d01f283aadd0328c6ec3416cb5cde20124da914cafbced,1';
            $group = "infoS2";
        }else if($_COOKIE['user_group'] == "infoS3"){
            $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae3553242dae45f4fa3567f1677be2a6a2ac7bf1fc49ffc4e1daf425813d70005d,1';
            $group = "infoS3";
        }else if($_COOKIE['user_group'] == "infoS4"){
            $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae30df5d235aa4af794e5b4a10109955d819777c1c0df87ee1586d12aff843e144,1';
            $group = "infoS4";
        }else if($_COOKIE['user_group'] == "infoS5"){
            $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae07b0a5f02f74d2c7534c9fbff98273a9557d54f3c575ebc8597bdc6cef1f9eeb,1';
            $group = "infoS5";
        }else if($_COOKIE['user_group'] == "infoS6"){
            $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae894802120d56b2a4b539216dabc9724c7a8ae2f6a1bf0cab0beb54246d4caa04,1';
            $group = "infoS6";
        }
    }


    require_once('EDT/SG_iCal.php');
    $ical = new SG_iCal($url_file);
    foreach( $ical->getEvents() as $event ) {
        //PROFESSEUR
        $desc = $event->getDescription();
        $array = array();
        $desc= preg_replace("(\r\n|\n|\r)",' ',$desc);
        $array = explode(' ', $desc);
        $profEDT = "";
        for($i=0; $i<count($array); $i++){
            if(ctype_upper($array[$i]) == true && strlen($array[$i]) > 1){
                $profEDT = $profEDT.$array[$i]." ";
            }
        }

        //BDD
        //DTSTAMP => 20220209T160000Z
        //DATE => 2022-02-09
        //HEURE => 16:00:00
        $getStart = $event->getNormalStartStampTxtDataDate();
        $year = substr($getStart, 0, 4);
        $month = substr($getStart, 4, 2);
        $day = substr($getStart, 6, 2);
        $dateEDT = $year."-".$month."-".$day;
        $heur = substr($getStart, -7, 2);
        $min = substr($getStart, -5, 2);
        $seconds = substr($getStart, -3, 2);
        $heur = $heur + 2;
        $heureStart = $heur.":".$min.":".$seconds;
        $getStop = $event->getNormalStopStampTxtDataDate();
        $heurS = substr($getStop, -7, 2);
        $minS = substr($getStop, -5, 2);
        $secondsS = substr($getStop, -3, 2);
        $heurS = $heurS + 2;
        $heureStop = $heurS.":".$minS.":".$secondsS;
        //echo("=> ".$dateEDT."-".$heureStart."-".$heureStop);
        //echo("<br/><br/><br/><br/>");


        //SQL
        $nomEDT = $event->getSummary();


        $descriptionEDT = $event->getDescription();
        $salleEDT = $event->getLocation();

        if($group == "infoS6"){
            if($salleEDT == "021_Lili BOULANGER ( salle de cours INFO)"){
                $salleEDT = "COURS INFO";
            }else if($salleEDT == "020bis_Giuseppe VERDI ( TP INFO)"){
                $salleEDT = "TP INFO";
            }else if($salleEDT == "021_Lili BOULANGER ( salle de cours INFO),020bis_Giuseppe VERDI ( TP INFO)" || $salleEDT == "020bis_Giuseppe VERDI ( TP INFO), 021_Lili BOULANGER ( salle de cours INFO)"){
                $salleEDT = "COURS/TP INFO";
            }else if($salleEDT == "Cours en ligne (CEL) IUTMS"){
                $salleEDT = "COURS EN LIGNE";
            }else if($salleEDT == "022_ Nadia BOULANGER ( salle de cours GEA)"){
                $salleEDT = "COURS GEA";
            }

        }
        $durationEDT = $event->getDuration();

        //INSERT INTO `edt` (`idEDT`, `nomEDT`, `groupeEDT`, `dateEDT`, `heureStart`, `heureStop`, `descriptionEDT`, `salleEDT`, `profEDT`) VALUES (NULL, 'test', 'test', '2022-04-13', '23:46', '23:50', 'fzf', 'fdz', 'vds');
        $sql = "INSERT INTO `edt`(`idEDT`, `nomEDT`, `groupeEDT`, `dateEDT`, `heureStart`, `heureStop`, `descriptionEDT`, `salleEDT`, `profEDT`, `durationEDT`) VALUES(NULL, '$nomEDT', '$group', '$dateEDT', '$heureStart', '$heureStop', '$descriptionEDT', '$salleEDT', '$profEDT', '$durationEDT')";
        if(mysqli_query($con, $sql)){
            echo("Succes");
            header("Location: edtHome.php");
        }else {
            echo("Error");
        }
    }

    mysqli_close($con);
}

function homeDevoirDiv(){
    $con = mysqli_connect("localhost", "root", "", "myent");

    if($con->connect_error){
        echo("Erreur, impossible de se connecter à la base de donnée");
    }

    $nowDate = date('Y-m-d');
    $usergroup = $_COOKIE['user_group'];
    $sql = "SELECT * FROM devoir WHERE groupeDevoir='$usergroup' AND dateDevoir='$nowDate'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $colorMatiere = getColorByMatiere($row['matiereDevoir']);
            ?>
            <div class="devoirDiv" style="border-left: 5px solid <?php echo($colorMatiere) ?>;">
                <h3><?php echo($row['nomDevoir']); ?></h3>
                <div class="otherDevoirDiv ">
                    <?php $dateDevoir = date('d/m/Y', strtotime($row['dateDevoir'])); ?>
                    <p><img src="assets/Utils/clock.png" alt="Icone horloge"/> <?php echo($dateDevoir); ?></p>
                </div>
                <div class="otherDevoirDiv">
                    <p><img id="margeDown" src="assets/Utils/category.png" alt="Icone category"> <?php echo($row['categorieDevoir']); ?></p>
                </div>
            </div>
            <?php
        }
        mysqli_free_result($result);
    } else {
        printf('Aucun devoir trouvé.<br />');
    }
    $con->close();
}

function devoirHomeDiv(){
    $con = mysqli_connect("localhost", "root", "", "myent");

    if($con->connect_error){
        echo("Erreur, impossible de se connecter à la base de donnée");
    }

    $usergroup = $_COOKIE['user_group'];
    $nowDate = date('Y-m-d');

    $sql = "SELECT * FROM devoir WHERE groupeDevoir='$usergroup' AND dateDevoir>='$nowDate' ORDER BY dateDevoir ASC";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $colorMatiere = getColorByMatiere($row['matiereDevoir']);
            ?>
            <a href="settings.php?view=devoirEditSupp&id=<?php echo($row['idDevoir']); ?>&name=<?php echo($row['nomDevoir']) ?>&categorie=<?php echo($row['categorieDevoir']) ?>&matiere=<?php echo($row['matiereDevoir']) ?>&date=<?php echo($row['dateDevoir']) ?>"><div class="devoirDiv" style="border-left: 5px solid <?php echo($colorMatiere) ?>;">
                    <h3><?php echo($row['nomDevoir']); ?></h3>
                    <div class="otherDevoirDiv ">
                        <?php $dateDevoir = date('d/m/Y', strtotime($row['dateDevoir'])); ?>
                        <p><img src="assets/Utils/clock.png" alt="Icone horloge"/> <?php echo($dateDevoir); ?></p>
                    </div>
                    <div class="otherDevoirDiv">
                        <p><img id="margeDown" src="assets/Utils/category.png" alt="Icone category"> <?php echo($row['categorieDevoir']); ?></p>
                    </div>
                </div></a>
            <?php
        }
        mysqli_free_result($result);
    } else {
        printf('Aucun devoir trouvé.<br />');
    }
    $con->close();
}

function afficheEDTDayAndStopMoreNow(){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect("localhost", "root", "", "myent");

    if($con->connect_error){
        echo("Erreur, impossible de se connecter à la base de donnée");
    }

    $usergroup = $_COOKIE['user_group'];
    $nowDate = date('Y-m-d');
    $nowHeure = date('H:m:s');
    //print($nowDate);
    $sql = "SELECT * FROM edt WHERE groupeEDT='$usergroup' AND dateEDT='$nowDate' AND heureStop >= '$nowHeure' ORDER BY heureStart ASC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $duration = $row['durationEDT'];
            $duration = $duration/3600;
            $height = $duration*75;
            ?>
            <div class="edtDiv" style="background-color: <?php echo(getColorByMatiere($row['nomEDT'])); ?>; min-height: <?php echo($height); ?>px;">
                <div class="topEDTDiv">
                    <h3><?php echo($row['profEDT']); ?></h3>
                    <p><img src="assets/Utils/location.png" alt="Icone Salle"/><?php echo($row['salleEDT']); ?></p>
                </div>
                <?php
                $mtop = 0;
                if($duration == 1){
                    $mtop = 0;
                }else if($duration == 1.5){
                    $mtop = 0;
                }else if($duration == 2){
                    $mtop = 58;
                }else if($duration == 2.5){
                    $mtop = 85;
                }else if($duration == 3){
                    $mtop = 125;
                }else if($duration == 3.5){
                    $mtop = 165;
                }else if($duration == 4){
                    $mtop = 200;
                }
                ?>
                <div class="content" style="margin-top: <?php echo($mtop); ?>px">
                    <?php
                    $nom = $row['nomEDT'];
                    if($nom == "Communication Milieu Professionnel"){
                        $nom = "Communication";
                    }
                    ?>
                    <h2><?php echo($nom); ?></h2>
                    <?php
                    $heureDebut = $row['heureStart'];
                    //00:00:00
                    $heureDebut = substr($heureDebut, 0, 5);
                    $heureFin = $row['heureStop'];
                    $heureFin = substr($heureFin, 0, 5);
                    ?>
                    <p class="hours"><?php echo($heureDebut); ?> - <?php echo($heureFin); ?></p>
                </div>
            </div>
            <?php
        }
        mysqli_free_result($result);
    } else {
        printf('Aucun cour trouvé.<br />');
    }
    $con->close();
}

function afficheEDTHomeNow(){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect("localhost", "root", "", "myent");

    if($con->connect_error){
        echo("Erreur, impossible de se connecter à la base de donnée");
    }

    $usergroup = $_COOKIE['user_group'];
    $nowDate = date('Y-m-d');
    //print($nowDate);
    $sql = "SELECT * FROM edt WHERE groupeEDT='$usergroup' AND dateEDT='$nowDate' ORDER BY heureStart ASC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $duration = $row['durationEDT'];
            $duration = $duration/3600;
            $height = $duration*75;
            ?>
            <div class="edtDiv" style="background-color: <?php echo(getColorByMatiere($row['nomEDT'])); ?>; min-height: <?php echo($height); ?>px;">
                <div class="topEDTDiv">
                    <h3><?php echo($row['profEDT']); ?></h3>
                    <p><img src="assets/Utils/location.png" alt="Icone Salle"/><?php echo($row['salleEDT']); ?></p>
                </div>
                <?php
                $mtop = 0;
                if($duration == 1){
                    $mtop = 0;
                }else if($duration == 1.5){
                    $mtop = 0;
                }else if($duration == 2){
                    $mtop = 58;
                }else if($duration == 2.5){
                    $mtop = 85;
                }else if($duration == 3){
                    $mtop = 125;
                }else if($duration == 3.5){
                    $mtop = 165;
                }else if($duration == 4){
                    $mtop = 200;
                }
                ?>
                <div class="content" style="margin-top: <?php echo($mtop); ?>px">
                    <?php
                    $nom = $row['nomEDT'];
                    if($nom == "Communication Milieu Professionnel"){
                        $nom = "Communication";
                    }
                    ?>
                    <h2><?php echo($nom); ?></h2>
                    <?php
                    $heureDebut = $row['heureStart'];
                    //00:00:00
                    $heureDebut = substr($heureDebut, 0, 5);
                    $heureFin = $row['heureStop'];
                    $heureFin = substr($heureFin, 0, 5);
                    ?>
                    <p class="hours"><?php echo($heureDebut); ?> - <?php echo($heureFin); ?></p>
                </div>
            </div>
            <?php
        }
        mysqli_free_result($result);
    } else {
        printf('Aucun cour trouvé.<br />');
    }
    $con->close();
}

function afficheEDTHomeNotNow($date){
    $con = mysqli_connect("localhost", "root", "", "myent");

    if($con->connect_error){
        echo("Erreur, impossible de se connecter à la base de donnée");
    }

    $usergroup = $_COOKIE['user_group'];
    $dateNew = strtotime($date);
    $nowDate = date('Y-m-d', $dateNew);
    //print($nowDate);
    $sql = "SELECT * FROM edt WHERE groupeEDT='$usergroup' AND dateEDT='$nowDate' ORDER BY heureStart ASC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $duration = $row['durationEDT'];
            $duration = $duration/3600;
            $height = $duration*75;
            ?>
            <div class="edtDiv" style="background-color: <?php echo(getColorByMatiere($row['nomEDT'])); ?>; min-height: <?php echo($height); ?>px;">
                <div class="topEDTDiv">
                    <h3><?php echo($row['profEDT']); ?></h3>
                    <p><img src="assets/Utils/location.png" alt="Icone Salle"/><?php echo($row['salleEDT']); ?></p>
                </div>
                <?php
                $mtop = 0;
                if($duration == 1){
                    $mtop = 0;
                }else if($duration == 1.5){
                    $mtop = 0;
                }else if($duration == 2){
                    $mtop = 58;
                }else if($duration == 2.5){
                    $mtop = 85;
                }else if($duration == 3){
                    $mtop = 125;
                }else if($duration == 3.5){
                    $mtop = 165;
                }else if($duration == 4){
                    $mtop = 200;
                }
                ?>
                <div class="content" style="margin-top: <?php echo($mtop); ?>px">
                    <?php
                    $nom = $row['nomEDT'];
                    if($nom == "Communication Milieu Professionnel"){
                        $nom = "Communication";
                    }
                    ?>
                    <h2><?php echo($nom); ?></h2>
                    <?php
                    $heureDebut = $row['heureStart'];
                    //00:00:00
                    $heureDebut = substr($heureDebut, 0, 5);
                    $heureFin = $row['heureStop'];
                    $heureFin = substr($heureFin, 0, 5);
                    ?>
                    <p class="hours"><?php echo($heureDebut); ?> - <?php echo($heureFin); ?></p>
                </div>
            </div>
            <?php
        }
        mysqli_free_result($result);
    } else {
        printf('Aucun cour trouvé.<br />');
    }
    $con->close();
}

function addDevoirBD($name, $categorie, $matiere, $date){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $groupe = $_COOKIE['user_group'];
    //$sql = "INSERT INTO `devoir` (`idDevoir`, `groupeDevoir`, `categorieDevoir`, `nomDevoir`, `matiereDevoir`, `dateDevoir`) VALUES (NULL, 'test', 'test', 'test', 'test', '2022-04-28');"
    $sql = "INSERT INTO `devoir` (`idDevoir`, `groupeDevoir`, `categorieDevoir`, `nomDevoir`, `matiereDevoir`, `dateDevoir`) VALUES(NULL, '$groupe', '$categorie', '$name', '$matiere', '$date')";

    mysqli_query($con, $sql);
    mysqli_close($con);
}

function editDevoirBD($id, $name, $categorie, $matiere, $date){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $groupe = $_COOKIE['user_group'];
    //$sql = "INSERT INTO `devoir` (`idDevoir`, `groupeDevoir`, `categorieDevoir`, `nomDevoir`, `matiereDevoir`, `dateDevoir`) VALUES (NULL, 'test', 'test', 'test', 'test', '2022-04-28');"
    $sql = "UPDATE `devoir` SET `categorieDevoir`='$categorie',`nomDevoir`='$name',`matiereDevoir`='$matiere',`dateDevoir`='$date' WHERE `devoir`.`idDevoir`='$id'";

    mysqli_query($con, $sql);
    mysqli_close($con);
}

function deleteDevoirBD($id){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $groupe = $_COOKIE['user_group'];
    $sql = "DELETE FROM `devoir` WHERE `devoir`.`idDevoir`='$id'";

    mysqli_query($con, $sql);
    mysqli_close($con);
}
