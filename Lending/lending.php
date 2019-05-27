<?php
include '../session.php';
include_once("../config.php");
$id = $_SESSION["UserID"]; 
if(isset($_POST["delete"])){
    
    $delete = mysqli_query($conn, "DELETE from carts where CartID != '0'");
  
}
$today = date('Y-m-d');
$result = mysqli_query($conn, "SELECT t.ISBN, Title, BorrowDate, TransactionID, ExpiredDate, CONCAT( FirstName, ' ', LastName ) AS Name, DATEDIFF(date_add(BorrowDate, interval 1 month),'$today') AS remainingDay 
FROM transactions t inner join books bo on t.ISBN = bo.ISBN 
inner join members b on t.MemberID = b.MemberID 
inner join owned o on t.ISBN = o.ISBN
where t.TransactionStatus='Lending' and o.UserID=$id");
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

    <?php include 'lendheader.php';?>
    <main class="container" style=padding-top:20px>
	<div class="alert alert-warning" role="alert">
        <h2>Lending - Book Checkout</h2>
        
        <div class="float-right" style="margin-top:-5px">
            <a class="edit-btn btn" href="lending-searchMember.php" role="button" style=text-align:center>Check-Out</a>
        </div>
	</div>

  <div class="float-left">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for member ...">
  </div>

  


	<table class="table table-bordered" id="myTable">
		<thead class="thead-light">
			<tr>
			<th scope="col">ISBN</th>
			<th scope="col">Book Name</th>
			<th scope="col">Member</th>
			<th scope="col">Borrow Date</th>
			<th scope="col">Due Date</th>
			<th scope="col">Remaining Day</th>
			<th scope="col">Button</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while($res = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$res['ISBN']."</td>";
				echo "<td>".$res['Title']."</td>";
				echo "<td >".$res['Name']."</td>";
				echo "<td>".$res['BorrowDate']."</td>";
				echo "<td>".$res['ExpiredDate']."</td>";
				echo "<td>";
        if($res['remainingDay']<0){
          echo "Overdue";
        }else{echo $res['remainingDay'];}
        echo"</td>";
				echo "<td><a href=\"returning.php?ID=$res[TransactionID]\">Check-In</a></td>";
			}
			?>
		</tbody>
	</table>

		<div class="float-right">
		<i style=padding-top:10px>Select the returned book.</i><br>
		</div>

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
    <script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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
</body>

</html>
