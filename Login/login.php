<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT UserID, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["UserID"] = $id;
                            $_SESSION["username"] = $username;
							//$_SESSION["firstname"] = $firstname;
							//$_SESSION["lastname"] = $lastname;
							//$_SESSION["email"] = $email;
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Your password is invalid!";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "You haven't registered yet!";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../biblio.css">
    <title>Biblio - Your very own mini library website</title>
    <style>	
	.container {
		border-radius:10px;
		background-color:white;
		position:absolute;
		width: 30%;
		height: 65%;
		bottom:-100px;
		left: 50%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		padding:50px 60px 50px 60px;
	}
	
    input[type=text], input[type=password] {
        background: #f2f2f2;
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
	</style>
</head>
<body id="preview">
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <header id="header">
        <!--Menu Button-->
        <a id="biblio" href="#">
            <h2>Biblio</h2>
        </a>
    </header>
	<div>
        <form style="text-align:center" class="signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="container">
			<h3>Sign In to Biblio</h3>
			<br>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" placeholder="Enter Username" name="username" class="form-control" value="<?php echo $username; ?>"><br>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"> 
                <input type="password" placeholder="Enter Password" name="password" class="form-control"><br>
                <span class="help-block"><?php echo $password_err; ?></span>
				<!-- <p style="text-align:right" class="message"><a href="forgot.php">Forgot Password?</a></p> -->
            </div>
            <div class="form-group">
                <button type="submit" class="loginbtn light">LOGIN</button>
				<button type="button" onclick="location.href='preview.html';" class="cancelbtn light">CANCEL</button>
            </div>
            <p class="message">Not registered? <a href="signin.php">Create an account</a></p>  
		</div>
        </form>
		<br>
    </div>
</body>
