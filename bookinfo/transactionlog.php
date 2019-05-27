<?php
    include '../config.php';

    $id = $_GET["id"];//take from session
    $isbn = $_GET["ISBN"];
    $sql = "SELECT transactions.TransactionID, members.FirstName, members.LastName, transactions.BorrowDate, transactions.ReturnDate FROM transactions
    INNER JOIN members ON transactions.MemberID = members.MemberID
    WHERE members.UserID='$id' AND transactions.ISBN='$isbn'";
    $result = mysqli_query($conn,$sql);
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
    <link rel="stylesheet" href="../biblio.css">
    
</head>

<body>

<?php include 'bookheader.php'?>

    <main class="container min-container alert-top">

        <div class="alert alert-warning" role="alert">
            <h2>Transaction Log</h2>
            <div id="btn-div">
                <?php echo"<a href='bookinfo.php?ISBN=".$isbn."'>"?>
                <button class="edit-btn">Back</button></a>
            </div>
        </div>
        <!-- Transaction Log -->
        <table id="myTable" class="table table-hover table-bordered">

        <thead>
        <tr class="header">
            <th scope="col" style="width:15%">Transaction ID</th>
            <th scope="col" style="width:35%">Member</th>
            <th scope="col" style="width:25%">Borrow Date</th>
            <th scope="col" style="width:25%">Returned Date</th> 
        </tr>
        </thead>

        <?php 
            while($res = mysqli_fetch_array($result)) { 		
                echo "<tr>";
                echo "<td>".$res['TransactionID']."</td>";
                echo "<td>".$res['FirstName']." ".$res['LastName']."</td>";
                echo "<td>".$res['BorrowDate']."</td>";	
                echo "<td>".$res['ReturnDate']."</td>";		
            }
        ?>  
        </table>
        <?php
        echo "Number of transaction found: ".mysqli_num_rows($result);
        ?>
    </main>
    <footer class="text-center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com<br>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
 
</body>

</html>