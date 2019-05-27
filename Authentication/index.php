<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: preview.html");
    exit;
}
?>

<!DOCTYPE html> 
<html> 

<head>
    <title>Dashboard - Biblio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../biblio.css">
    
</head>

<body onresize="resize()" onload="resize()" background="../media/library-dark.jpg">

    <header id="header">
        <!--Menu Button-->
        <a id="biblio" href="index.php">
            <h2>Biblio</h2>
        </a>

        <!-- profile picture -->
        <div class="dropdown">
            <img src="../media/profile pic.png" role="button" id="profile" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">


            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href=" ">Setting</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <nav class="navigation">
        <div>
            <ul>
                <li class="navigation-item active">
                    <a href="#">DASHBOARD</a>
                </li>
                <li class="navigation-item">
                    <a href=" ">BOOKS</a>
                </li>

                <li class="navigation-item">
                    <a href=" ">LENDING</a>
                </li>

                <li class="navigation-item">
                    <a href=" ">MEMBER</a>
                </li>
                <li class="navigation-item">
                    <a href=" ">STATISTIC</a>
                </li>

            </ul>
        </div>
    </nav>
    <main class="container">
        <div class="row">
            <div id="new-book" class="inline boxes">
                <h5>New book</h5>
                <div class="dash-book-div" id="smallbox">
                    <a href="bookSearch.html"><img src="media/add.png" class="op-1"></a>
                    <a href="bookinfo/theartofwar.html"><img src="media/theartofwar.jpg" class="dash-newbook"></a>
                    <img src="https://images-na.ssl-images-amazon.com/images/I/41Tfjy2712L._SX324_BO1,204,203,200_.jpg" class="dash-newbook">
                    <a href="bookinfo/killthemockingbird.html"><img src="https://images-na.ssl-images-amazon.com/images/I/71FxgtFKcQL.jpg" class="dash-newbook"></a>
                    <img src="https://kbimages1-a.akamaihd.net/ca35b0df-52d8-44cd-ad10-1d1ae7828317/1200/1200/False/harry-potter-and-the-philosopher-s-stone-3.jpg" class="dash-newbook">
                </div>
            </div>

            <div id="stats" class="inline boxes">
                <h5>Total</h5>
                <h3>100</h2><br>
                    <h5>Checkouts</h5>
                    <h3>30</h3><br>
                    <h5>Overdue</h5>
                    <h3>5</h3>
            </div>
        </div>
        <div class="row">
            <div class="boxes-2 inline">
                <h5>Check-out</h5>
                <a href="../Lending/keyIn.html"><img src="../media/add.png" class="op-2"></a>
                <img src="../media/minus.png" class="op-1" id="minus">
            </div>

            <div class="boxes-2 inline">
                <h5>Overdue</h5>
            </div>
        </div>


    </main>
    <footer class="text-center font-italic">
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
    
    function resize(){
			var box = document.querySelector("#new-book");
            var smallbox = document.querySelector("#smallbox");
            // console.log(box.offsetHeight);
            // console.log(smallbox.offsetHeight);
            box.style.height = smallbox.offsetHeight + 100 +'px';
			

		}</script>
</body>

</html>