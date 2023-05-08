<?php
$host = "localhost"; // Host name
$username = "root"; // Mysql username
$password = ""; // Mysql password
$dbname = "shpd"; // Database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Get the ID parameter from the query string
$name = $_GET["name"];

// Prepare a SQL statement to delete the row with the matching ID from the cart table
$sql = "DELETE FROM cart WHERE name = '$name'";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
  // Row deleted successfully
} else {
  // Log the error somewhere
}

// Redirect the user back to the page with the updated table
header("Location: shpd.php");
?>
