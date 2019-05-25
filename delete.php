<?php
//Step 1. Connect to the database.
//Step 2. Handle connection errors
//including the database connection file
include("config.php");

//getting isbn of the data from url
$ISBN = $_GET['ISBN'];

//3. Execute the SQL query.
//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM books WHERE ISBN =$ISBN")or die(mysqli_error($conn));


//Step 5: Freeing Resources and Closing Connection using mysqli
mysqli_close($conn);

//4. Process the results.
//redirecting to the display page (book.php in our case)
header("Location:book.php");

?>