<?php
$host = "localhost";
$user = "user";
$pass = "user12345";
$db = "biblio";

$connect = new mysqli($host, $user, $pass, $db);

if ($db->connect_errno) {
  die(mysqli_connect_error());
}


 ?>
