<?php 

    include '../session.php';
    include_once("../config.php");
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
		<blockquote style=padding-top:20px><strong>“When I get hold of a book I particularly admire, I am so enthusiastic that I loan it to someone who never brings it back.”
</strong><br><i>― Edgar Watson Howe</i></blockquote>
	</div>

	<form method="GET" action="lending-addCart.php">
	<div class="form-group">
		<label for="username">Member's Name </label>
		<input list="members" name="memberID" type="text">
		<datalist id="members">
		<?php

        $id = $_SESSION["UserID"];
		$result = mysqli_query($conn, "SELECT MemberID, CONCAT( FirstName, ' ', LastName ) AS Name from members WHERE UserID =$id")  ;
		while($res=mysqli_fetch_array($result)){
            $memberID = $res['MemberID'];
            $name = $res['Name'];
			echo "<option value='$memberID'>$name</option>";
		}

		?>
		</datalist>
	</div>
  <div style="width:300px; margin:0 auto;">
  <input class="edit-btn" style=background-color:black type="button" value="Go back!" onclick="history.back()">
  <button type="submit" class="edit-btn">Next</button>

  </div>
	</form>

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
</body>

</html>
