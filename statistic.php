<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="media/Bilbio_icon.png">
    <title>Statistics - Biblio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="biblio.css">
    <link rel="stylesheet" href="statistic.css">
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

    <nav class="navigation" style="margin-bottom:20px">
        <div>
            <ul>
                <li class="navigation-item active">
                    <a href="index.html">DASHBOARD</a>
                </li>
                <li class="navigation-item">
                    <a href="book.html">BOOKS</a>
                </li>

                <li class="navigation-item">
                    <a href="Lending/lending.html">LENDING</a>
                </li>

                <li class="navigation-item">
                    <a href="member.html">MEMBER</a>
                </li>
                <li class="navigation-item">
                    <a href="#">STATISTIC</a>
                </li>

            </ul>
        </div>
    </nav>
    <main class="container">
      <?php
        require('connectBS.php');

        // $logedInUsername = $_SESSION['user']['username'];

        //Create Query
        $qBooksTotal = 'SELECT SUM(Copies) FROM owned WHERE UserID = 1';
        $qMembersTotal = 'SELECT COUNT(MemberID) FROM members WHERE UserID = 1';
        $qLoanedTotal = 'SELECT COUNT(booktransactions.TransactionID) FROM booktransactions INNER JOIN members ON booktransactions.MemberID = members.MemberID WHERE UserID = 1';
        $qOverdueTotal = 'SELECT COUNT(booktransactions.TransactionID) FROM booktransactions INNER JOIN members ON booktransactions.MemberID = members.MemberID WHERE UserID = 1 AND booktransactions.ReturnDate > "getDate()"';
        //top 5
        $qTopMembers = 'SELECT COUNT(TransactionID), members.MemberID, members.LastName, members.FirstName FROM booktransactions INNER JOIN members ON booktransactions.MemberID = members.MemberID WHERE UserID=1 GROUP BY MemberID ORDER BY COUNT(booktransactions.TransactionID) DESC, MemberID ASC LIMIT 5';
        $qTopBooks = 'SELECT COUNT(TransactionID), books.ISBN, books.Title, books.BookCover FROM booktransactions INNER JOIN books ON booktransactions.ISBN = books.ISBN INNER JOIN members ON booktransactions.MemberID = members.MemberID WHERE UserID=1 GROUP BY ISBN ORDER BY COUNT(booktransactions.TransactionID) DESC, ISBN ASC LIMIT 5';
        //GROUP BY ISBN ORDER BY COUNT(booktransactions.TransactionID) DESC, ISBN ASC LIMIT 5
        //Get Result
        $rBooksTotal = mysqli_query($connect, $qBooksTotal);
        $rMembersTotal = mysqli_query($connect, $qMembersTotal);
        $rLoanedTotal = mysqli_query($connect, $qLoanedTotal);
        $rOverdueTotal = mysqli_query($connect, $qOverdueTotal);
        $rTopMembers = mysqli_query($connect, $qTopMembers);
        $rTopBooks = mysqli_query($connect, $qTopBooks);


        //Fetch Data
        // $BooksTotal = mysqli_fetch_all($rBooksTotal, MYSQLI_ASSOC);
        $BooksTotal = mysqli_fetch_assoc($rBooksTotal);
        $MembersTotal = mysqli_fetch_assoc($rMembersTotal);
        $LoanedTotal = mysqli_fetch_assoc($rLoanedTotal);
        $OverdueTotal = mysqli_fetch_assoc($rOverdueTotal);

      ?>
      <script type="text/javascript" src="statistic_js/statistic.js">
        var data1 = [5, 10, 20, 40, 50, 10,90];
      </script>
      <div class="alert alert-warning" role="alert">
        <h2>Statistics</h2>
      </div>
      <div class="boxes center">
        <hr style="margin-top:0px">
          <div id="div1" class="quadrant">
            <h6>Books Avaliable</h6>
            <h1 id="counter1"><?php echo $BooksTotal['SUM(Copies)']; ?></h1>
          </div>
          <div id="div2" class="quadrant">
            <h6>Total Members</h6>
            <h1 id="counter2"><?php echo $MembersTotal['COUNT(MemberID)']; ?></h1>
          </div>
          <div id="div3" class="quadrant center">
            <h6>Books Loaned</h6>
            <h1 id="counter3"><?php echo $LoanedTotal['COUNT(booktransactions.TransactionID)']; ?></h1>
          </div>
          <div id="div4" class="quadrant">
            <h6>Books Overdue</h6>
            <h1 id="counter4"><?php echo $OverdueTotal['COUNT(booktransactions.TransactionID)']; ?></h1>
          </div>
        <hr>
          <div>
            <h5>Graph Statistic</h5>
            <canvas id="canvas"></canvas>
          </div>
        <hr>
          <div>
            <h5>Top 5 Most Active Members</h5>
              <?php
                $counter = 1;
                while($TopMembers = mysqli_fetch_assoc($rTopMembers)){
                  echo "<a href='memberinfo.php?id=".$TopMembers['MemberID']."'>";
                  echo  "<figure class=\"figure\">";
                  echo    "<img id='membersize' src='media/MemberPhoto/".$TopMembers['MemberID'].".png' class='figure-img img-fluid'>";
                  echo    "<figcaption class=\"figure-caption\">#".$counter." - ".$TopMembers['FirstName']." ".$TopMembers['LastName']." (".$TopMembers['COUNT(TransactionID)']." times)";
                  echo    "</figcaption>";
                  echo  "</figure>";
                  echo "</a>";
                  $counter += 1;
                  };
              ?>
          <hr>
          <div>
            <h5>Top 5 Most Frequently Loaned Book</h5>
            <?php
              while($TopBooks = mysqli_fetch_assoc($rTopBooks)){
                $counter = 1;
                echo "<a href='bookinfo.php?id=".$TopBooks['ISBN']."'>";
                echo  "<figure class=\"figure\">";
                echo    "<img id='membersize' src=".$TopBooks['BookCover']." class='figure-img img-fluid'>";
                echo    "<figcaption class=\"figure-caption\">#".$counter." - ".$TopBooks['Title']." (".$TopBooks['COUNT(TransactionID)']." times)";
                echo    "</figcaption>";
                echo  "</figure>";
                echo "</a>";
                $counter += 1;
                };
            ?>
        <hr>
        <div class="rowe">
            <div class="column">
                <h5>Genre of Books Own</h5>
                <canvas id="chart-area"></canvas>
            </div>

            <div class="column">
              <h5>Genre of Books Loaned Out</h5>
              <canvas id="chart-area2"></canvas>
            </div>
        </div>
        <hr>
      </div>
    </main>
    <?php
      //Free Result
      mysqli_free_result($rBooksTotal);
      mysqli_free_result($rMembersTotal);
      mysqli_free_result($rLoanedTotal);
      mysqli_free_result($rOverdueTotal);
      //mysqli_free_result($rTopMembers);

      //close connection
      mysqli_close($connect);
     ?>
    <footer class="center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com</br>
    </footer>
  	<script src="statistic_js/utils.js"></script>
    <script type="text/javascript" src="statistic_js/CountUp.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript" src="statistic_js/statistic.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
