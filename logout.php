<?php
// Replace the database credentials with your own
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shpd";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// SQL query to clear the database table
$sql = "TRUNCATE TABLE cart";

if (mysqli_query($conn, $sql)) {
  // If the table was cleared successfully, redirect to index.html
  header("Location: index.html");
  exit();
} else {
  echo "Error clearing table: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
