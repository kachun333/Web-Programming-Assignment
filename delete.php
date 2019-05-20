<?php
//Step 1. Connect to the database.
//Step 2. Handle connection errors
//including the database connection file
include("config.php");

//getting id of the data from url
$ISBN = $_GET['ISBN'];

//3. Execute the SQL query.
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE * FROM book WHERE ISBN=$ISBN");

//Step 5: Freeing Resources and Closing Connection using mysqli
mysqli_close($mysqli);

//4. Process the results.
//redirecting to the display page (book.php in our case)
header("Location:book.php");

?>