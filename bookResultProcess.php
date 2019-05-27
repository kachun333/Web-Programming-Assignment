<?php
require "session.php";
require "config.php";
  if (isset($_GET["title"]) && isset($_GET["author"]) && isset($_GET["url"])
    && isset($_GET["description"]) && isset($_GET["ISBN"]) && isset($_GET["year"])
    && isset($_GET["publisher"]) && isset($_GET["pages"]) && isset($_GET["image"])) {

    $id = $_SESSION["UserID"];
    $title = $_GET["title"];
    $author = $_GET["author"];
    $url = $_GET["url"];
    $desc = addslashes($_GET["description"]);
    $isbn = $_GET["ISBN"];
    $year = $_GET["year"];
    $publisher = $_GET["publisher"];
    $pages = $_GET["pages"];
    $cover = $_GET["image"]."&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api%27";
    $info = array($title, $author, $url, $desc, $isbn, $year, $publisher, $pages, $cover);
    $date = date("Y-m-d");
  }
  
// for ($i = 0; $i < 9; $i++) {
//   echo $info[$i];
//   echo "<br>";
// }
  // if ($year == Date("Y")) {
  //   $year = Date($year, 01, 01);
  // }
  
  $sql = "INSERT INTO `books`(`ISBN`, `Title`, `Author`, `PublishedDate`, `Publisher`, `BookDescription`, `Pages`, `BookCover`)
  VALUES ('{$isbn}','{$title}','{$author}','{$year}','{$publisher}','{$desc}','{$pages}','{$cover}')";
  $result = mysqli_query($conn, $sql);

  $query = "INSERT INTO owned (UserID, ISBN, CreatedDate)
  VALUES ('$id', '$isbn', '$date')";
  $rowned = mysqli_query($conn,$query);

//   if ($result) {
//     echo "Success";
//   }else {
//     echo "Failed";
//   }

// echo '<script type="text/javascript"> console.log("Result: '.$result.'")</script>';

//$sql = 'SELECT * FROM books WHERE title ="'+$title+'";';
 ?>
