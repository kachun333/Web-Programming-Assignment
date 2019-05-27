<?php
include '../session.php';
include_once('../config.php');

$ISBN = $_GET["ISBN"];
$memberID = $_GET["memberID"];

// $member = mysqli_query($conn, "SELECT MemberID from members where CONCAT( FirstName, ' ', LastName )='$name'");
// while($row=mysqli_fetch_array($member)){
//   $memberID = $row['MemberID'];
// }
$getID = mysqli_query($conn, "SELECT MAX(CartID)+1 as ID from cart");    
     
while($r = mysqli_fetch_array($getID)){
  $lastID = $r['ID'];
}
$cart = mysqli_query($conn, "INSERT INTO cart (CartID, ISBN, MemberID) VALUES ('$lastID', '$ISBN', '$memberID')");
header('Location: lending-addCart.php?memberID='.$memberID.'');

?>
