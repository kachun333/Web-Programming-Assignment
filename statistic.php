<?php
  include 'session.php';
  $id = $_SESSION["UserID"];
?>

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

    <style>

    .dropdown{
      display: block;
      float:none;
    }
    </style>
</head>

<body>

   <?php include 'header.php';?>

    <main class="container alert-top">
      <?php
        require('config.php');

        // $logedInUsername = $_SESSION['user']['username'];

        //Create Query
        
        $qBooksTotal = "SELECT SUM(Copies) FROM owned WHERE UserID = $id";
        $qMembersTotal = "SELECT COUNT(MemberID) FROM members WHERE UserID = $id";
        $qLoanedTotal = "SELECT COUNT(transactions.TransactionID) FROM transactions INNER JOIN members ON transactions.MemberID = members.MemberID WHERE UserID = $id";
        $qOverdueTotal = "SELECT COUNT(transactions.TransactionID) FROM transactions INNER JOIN members ON transactions.MemberID = members.MemberID WHERE UserID = $id AND transactions.ExpiredDate <= 'getDate()' AND transactions.TransactionStatus='Lending'";
        //top 5
        $qTopMembers = "SELECT COUNT(TransactionID), members.MemberID, members.LastName, members.FirstName, members.Photo FROM transactions INNER JOIN members ON transactions.MemberID = members.MemberID WHERE UserID=$id GROUP BY MemberID ORDER BY COUNT(transactions.TransactionID) DESC, MemberID ASC LIMIT 5";
        $qTopBooks = "SELECT COUNT(TransactionID), books.ISBN, books.Title, books.BookCover FROM transactions INNER JOIN books ON transactions.ISBN = books.ISBN INNER JOIN members ON transactions.MemberID = members.MemberID WHERE UserID=$id GROUP BY ISBN ORDER BY COUNT(transactions.TransactionID) DESC, ISBN ASC LIMIT 5";
        //Genre Chart
        $qChart2 = "SELECT COUNT(Copies), books.Genre FROM books INNER JOIN owned ON books.ISBN = owned.ISBN WHERE UserID=$id GROUP BY Genre ORDER BY COUNT(Copies) DESC LIMIT 5";
        $qChart3 = "SELECT COUNT(TransactionID),books.Genre FROM transactions INNER JOIN books ON transactions.ISBN = books.ISBN INNER JOIN members ON transactions.MemberID = members.MemberID WHERE UserID=$id GROUP BY Genre ORDER BY COUNT(TransactionID) DESC LIMIT 5";
        //Graph Chart
        $qGraphLoaned = "SELECT COUNT(TransactionID), EXTRACT(Month FROM BorrowDate) AS Month, EXTRACT(Year FROM BorrowDate) AS Year FROM transactions INNER JOIN members ON transactions.MemberID = members.MemberID WHERE UserID=$id GROUP BY Month ORDER BY Month DESC LIMIT 7";
        $qGraphOwn = "SELECT COUNT(Copies), EXTRACT(Month FROM CreatedDate) AS Month, EXTRACT(Year FROM CreatedDate) AS Year FROM owned WHERE UserID=$id GROUP BY Month ORDER BY Month DESC LIMIT 7";

        //Get Result
        $rBooksTotal = mysqli_query($conn, $qBooksTotal);
        $rMembersTotal = mysqli_query($conn, $qMembersTotal);
        $rLoanedTotal = mysqli_query($conn, $qLoanedTotal);
        $rOverdueTotal = mysqli_query($conn, $qOverdueTotal);
        //top 5
        $rTopMembers = mysqli_query($conn, $qTopMembers);
        $rTopBooks = mysqli_query($conn, $qTopBooks);
        //Genre Chart
        $rChart2 = mysqli_query($conn, $qChart2);
        $rChart3 = mysqli_query($conn, $qChart3);
        //Graph Chart
        $rGraphLoaned = mysqli_query($conn, $qGraphLoaned);
        $rGraphOwn = mysqli_query($conn, $qGraphOwn);

        //Fetch Data
        $BooksTotal = mysqli_fetch_assoc($rBooksTotal);
        $MembersTotal = mysqli_fetch_assoc($rMembersTotal);
        $LoanedTotal = mysqli_fetch_assoc($rLoanedTotal);
        $OverdueTotal = mysqli_fetch_assoc($rOverdueTotal);

      ?>
      <div class="alert alert-warning" role="alert">
        <h2>Statistics</h2>
      </div>
      <div class="boxes center">
        <hr style="margin-top:0px">
          <div id="div1" class="quadrant">
            <h6>Books Owned</h6>
            <h1 id="counter1"><?php echo $BooksTotal['SUM(Copies)']; ?></h1>
          </div>
          <div id="div2" class="quadrant">
            <h6>Total Members</h6>
            <h1 id="counter2"><?php echo $MembersTotal['COUNT(MemberID)']; ?></h1>
          </div>
          <div id="div3" class="quadrant center">
            <h6>Books Loaned</h6>
            <h1 id="counter3"><?php echo $LoanedTotal['COUNT(transactions.TransactionID)']; ?></h1>
          </div>
          <div id="div4" class="quadrant">
            <h6>Books Overdue</h6>
            <h1 id="counter4"><?php echo $OverdueTotal['COUNT(transactions.TransactionID)']; ?></h1>
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
                  echo    "<img src='".$TopMembers['Photo']."' class='dash-newbook figure-img img-fluid'>";
                  echo    "<figcaption class=\"figure-caption\">#".$counter." - ".$TopMembers['FirstName']." ".$TopMembers['LastName']." [".$TopMembers['COUNT(TransactionID)']." time(s)]";
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
                echo "<a href='bookinfo/bookinfo.php?ISBN=".$TopBooks['ISBN']."'>";
                echo  "<figure class=\"figure\">";
                echo    "<img src=".$TopBooks['BookCover']." class='dash-newbook figure-img img-fluid'>";
                echo    "<figcaption class=\"figure-caption\">#".$counter." - ".$TopBooks['Title']." [".$TopBooks['COUNT(TransactionID)']." time(s)]";
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

    <footer class="center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com</br>
    </footer>
  	<script src="statistic_js/utils.js"></script>
    <script type="text/javascript" src="statistic_js/CountUp.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">
      var bookData = [0,0,0,0,0,0,0];
      var loanData = [0,0,0,0,0,0,0];
      var monthLabel = [];
      var chartData2 = [];
      var chartData3 = [];
      var chartLabel2 = [];
      var chartLabel3 = [];
      <?php
        //get month label for this month to 7 months before today
        for($i=0; $i<7; $i++){
          $now = GETDATE();
          $calcMonth = (int)$now['mon'] - $i;
          $calcYear = (int)$now['year'];
          echo "monthLabel.push('".date("M Y",mktime(0,0,0,$calcMonth+1,0,$calcYear))."');";
        }

        //Loan Graph
        while($loanGraph = mysqli_fetch_assoc($rGraphLoaned)){
          $now = GETDATE();
          $index = $now['mon'] - $loanGraph['Month'];

          if($now['year'] != $loanGraph['Year']){
            $yearDiff = $now['year'] - $loanGraph['Year'];
            $yearDiff *= 12;
            $index = (int)$yearDiff - (int)$index;
          }

          if ($index <7){
            echo "loanData[".$index."] = ".$loanGraph['COUNT(TransactionID)'].";";
          }
        }

        //Own Graph
        while($ownGraph = mysqli_fetch_assoc($rGraphOwn)){
          $now = GETDATE();
          $index = $now['mon'] - $ownGraph['Month'];

          if($now['year'] != $ownGraph['Year']){
            $yearDiff = $now['year'] - $ownGraph['Year'];
            $yearDiff *= 12;
            $index = (int)$yearDiff - (int)$index;
          }

          if ($index <7){
            echo "bookData[".$index."] = ".$ownGraph['COUNT(Copies)'].";";
          }
        }

        //reverse array
        echo "monthLabel.reverse();";
        echo "loanData.reverse();";
        echo "bookData.reverse();";

        //Genre Chart 1
        while($chart2 = mysqli_fetch_assoc($rChart2)){
          echo "chartData2.push(".$chart2['COUNT(Copies)'].");";
          echo "chartLabel2.push('".$chart2['Genre']."');";
        }

        //Genre Chart 2
        while($chart3 = mysqli_fetch_assoc($rChart3)){
          echo "chartData3.push(".$chart3['COUNT(TransactionID)'].");";
          echo "chartLabel3.push('".$chart3['Genre']."');";
        }
      ?>
    </script>
    <script type="text/javascript" src="statistic_js/statistic.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <?php
      //Free Result
      mysqli_free_result($rBooksTotal);
      mysqli_free_result($rMembersTotal);
      mysqli_free_result($rLoanedTotal);
      mysqli_free_result($rOverdueTotal);
      //Top 5
      mysqli_free_result($rTopMembers);
      mysqli_free_result($rTopBooks);
      //Genre Chart
      mysqli_free_result($rChart2);
      mysqli_free_result($rChart3);
      //Graph Chart
      mysqli_free_result($rGraphLoaned);
      mysqli_free_result($rGraphOwn);

      //close connection
      mysqli_close($conn);
     ?>
</body>

</html>
