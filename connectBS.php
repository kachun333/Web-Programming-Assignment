<?php
$host = "localhost";
$user = "user";
$pass = "user12345";
$db = "biblio";

$connect = new mysqli($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL'. mysqli_connect_errno();
}


 ?>
