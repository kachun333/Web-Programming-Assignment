<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM book ORDER BY Title"); // using mysqli_query instead



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

    <header id="header">
        <!--Menu Button-->
        <a id="biblio" href="index.html">
            <h2>Biblio</h2>
        </a>

        <!-- profile picture -->
        <div class="dropdown">
            <img src="media/profile pic.png" role="button" id="profile" data-toggle="dropdown" aria-haspopup="true"
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
                <li class="navigation-item">
                    <a href="index.html">DASHBOARD</a>
                </li>
                <li class="navigation-item active">
                    <a href="book.php">BOOKS</a>
                </li>

                <li class="navigation-item">
                    <a href="Lending/lending.html">LENDING</a>
                </li>

                <li class="navigation-item">
                    <a href="member.html">MEMBER</a>
                </li>
                <li class="navigation-item">
                    <a href="statistic.html">STATISTIC</a>
                </li>

            </ul>
        </div>
    </nav>
	
 

	
    <main class="container" >
   
   
<table id="myTable" class="table table-hover table-bordered">
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


    $query = "SELECT BookCover,Author,Title,ISBN FROM book WHERE $searchtype like ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $searchterm);  //s stand for string
    $stmt->execute();
    $stmt->store_result(); //to store the results
  
    $stmt->bind_result($BookCover,$author, $title, $ISBN);

    echo "<p>Number of books found: ".$stmt->num_rows."</p>";

    while($stmt->fetch()) {
		echo "<tr>";
		echo "<td>" ?> <img src="<?php echo $BookCover ?>" height = "120" width = "120"> <?php echo"</td>";
		echo "<td>" .$ISBN."</td>";
		echo "<td>".$title."</td>";
		echo "<td>".$author."</td>";
		//echo "<td><a href=\"edit.php?ISBN=$stmt[ISBN]\"><button type=\"button\" class=\"btn\">View</button></a> <br><br> <a href=\"delete.php?ISBN=$stmt[ISBN]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button type=\"button\" class=\"btn\">Delete</button></a></td>";
		echo "<td>" ?> <a href = "delete.php?ISBN=$stmt[ISBN]" onClick="return confirm('Are you sure you want to delete?')" > Delete </a> <?php echo"</td>";
		
    }

    $stmt->free_result();
    $mysqli->close();
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
