<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";

?>
<!DOCTYPE html> 
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../biblio.css">
    <title>Biblio - Profile</title>
<style>
	.container {
		position: relative;
		background-color: white;
		padding:25px 40px 30px 40px;
		top:50px;
		width:30%;
		height:50%;
		border:10px #D66853 solid;
		border-radius:10px;
		max-width: 800px;
		min-width:450px;
	}
	
	.submitbtn {
		background: #d66853;
		color: white;
		padding: 10px 35px 10px 35px;
		margin-right: 10px;
		border-radius: 30px;
		border: none;
	}
</style>

</head>
<body id="preview" onresize="resize()" onload="resize()" background="../media/library-dark.jpg">
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
                <a class="dropdown-item" href="#">Setting</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <nav class="navigation">
        <div>
            <ul>
                <li class="navigation-item active">
                    <a href=" ">DASHBOARD</a>
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
	<main>
	<div class="row">
            <div class="container">
                <h3 style="text-align:center" >Biblio Profile</h3>
				<?php echo "<h5>Username</h5><h6><li>" .$_SESSION["username"]. "</h6></li>"; ?>
				<!-- echo "<h5>Full Name</h5><h6><li>" .$_SESSION["firstname"] .$_SESSION["lasttname"]. "</h6></li>";
				echo "<h5>Email</h5><h6><li>" .$_SESSION["email"]. "</h6></li>"; -->				
				<div style="text-align:center">
				<button type="button" class= "submitbtn light" onclick="location.href='change_password.php';" >CHANGE PASSWORD</button>
				</div>
            </div>
	<div>
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
	
</body>
</html>