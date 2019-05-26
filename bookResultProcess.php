<?php
require "config.php";
  if (isset($_GET["title"]) && isset($_GET["author"]) && isset($_GET["url"])
    && isset($_GET["description"]) && isset($_GET["isbn_13"]) && isset($_GET["year"])
    && isset($_GET["publisher"]) && isset($_GET["pages"]) && isset($_GET["image"])) {

    $title = $_GET["title"];
    $author = $_GET["author"];
    $url = $_GET["url"];
    $description = addslashes($_GET["description"]);
    $isbn_13 = $_GET["isbn_13"];
    $year = $_GET["year"];
    $publisher = $_GET["publisher"];
    $pages = $_GET["pages"];
    $img = $_GET["image"]."&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api%27";
    $info = array($title, $author, $url, $description, $isbn_13, $year, $publisher, $pages, $img);
  }
// for ($i = 0; $i < 9; $i++) {
//   echo $info[$i];
//   echo "<br>";
// }
  // if ($year == Date("Y")) {
  //   $year = Date($year, 01, 01);
  // }
  
  $sql = "INSERT INTO `books`(`ISBN`, `Title`, `Author`, `PublishedDate`, `Publisher`, `BookDescription`, `Pages`, `BookCover`)
  VALUES ('{$isbn_13}','{$title}','{$author}','{$year}','{$publisher}','{$description}','{$pages}','{$img}')";
  $result = mysqli_query($connect, $sql);
//   if ($result) {
//     echo "Success";
//   }else {
//     echo "Failed";
//   }

// echo '<script type="text/javascript"> console.log("Result: '.$result.'")</script>';

//$sql = 'SELECT * FROM books WHERE title ="'+$title+'";';
 ?>
