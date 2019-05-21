<?php 
include '../config.php';

$isbn = $_GET['isbn'];
$query = "SELECT * FROM books INNER JOIN owned ON owned.ISBN=books.ISBN WHERE books.ISBN=$isbn";
$data = mysqli_query($conn,$query);
$result = mysqli_fetch_assoc($data);

$isbn = $result['ISBN'];
$title = $result['Title'];
$author = $result['Author'];
$genre = $result['Genre'];
$publishDate = $result['PublishedDate'];
$publisher = $result['Publisher'];
$desc = $result['BookDescription'];
$pages = $result['Pages'];
$copies = $result['Copies'];
$created = $result['CreatedDate'];
$review =$result['Review'];
?>

<html lang="en">
<head>
    <link rel="icon" href="../media/Bilbio_icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="..\biblio.css">
    <style>
        .book-boxes{
            overflow:hidden;
        }
    </style>
    <title>Biblio - Edit Book Info</title>
</head>
<body>
<body>

<header id="header">
    <!--Menu Button-->
    <a id="biblio" href="index.php">
        <h2>Biblio</h2>
    </a>

    <!-- profile picture -->
    <div class="dropdown">
        <img src="../media/profile pic.png" role="button" id="profile" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">


        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Setting</a>
            <a class="dropdown-item" href="preview.html">Logout</a>
        </div>
    </div>
</header>

<nav class="navigation">
    <div>
        <ul>
            <li class="navigation-item active">
                <a href="../index.php">DASHBOARD</a>
            </li>
            <li class="navigation-item">
                <a href="../book.php">BOOKS</a>
            </li>

            <li class="navigation-item">
                <a href="../Lending/lending.html">LENDING</a>
            </li>

            <li class="navigation-item">
                <a href="../member/member.php">MEMBER</a>
            </li>
            <li class="navigation-item">
                <a href="../statistic.pgp">STATISTIC</a>
            </li>
        </ul>
    </div>
</nav>


<main class="container alert-top">


    <div class="alert alert-warning" role="alert">
        <h2>Edit Book Info</h2>
    </div>
<div class="book-boxes center">
    <form id="editinfo" method="POST" action="editprocess.php">
        <table class="table2">
            <tr>
                <td class="table-attr">Title</td>
                <td><input name="title" class="form-control" type=text value="<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Author</td>
                <td><input name="author" class="form-control" type=text value="<?php echo $author;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Genre</td>
                <td><input name="genre" class="form-control" type=text value="<?php echo $genre;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">ISBN</td>
                <td><input name="isbn" class="form-control" type=text value="<?php echo $isbn;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Published Date</td>
                <td><input name="pubdate" class="form-control" type=date value="<?php echo $publishDate;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Publisher</td>
                <td><input name="pub" class="form-control" type=text value="<?php echo $publisher;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Pages</td>
                <td><input name="pages" class="form-control" type=text value="<?php echo $pages;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Copies</td>
                <td><input name="copies" class="form-control" type=text value="<?php echo $copies;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Created Date</td>
                <td><input name="credate" class="form-control" type=timestamp value="<?php echo $created;?>"></td>
            </tr>
            <tr>
                <td class="table-attr">Description</td>
                <td><textarea name="desc" class="form-control" rows="10"><?php echo $desc;?></textarea></td>
            </tr>
            <tr>
                <td class="table-attr">Review</td>
                <td><textarea name="review" class="form-control" rows="10"><?php echo $review;?></textarea></td>
            </tr>
        </table>
        <br>
        <button name="edit" class="edit-btn" id="edit" type="submit" value="Done">Done</button>
    </form>


</main>
<footer class="text-center font-italic">
    <hr>
    Copyright &copy 2019 Biblio.com<br>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>


</body>
</html>