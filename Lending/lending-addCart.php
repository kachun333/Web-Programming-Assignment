<?php
	include_once("../config.php");
	include '../session.php';
	$memberID=$email=$address="";
	$hp=$bookBorrowed=0;
	$id = $_SESSION['UserID'];
	if (isset($_GET["memberID"])){
		$memberID = $_GET["memberID"];
	}
	$checkUser = mysqli_query($conn, "SELECT COUNT(*) from members where MemberID ='$memberID' AND UserID = $id");
	while($e=mysqli_fetch_array($checkUser)){
		$exist = $e['COUNT(*)'];
	}
	if($exist==0){
		echo
		'<script>
		alert("Member havent register!");
		window.location.href="lending-searchMember.php";
		</script>';
	}
	$_SESSION["memberID"] = "$memberID";
	$result= mysqli_query($conn, "SELECT * , CONCAT( FirstName, ' ', LastName ) AS Name from members where MemberID = '$memberID' AND UserID =$id");
	while($res=mysqli_fetch_array($result)){
		$name = $res['Name'];
		$hp = $res['PhoneNumber'];
		$email = $res['Email'];
		$address = $res['MemberAddress'];
		$bookBorrowed = $res['BooksBorrowed'];
	}
	$check = mysqli_query($conn, "SELECT COUNT(*) FROM transactions where TransactionStatus='Lending' and MemberID='$memberID'");
	

	while($row=mysqli_fetch_array($check)){
		$count = $row['COUNT(*)'];
	}
	if($count>=5){
		echo
		'<script>
		alert("Please return the book(s) first!");
		window.location.href="lending.php";
		</script>';
	}

	
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

	  
	<?php
        include 'lendheader.php';
	?>
	
    <main class="container" style="padding-bottom:100px;padding-top:20px" >
	<div>
	<div class="alert alert-warning" role="alert" style=text-align:center>
		<h2>Lending - Add Book To Cart</h2>
	</div>
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
      <th scope="row">Address</th>
      <td><?php echo $address;?></td>
    </tr>
	</tbody>
	</table>
</div>
<div class="lend">
	<div class="float-left"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for book names.."></div><br>

	<div class="lend-btns">
		<input class="edit-btn" style="background-color:black; top:2px" type="button" value="Go back!" onclick="history.back()">
		<?php echo '<a href=\'lending-viewCart.php?memberID='.$memberID.'\' class="edit-btn btn" style=text-align:center>View Cart</a>';?>
	</div>
</div>
	<?php
	$i = 0;
	// correct the user id
	$owned = mysqli_query($conn, "SELECT ISBN, copies from owned where UserID=$id");

	echo '<table id="myTable"><tr>';
	while($o=mysqli_fetch_array($owned)){
		$ISBN = $o['ISBN'];
		$copies = $o['copies'];
		$transaction = mysqli_query($conn, "SELECT COUNT(*) from transactions where TransactionStatus='Lending' and ISBN='$ISBN'");

		while($t=mysqli_fetch_array($transaction)){
			$bookLend = $t['COUNT(*)'];
		}
		$copiesAvailable = $copies - $bookLend;
		if($copiesAvailable>0){
			$query = mysqli_query($conn, "Select Title, BookCover from books where ISBN='$ISBN'");
			while($r=mysqli_fetch_array($query)){
				$title = $r['Title'];
				$url = $r['BookCover'];
			}
			if ($i<=3){
				echo '<td><div>
				<div class="card" style="width: 18rem;">
				<img src="'.$url.'"class="card-img-top" alt="" align="middle" style="width:200px;height=500px>
				<div class="card-body">
					<h5 class="card-title"><a href=\'..\bookinfo\bookinfo.php?ISBN='.$ISBN.'\' style=color:black>'.$title.'<a></h5>
					<a onclick="c()" href=\'processAddCart.php?ISBN='.$ISBN.'&memberID='.$memberID.'\'>Add To Cart</a>
				</div>
				</div>
				</div>
				</td>';
			}else{
				echo '</tr><tr>';
				echo '<td><div>
				<div class="card" style="width: 18rem;">
				<img src="'.$url.'" class="card-img-top" alt="" align="middle" style="width:200px;height=500px>
				<div class="card-body">
					<h5 class="card-title"><a href=\'..\bookinfo\bookinfo.php?ISBN='.$ISBN.'\' style=color:black>'.$title.'<a></h5>
					<a onclick="c()" href=\'processAddCart.php?ISBN='.$ISBN.'&memberID='.$memberID.'\'>Add To Cart</a>
				</div>
				</div>
				</div></td>';
				$i = 0;
			}
			$i++;
		}
	}
	echo '</tr></table>';
	?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"crossorigin="anonymous"></script>
	<script>
	function c(){
			alert("Book has added to cart!");
	}
	function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("td");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("a")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
	</script>
 </main>
    <footer class="container text-center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com</br>
    </footer>

</body>
</html>
