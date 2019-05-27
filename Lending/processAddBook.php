<?php
include_once("../config.php");
include '../session.php';
$memberID = $_GET['memberID'];
$ISBN = $_GET['ISBN'];
$id = $_SESSION['UserID'];
$today = date('Y-m-d');


$sql = mysqli_query($conn, "INSERT INTO transactions (ISBN, MemberID, BorrowDate, ExpiredDate, TransactionStatus) VALUES ('$ISBN', '$memberID', '$today', DATE_ADD('$today', interval 1 month), 'Lending')");
$member = mysqli_query($conn, "UPDATE members SET booksBorrowed=booksBorrowed+1 where MemberID='$memberID'");

//check availability of books
$owned = mysqli_query($conn, "SELECT Copies from owned where UserID=$id and ISBN='$ISBN'");
while($o=mysqli_fetch_array($owned)){
  $copies = $o['Copies'];
  $transaction = mysqli_query($conn, "SELECT COUNT(*) from transactions where TransactionStatus='Lending' and ISBN='$ISBN'");
  while($t=mysqli_fetch_array($transaction)){
    $bookLend = $t['COUNT(*)'];
  }
  $copiesAvailable = $copies - $bookLend;
  if($copiesAvailable<=0){
    $cart = mysqli_query($conn, "DELETE FROM cart WHERE ISBN='$ISBN'");
  }
}


header('Location: lending-viewCart.php?memberID='.$memberID.'');
?>
