<?php
include '../session.php';
include_once('../config.php');
$memberID = $_GET['memberID'];
$_SESSION['memberID'] = $memberID;
$id = $_SESSION["UserID"];
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../media/Bilbio_icon.png">
    <title>Lending Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../biblio.css">
</head>

<body>

    <header id="header">
        <!--Home Button-->
        <div >
            <a id="biblio" href="../index.html">
              <h2>Biblio</h2>
          </a>
        </div>


        <!-- profile picture -->
        <div class="dropdown">
            <img src="../media/profile pic.png" role="button" id="profile" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">


            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Setting</a>
                <a class="dropdown-item" href="../preview.html">Logout</a>
            </div>
        </div>
    </header>

    <nav class="navigation">
        <div>
            <ul>
                <li class="navigation-item active">
                    <a href="../index.html">DASHBOARD</a>
                </li>
                <li class="navigation-item">
                    <a href="../book.html">BOOKS</a>
                </li>

                <li class="navigation-item">
                    <a href="lending.php">LENDING</a>
                </li>

                <li class="navigation-item">
                    <a href="../member.html">MEMBER</a>
                </li>
                <li class="navigation-item">
                    <a href="../statistic.html">STATISTIC</a>
                </li>

            </ul>
        </div>
    </nav>
    <main class="container" style="padding-bottom:100px;padding-top:20px" >
	<div>
	<div class="alert alert-warning" role="alert" style=text-align:center>
		<h2>Lending - Add Book To Cart</h2>
	</div>
  <?php
  $m = mysqli_query($conn, "SELECT *,  CONCAT( FirstName, ' ', LastName ) AS Name from members where MemberID='$memberID'");
  $count = mysqli_query($conn, "SELECT COUNT(*) FROM transactions INNER JOIN owned ON transactions.ISBN = owned.ISBN where transactions.TransactionStatus='Lending' and transactions.MemberID='$memberID' and owned.UserID='$id'");
  while($row=mysqli_fetch_array($m)){
    $name=$row['Name'];
    $hp=$row['PhoneNumber'];
    $email=$row['Email'];
  }
  while($b=mysqli_fetch_array($count)){
    $c=$b['COUNT(*)'];
  }
  ?>
	<div class="shadow-lg p-3 mb-5 bg-white rounded">
	<table class="table table-striped">
	<tbody>
	<tr>
      <th scope="row">Member's Name</th>
      <td><?php echo $name;?></td>
    </tr>
	<tr>
      <th scope="row">Phone Number</th>
      <td><?php echo $hp;?></td>
    </tr>
	<tr>
      <th scope="row">Email</th>
      <td><?php echo $email;?></td>
    </tr>
	<tr>
      <th scope="row">Book Hold</th>
      <td><?php echo $c;?></td>
    </tr>
	</tbody>
	</table>
</div>


	<?php
  //if $c < 5
	$i = 0;
	echo '<table><tr>';

  $cart = mysqli_query($conn, "SELECT ISBN FROM cart where memberID='$memberID' group by ISBN");
  while($a=mysqli_fetch_array($cart)){
    $ISBN = $a['ISBN'];
    $query = mysqli_query($conn, "Select Title, BookCover from books where ISBN='$ISBN'");
    while($r=mysqli_fetch_array($query)){
      $title = $r['Title'];
      $url = $r['BookCover'];
      if ($i<=3){
				echo '<td>
				<div>
				<div class="card" style="width: 18rem;">
				<img src="'.$url.'"
				class="card-img-top" alt="" align="middle" style=padding: 25px 50px 75px 100px>
				<div class="card-body">
					<h5 class="card-title">'.$title.'</h5>';
					if($c<5){echo '<a onclick="c()" href=\'processAddBook.php?ISBN='.$ISBN.'&memberID='.$memberID.'\'>Lend Book</a>';}
				echo'</div>
				</div>
				</div>
				</td>';
			}else{
				echo '</tr><tr>';
				echo '<td><div>
				<div class="card" style="width: 18rem;">
				<img src="'.$url.'"
				class="card-img-top" alt="" align="middle" style=padding: 25px 50px 75px 100px>
				<div class="card-body">
          <h5 class="card-title">'.$title.'</h5>';
          if($c<5){
            echo '<a onclick="c()" href=\'processAddBook.php?ISBN='.$ISBN.'&memberID='.$memberID.'\'>Lend Book</a>';
          }
          echo'</div>
				</div>
				</div></td>';
				$i = 0;
			}
      $i++;
		}
	}
	echo '</tr></table>';
  echo '<div style="width:300px; margin:0 auto;">
  <input class="edit-btn" style=background-color:black type="button" value="Go back!" onclick="history.back()">
  <form action="lending.php" method="POST"><button class="edit-btn" name="delete" type="submit">Done</button></form>
  </div>';

	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"crossorigin="anonymous"></script>
  <script>
	function c(){
			alert("Done lending!");
	}
	</script>
    </main>
    <footer class="container text-center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com</br>
    </footer>

</body>
</html>
