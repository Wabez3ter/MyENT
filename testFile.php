<?php

$con = mysqli_connect("localhost","root","","myent");

// SQL query to display row count
// in building table
$sql = "SELECT * from devoir";

if ($result = mysqli_query($con, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );

    // Display result
    printf("Total rows in this table : %d\n", $rowcount);
}

// Close the connection
mysqli_close($con);
