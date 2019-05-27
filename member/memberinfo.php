<?php 
    include '../config.php';
    include '../session.php';

    $id = $_SESSION['UserID'];
    $memberID = $_GET['memberId'];

    $sql = "SELECT * FROM members WHERE MemberID = $memberID";
    $trans = "SELECT transactions.TransactionID, transactions.ISBN, books.Title , transactions.BorrowDate, transactions.ExpiredDate,transactions.ReturnDate FROM transactions 
    INNER JOIN books ON transactions.ISBN = books.ISBN 
    WHERE transactions.MemberID = '$memberID'";

    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);

    $name = $data["FirstName"]." ".$data["LastName"];
    $nophone = $data["PhoneNumber"];
    $email = $data["Email"];
    $address = $data["MemberAddress"];
    $photo = $data["Photo"];

    $rtrans = mysqli_query($conn,$trans);
?>


<html>
    <head>
        <title><?php echo "Biblio - ".$title?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="..\biblio.css">
        <style>

            #header, .navigation, footer{
                min-width:600px;
            }        

            .top{
                padding-bottom:20px;
            }

            .header th{
                vertical-align:top;
            }
        </style>

    </head>

    <body>

        <?php include 'memberheader.php'?>
        
        <main class="container alert-top">

            <div class="alert alert-warning" role="alert">
                <h2>Member Details</h2>
                <div id="btn-div">
                    <?php echo "<a href='editmember.php?memberId=$memberID'><button class='edit-btn'>Edit</button></a>";?>
                    <a href="member.php"><button class="edit-btn">Back</button></a>
                </div>
            </div>

            

            <div class="book-boxes center">


                <div class="top">
                    <div class="book-left">
                        <img src=<?php echo $photo;?> class="book-img">
                    </div>

                    <div class="lend-right">
                        <h4>Details</h4>
                        <table class="table3">
                            <tr>
                                <td class="table-attr">Member ID</td>
                                <td><?php echo $memberID;?></td>
                            </tr>
                            <tr>
                                <td class="table-attr">Name</td>
                                <td><?php echo $name;?></td>
                            </tr>
                            <tr>
                                <td class="table-attr">Phone Number</td>
                                <td><?php echo $nophone;?></td>
                            </tr>
                            <tr>
                                <td class="table-attr">Email</td>
                                <td><?php echo $email;?></td>
                            </tr>
                            <tr>
                                <td class="table-attr">Address</td>
                                <td><?php echo $address;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                

                
                <div class="review">
                    <h4>Transactions</h4>
                    <table id="myTable" class="table table-hover table-bordered">

                    <thead>
                    <tr class="header">
                        <th scope="col" style="width:10%">Transaction ID</th>
                        <th scope="col" style="width:15%">Title</th>
                        <th scope="col" style="width:10%">ISBN</th>
                        <th scope="col" style="width:10%">Borrowed Date</th> 
                        <th scope="col" style="width:10%">Due Date</th> 
                        <th scope="col" style="width:10%">Returned Date</th> 
                    </tr>
                    </thead>

                    <?php 
                        while($res = mysqli_fetch_array($rtrans)) { 		
                            echo "<tr>";
                            echo "<td>".$res['TransactionID']."</td>";
                            echo "<td>".$res['Title']."</td>";
                            echo "<td>".$res['ISBN']."</td>";	
                            echo "<td>".$res['BorrowDate']."</td>";	
                            echo "<td>".$res['ExpiredDate']."</td>";	
                            echo "<td>".$res['ReturnDate']."</td>";		
                        }
                    ?>  
                    </table>
                </div>
            
            </div> 

            
        </main>
        <footer class="text-center font-italic">
            <hr>
            Copyright &copy 2019 Biblio.com<br>
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
