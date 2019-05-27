<?php
require "session.php";
require "config.php";
$id = $_SESSION['UserID'];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["Title"]) && isset($_GET["Author"]) && isset($_GET["Edition"])
  && isset($_GET["ISBN"]) && isset($_GET["Pages"])) {
    $title = $_GET["Title"];
    $author = $_GET["Author"];
    $edition = $_GET["Edition"];
    $isbn_13 = $_GET["ISBN"];
    $pages = $_GET["Pages"];
    $date = date("Y-m-d");
    

    $info = array($title, $author, $edition, $isbn_13, $pages);
    if (isset($_GET["Year"])) {
      $year = $_GET["Year"];
      array_push($info, $year);
    }else {
      $year = "";
    }
    if (isset($_GET["Publisher"])) {
      $publisher = $_GET["Publisher"];
      array_push($info, $publisher);
    }else {
      $publisher = "";
    }
    if (isset($_GET["CoverLink"]) && $_GET["CoverLink"]!="") {
      $img = $_GET["CoverLink"];
      array_push($info, $img);
    }elseif (isset($_GET["CoverImg"]) && $_GET["CoverImg"]!="") {
      $img = $_GET["CoverImg"];
      array_push($info, $img);
    }else {
      $img = "uploads/noimage.png";
    }

    

  
    $sql = "INSERT INTO `books`(`ISBN`, `Title`, `Author`, `PublishedDate`, `Publisher`, `Pages`, `BookCover`)
    VALUES ('{$isbn_13}','{$title}','{$author}','{$year}','{$publisher}','{$pages}','{$img}')";
    $result = mysqli_query($conn, $sql);

    $query = "INSERT INTO owned (UserID, ISBN, CreatedDate)
    VALUES ('$id', '$isbn_13', '$date')";
    $rowned = mysqli_query($conn,$query);
//     if ($result) {
//       echo "Success";
//     }else {
//       echo "Failed";
//     }
  }
}
 ?>
