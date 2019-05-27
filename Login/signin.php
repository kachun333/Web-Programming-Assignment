<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $email = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username";
    } else{
        // Prepare a select statement
        $sql = "SELECT UserID FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken!";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later!";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
	// Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter your first name";     
    } else{
        $firstname = trim($_POST["firstname"]);
    }
    
	// Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter your last name";     
    } else{
        $lastname = trim($_POST["lastname"]);
    }
	
	// Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email"; 
    } else{
        $email = trim($_POST["email"]);
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($rmail_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_email);
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up - Biblio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="../biblio.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style>

	.form-control{
		width:100%;
	}

	#header{
		min-width:450px;
	}
	
	.container {
		position: relative;
		background-color: white;
		padding:25px 40px 30px 40px;
		top:50px;
		width:auto;
		height:700px;
		border:10px #D66853 solid;
		border-radius:10px;
		max-width: 800px;
		min-width:450px;
	}

	.submitbtn {
		background: #4caf50;
		color: white;
		padding: 10px 35px 10px 35px;
		margin-right: 10px;
		border-radius: 30px;
		border: none;
	}
	
	.resetbtn {
		background: #f44336;
		color: white;
		padding: 10px 30px 10px 30px;
		margin-left: 10px;
		border-radius: 30px;
		border: none;
	}
	</style>
	
</head>

<body class="signup-page" onresize="removePhoto()" onload="removePhoto()">
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<header id="header">
		<!--Menu Button-->
		<a id="biblio" href="preview.html">
			<h2>Biblio</h2>
		</a>
	</header>

	<main>
		<div>
			<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="container">
					<h2 style="text-align:center"> Sign Up to Biblio </h2>
					<div class="signupbox">
						<br>
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<label>Username:</label>
						<input type="text" name="username" required class="form-control" value="<?php echo $username; ?>" placeholder="Username">
						<span class="help-block"><?php echo $username_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label>Password:</label>
						<input type="password" name="password" required class="form-control" value="<?php echo $password; ?>" placeholder="Password">
						<span class="help-block"><?php echo $password_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						<label>Confirm Password:</label>
						<input type="password" name= "confirm_password" required class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password">
						<span class="help-block"><?php echo $confirm_password_err; ?></span>
						</div>
						<label>Name:</label>
						<div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="firstname" required class="form-control" value="<?php echo $firstname; ?>" placeholder="First Name">
						<span class="help-block"><?php echo $firstname_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="lastname" required class="form-control" value="<?php echo $lastname; ?>" placeholder="Last Name">
						<span class="help-block"><?php echo $lastname_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
						<label>Email:</label>
						<input type="email" name="email" required class="form-control" value="<?php echo $email; ?>" placeholder="Email">
						<span class="help-block"><?php echo $email_err; ?></span>
						</div>
							<div style="text-align:center" class="form-group">
							<button type="submit" class="submitbtn light">SUBMIT</button>
							<button type="submit" class="resetbtn light">RESET</button>
							</div>
							<p class="sign-in">Already a member? &nbsp<a href="login.php"> Sign in here</a></p>
					</div>
						<div class="signup-photo">
							<img  src="media/Bilbio_icon.png">
						</div>	
				</div>
				<br>
			</form>
		</div>
	</main>
	<footer class="text-center font-italic">
		<hr>
		Copyright &copy 2019 Biblio.com</br>
	</footer>

	<script>
		function goBack() {
			window.history.back();
		}
		
		function removePhoto(){
			var photo = document.querySelector(".signup-photo");
			var box = document.querySelector(".signupbox");
			var ctnr = document.querySelector(".container");
			if(ctnr.offsetWidth<690){
				photo.classList.add("hidden");
		}
			else{
				photo.classList.remove("hidden");
			}

		}
		
	</script>
</body>

</html>