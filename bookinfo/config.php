<?php

try{
    $connString = "mysql:host=localhost;dbname=biblio";
    $user = "user";
    $pword = "user123";

    $conn = new PDO ($connString, $user, $pword);
    $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die($e->getMessage());
}    


?>