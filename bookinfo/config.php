<?php

    $servername = "localhost";
    $dbname = "biblio";
    $user = "user";
    $pword = "user12345";

    $conn = mysqli_connect($servername, $user, $pword,$dbname);
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
?>
