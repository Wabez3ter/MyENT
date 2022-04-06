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

function refreshEDT($grp){
    $con = mysqli_connect("localhost", "root", "", "myent");


}
