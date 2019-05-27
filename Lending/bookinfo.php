<?php 
    include '../config.php';

    $isbn = '9781400069286';
    $query = "SELECT * FROM books INNER JOIN owned ON owned.ISBN=books.ISBN";
    $data = $conn -> query($query);
    $result = $data -> fetch(PDO::FETCH_ASSOC);

    $isbn = $result['ISBN'];
    $title = $result['Title'];
    $author = $result['Author'];
    $genre = $result['Genre'];
    $pubishDate = $result['PublishedDate'];
    $publisher = $result['Publisher'];
    $desc = $result['BookDescription'];
    $pages = $result['Pages'];
    $cover = $result['BookCover'];
    $copies = $result['Copies'];
    $created = $result['CreatedDate'];
    $review =$result['Review'];
    $rate = $result['Rate'];
    $bstatus = $result['BookStatus'];
?>

<head>
    <title>Dashboard - Biblio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="..\biblio.css">
    <style>

        .container {
            padding-top:20px;
        }
        #header, .navigation, footer{
            min-width:600px;
        }        
    </style>

</head>

<body>

    <?php
        include 'lendheader.php';
    ?>
    <main class="container">

        <div class="alert alert-warning" role="alert">
            <h2>Book Details</h2>
            <div id="btn-div">
                <button class="edit-btn" id="edit">Edit</button>
                <button class="edit-btn" onclick="goBack()">Back</button>
            </div>
        </div>

        

        <div class="book-boxes center">

            <div>
                <h2 class="bookinfo-title"><?php echo $title; ?></h2>
            </div>
            
            
            <div class="top">
                <div class="book-left">
                    <img src=<?php echo $cover;?> class="book-img">
                    <div class="wrapper">
                        <input type="checkbox" id="st1" value="1" />
                        <label for="st1"></label>
                        <input type="checkbox" id="st2" value="2" />
                        <label for="st2"></label>
                        <input type="checkbox" id="st3" value="3" />
                        <label for="st3"></label>
                        <input type="checkbox" id="st4" value="4" />
                        <label for="st4"></label>
                        <input type="checkbox" id="st5" value="5" />
                        <label for="st5"></label>
                    </div>
                </div>
                    
                <div id="description">
                    <p><?php echo $desc; ?></p>
                </div>   
            </div>
             

            <div class="bottom">
                <h4>Details</h4>
                <table class="table2">
                <tr>
                    <td class="table-attr">Title</td>
                    <td><?php echo $title;?></td>
                </tr>
                <tr>
                    <td class="table-attr">Author</td>
                    <td><?php echo $author;?></td>
                </tr>
                <tr>
                    <td class="table-attr">Genre</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="table-attr">Edition</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="table-attr">ISBN</td>
                    <td><?php echo $isbn;?></td>
                </tr>
                <tr>
                    <td class="table-attr">Published Date</td>
                    <td><?php echo $pubishDate;?></td>
                </tr>
                <tr>
                    <td class="table-attr">Publisher</td>
                    <td><?php echo $publisher;?>g</td>
                </tr>
                <tr>
                    <td class="table-attr">Pages</td>
                    <td><?php echo $pages;?></td>
                </tr>
                <tr>
                    <td class="table-attr">Copies</td>
                    <td><?php echo $copies;?></td>
                </tr>
                <tr>
                    <td class="table-attr">Created Date</td>
                    <td><?php echo $created;?></td>
                </tr>
            </table>
            </div>
            <div class="review">
                <h4>Review</h4>
                <p><?php echo $review;?></p>
            </div>
        </div> 

        
    </main>
    <footer class="text-center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com</br>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script>

    function goBack() {
        window.history.back();
    }

    </script>
</body>

</html>
