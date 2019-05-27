<?php
//including the database connection file
include_once("config.php");


?>


<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../media/Bilbio_icon.png">
    <title>Dashboard - Biblio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="biblio.css">
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

    <?php include 'header.php'?>

    <main class="container alert-top" >
	<a href="book.php"><button id="add-book-btn" type="button" class="btn">Back</button></a>
	 <form id="category" action="search.php" method="POST" >

    <div class="float-center form-group col-md-6">
   
      <input name = "searchterm" type="text" required class="form-control" placeholder="Search Book Title or Author Name" title="Type in name" aria-label="Search"> <br>
	 <!--<div class="form-group col-md-6">-->
		 <select name="searchtype" class="form-control form-group col-md-3">
			<option value="Author">Author</option>
			<option value="Title">Title</option>
			<option value="ISBN">ISBN</option>
 
		</select>
	</div>
       <!-- <input type="submit" name="submit" value="Search"> -->
	   
        &nbsp; &nbsp; <button type ="submit" name="submit" value="Search" class="btn">Search</button>
      
	  <div class="float-right">
        <a href="bookSearch.html"><button id="add-book-btn" type="button" class="btn">Add Book</button></a>
      </div> 
	  
	  
	  
	  
    </form>
   
   
<table id="myTable" class="table table-hover table-bordered" style="margin-right:5px;">
<thead>
  <tr class="header">
    <th scope="col" style="width: 4%;"> Book Cover</th>
	<th scope="col" style="width: 5%;"> ISBN</th>
    <th scope="col" style="width:20%;">Title</th>
	  <th scope="col" style ="width: 7.5%;"> Author </th>
	  <th scope="col" style ="width: 5%;">Book info</th> 
   
  </tr>
  </thead>
  <?php
    // create short variable names
    $searchtype=$_POST['searchtype'];
    $searchterm="%{$_POST['searchterm']}%";

    if (!$searchtype || !$searchterm) {
       echo '<p>You have not entered search details.<br/>
       Please go back and try again.</p>';
       exit;
    }

    // whitelist the searchtype
    switch ($searchtype) {
      case 'Title':
      case 'Author':
      case 'ISBN':
        break;
      default: 
        echo '<p>That is not a valid search type. <br/>
        Please go back and try again.</p>';
        exit; 
    }


    $query = "SELECT BookCover,Author,Title,ISBN FROM books WHERE $searchtype like ? ORDER BY Title";
    $stmt = $conn->prepare($query);
	
	$stmt->bind_param('s', $searchterm);  
    $stmt->execute();
    $stmt->store_result(); //to store the results
  
    $stmt->bind_result($BookCover, $author, $title, $ISBN);
	

    echo "<br><p>Number of books found: ".$stmt->num_rows."</p>";

    while($stmt->fetch()) {
		echo "<tr>";
		echo "<td>" ?> <img src="<?php echo $BookCover ?>" class="book-cover-search""> <?php echo"</td>";
		echo "<td>" .$ISBN."</td>";
		echo "<td>".$title."</td>";
		echo "<td>".$author."</td>";
		echo "<td><a href=\"bookinfo.php?ISBN=$ISBN\"><button type=\"button\" class=\"btn\">View</button></a> <br><br>  
		<a href=\"delete.php?ISBN=$ISBN\" onClick=\"return confirm('Are you sure you want to delete?')\"><button type=\"button\" class=\"btn\">Delete</button></a></td>";  
		
    }

    $stmt->free_result();
    $conn->close();
  ?>
	
	
</table>

    </main>


    <footer class="container text-center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com</br>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
