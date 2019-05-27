<?php
include_once("../config.php");
$ID = $_GET['ID'];
$result = mysqli_query($conn, "SELECT t.ISBN, TransactionStatus, ReturnDate, t.MemberID, CONCAT( FirstName, ' ', LastName ) AS Name, Email, BooksBorrowed, Copies, Title FROM transactions t inner join books bo on t.ISBN = bo.ISBN inner join owned o on o.ISBN = t.ISBN inner join members b on t.memberID = b.memberID where TransactionID='$ID'");

while($res = mysqli_fetch_array($result))
{
	$ISBN = $res['ISBN'];
	$bookName = $res['Title'];
	$memberID = $res['MemberID'];
	$borrowerName = $res['Name'];
	$email = $res['Email'];
    $copies = $res['Copies'];
    $today = date('Y-m-d');
}
$update = mysqli_query($conn, "UPDATE transactions SET ReturnDate='$today', TransactionStatus='Returned' where TransactionID=$ID");
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../media/Bilbio_icon.png">
    <title>Book Returning</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../biblio.css">
		<style>
    #myInput {
      background-image: url('/css/searchicon.png'); /* Add a search icon to input */
      background-position: 10px 12px; /* Position the search icon */
      background-repeat: no-repeat; /* Do not repeat the icon image */
      width: 100%; /* Full-width */
      font-size: 16px; /* Increase font-size */
      padding: 12px 20px 12px 40px; /* Add some padding */
      border: 1px solid #ddd; /* Add a grey border */
      margin-bottom: 12px; /* Add some space below the input */
    }

    #myTable {
      border-collapse: collapse; /* Collapse borders */
      width: 100%; /* Full-width */
      border: 1px solid #ddd; /* Add a grey border */
      font-size: 18px; /* Increase font-size */
    }

    #myTable th, #myTable td {
      text-align: left; /* Left-align text */
      padding: 12px; /* Add padding */
    }

    #myTable tr {
      /* Add a bottom border to all table rows */
      border-bottom: 1px solid #ddd;
    }

    #myTable tr.header, #myTable tr:hover {
      /* Add a grey background color to the table header and on hover */
      background-color: #f1f1f1;
    }
    </style>
</head>

<body>

    <?php
        include 'lendheader.php';
    ?>

    <main class="container alert-top">
	<div class="alert alert-warning" role="alert">
		<h2>Returning - Book Check In</h2>
	</div>
		<h3>Thank you!</h3>
		<div class="alert alert-dark" role="alert">
			<?php
			$count = mysqli_query($conn, "SELECT COUNT(*) FROM transactions where TransactionStatus='Lending' and MemberID='$memberID'");
			while($s=mysqli_fetch_array($count)){
				$booksHold = $s['COUNT(*)'];
			}
			?>
			<table id="myTable">
  			<thead>
    			<tr>
						<th scope="row">Member Name</th>
        		<td><?php echo "$borrowerName" ?></td>
					</tr>
					<tr>
						<th scope="row">Email</th>
        		<td><?php echo "$email" ?></td>
					</tr>
					<tr>
						<th scope="row">Number of book holding</th>
        		<td><?php echo "$booksHold" ?></td>
					</tr>
					<tr>
						<td colspan="2">You have return <strong><i>"<?php echo "$bookName"?>"</i></strong></td>
					</tr>
			 	</thead>
		</table>
		</div>
		<div style="width:300px; margin:0 auto;">
		<a class="edit-btn btn" href="lending.php" role="button" style=text-align:center>Done</a>
	</div><br>
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
