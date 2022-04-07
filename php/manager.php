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
