<?php
require "connectBS.php";
  if (isset($_GET["title"]) && isset($_GET["author"]) && isset($_GET["url"])
    && isset($_GET["description"]) && isset($_GET["isbn_13"]) && isset($_GET["year"])
    && isset($_GET["publisher"]) && isset($_GET["pages"]) && isset($_GET["image"])) {

    $title = $_GET["title"];
    $author = $_GET["author"];
    $url = $_GET["url"];
    $description = $_GET["description"];
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
echo $description;
  $sql = "INSERT INTO `books`(`ISBN`, `Title`, `Author`, `PublishedDate`, `Publisher`, `BookDescription`, `Pages`, `BookCover`)
  VALUES ('{123}','{$title}','{$author}','{$year}','{$publisher}','{$description}','{$pages}','{$img}')";
  $result = mysqli_query($connect, $sql);
  if ($result) {
    echo "Success";
  }else {
    echo "Failed";
  }

//echo '<script type="text/javascript"> console.log("'.$info[4].'")</script>';

//$sql = 'SELECT * FROM books WHERE title ="'+$title+'";';
 ?>
