<?php

function counterDevoir(){
    //LOCAL
    $con = mysqli_connect("localhost","root","","myent");
    //SERVER

    $sql = "SELECT * from devoir WHERE categorieDevoir='devoir'";

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

    $sql = "SELECT * from devoir WHERE categorieDevoir='examen'";

    if ($result = mysqli_query($con, $sql)) {
        $rowcount = mysqli_num_rows( $result );
    }

    mysqli_close($con);
    return $rowcount;
}

function refreshEDT(){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect("localhost", "root", "", "myent");

    $sqlRemoveTuple = "DELETE FROM edt WHERE groupeEDT='infoS6'";
    mysqli_query($con, $sqlRemoveTuple);


    //INFO 7
    $url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae894802120d56b2a4b539216dabc9724c7a8ae2f6a1bf0cab0beb54246d4caa04,1';
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

        //SQL
        $nomEDT = $event->getSummary();
        $groupeEDT = "infoS6";
        $dateEDT = date('Y-m-d', $event->getStart());
        $heureStart = date("H:m", $event->getStart());
        $heureStop = date("H:m", $event->getEnd());
        $descriptionEDT = $event->getDescription();
        $salleEDT = $event->getLocation();

        //INSERT INTO `edt` (`idEDT`, `nomEDT`, `groupeEDT`, `dateEDT`, `heureStart`, `heureStop`, `descriptionEDT`, `salleEDT`, `profEDT`) VALUES (NULL, 'test', 'test', '2022-04-13', '23:46', '23:50', 'fzf', 'fdz', 'vds');
        $sql = "INSERT INTO `edt`(`idEDT`, `nomEDT`, `groupeEDT`, `dateEDT`, `heureStart`, `heureStop`, `descriptionEDT`, `salleEDT`, `profEDT`) VALUES(NULL, '$nomEDT', '$groupeEDT', '$dateEDT', '$heureStart', '$heureStop', '$descriptionEDT', '$salleEDT', '$profEDT')";
        if(mysqli_query($con, $sql)){
            echo("Succes");
        }else {
            echo("Error");
        }
    }

    mysqli_close($con);
}
