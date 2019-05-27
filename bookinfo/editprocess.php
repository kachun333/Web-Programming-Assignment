<?php 

    include '../config.php';

    if(isset($_POST['edit'])){
        $isbn = $_POST['isbn'];
        $title = addslashes($_POST['title']);
        $author = addslashes($_POST['author']);
        $genre = $_POST['genre'];
        $publishDate = $_POST['pubdate'];
        $publisher = addslashes($_POST['pub']);
        $desc = addslashes($_POST['desc']);
        $pages = $_POST['pages'];
        $copies = $_POST['copies'];
        $created = $_POST['credate'];
        $review = addslashes($_POST['review']);
        $rating = $_POST['rating'];
    


        $sql = "UPDATE books SET ISBN='$isbn', Title ='$title', Author='$author', Genre='$genre',PublishedDate='$publishDate',Publisher='$publisher',BookDescription='$desc',Pages='$pages' WHERE ISBN='$isbn'";
        $sql2 = "UPDATE owned SET Copies ='$copies', CreatedDate='$created',Review='$review',Rate='$rating' WHERE ISBN='$isbn'";
        mysqli_query($conn, $sql);
        mysqli_query($conn,$sql2);

        header("Location:bookinfo.php?ISBN=$isbn");
    }
?>