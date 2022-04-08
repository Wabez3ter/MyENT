<?php

function getColorByMatiere($mat){
    if($mat == "Exploitation BD"){
        return "#33ffff";
    }else if($mat == "Dev. Objets"){
        return "#ff6666";
    }else if($mat == "Graphes"){
        return "#9999ff";
    }else if($mat == "SAE"){
        return "#ccffcc";
    }else if($mat == "Communication Milieu Professionnel"){
        return "#ffff99";
    }else if($mat == "PPP"){
        return "#669900";
    }else if($mat == "Gestion de projet & des organisations"){
        return "#ff9933";
    }else if($mat == "Dev. Apps avec IHM"){
        return "#ffcccc";
    }else if($mat == "Anglais entreprise"){
        return "#ffccff";
    }else if($mat == "Réseau & Prog bas niveau"){
        return "#99ff99";
    }else {
        return "#FFFFFF";
    }
}

function getTxtByGroup($groupName){
    if($groupName == "infoS1"){
        return "S1";
    }else if($groupName == "infoS2"){
        return "S2";
    }else if($groupName == "infoS3"){
        return "S3";
    }else if($groupName == "infoS4"){
        return "S4";
    }else if($groupName == "infoS5"){
        return "S5";
    }else if($groupName == "infoS6"){
        return "S6";
    }
}

function getNameToWelcome(){
    if(isset($_COOKIE['username'])){
       return "Bonjour, ".$_COOKIE['username'];
    }else {
        return "Bonjour, ".getTxtByGroup($_COOKIE['user_group']);
    }
}
