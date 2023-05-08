<style>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #f8f9fa;
  border-radius: 4px;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  width: 600px;
}

input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #e9ecef;
  border-radius: 4px;
  font-size: 16px;
}

button[type=submit] {
  background-color: #007bff;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
  font-size: 16px;
}

button[type=submit]:hover {
  background-color: #0069d9;
}


button {
  background-color: #dc3545;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
  font-size: 14px;
}

button:hover {
  background-color: #c82333;
}
.button-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 300px;
  margin-top: 20px;
}

.home-button {
background-color: #007bff;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
  font-size: 16px;
}

.home-button:hover {
  background-color: #0069d9;
}

}
.container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border-collapse: collapse;
    width: 300px;
  }

  /* Add this CSS to style the container */
  .cart-summary {
    
    background-color: #f8f9fa;
    border-radius: 4px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
  }

  /* Add this CSS to style the cart summary table */
  .cart-summary table {
    border-collapse: collapse;
    width: 100%;
  }

  .cart-summary th, .cart-summary td {
    text-align: left;
    padding: 8px;
  }

  .cart-summary th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
  }

  .cart-summary tr:nth-child(even) {
    background-color: #f8f9fa;
  }
#zbeeb{
  position: fixed;
  bottom: 431;  
  right: 0;

}
 /* CSS for table container */
  .table-container {
    height: 500px;
    overflow-y: scroll;
  }

  /* CSS for table */
  table {
    border-collapse: collapse;
    width: 77.75%;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    
  }

  tr:nth-child(even) {
    background-color: #f8f9fa;
  }
tr#z1 {
  position: sticky;
  top: 0;
}
</style>


<div class="container">
  <form method="post"  id="my-form">
    <input type="text" id="user-input" name="user-input" autofocus>
  </form>
  <div class="button-container">
    <button type="submit" form="my-form">Submit</button>
    <a href="home.html" class="home-button">Home</a>
    <a href="checkout.html" class="home-button">Ceckout</a>
  </div>
</div>

<div class="table-container">
<table>
  <tr id="z1">
    <th>Product Name</th>
    <th>Price</th>
    <th>Barcode</th>
    <th>Action</th>
  </tr>

  <?php 
  $host = "localhost"; // Host name
  $username = "root"; // Mysql username
  $password = ""; // Mysql password
  $dbname = "shpd"; // Database name

  // Create connection
  $conn = mysqli_connect($host, $username, $password, $dbname);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = $_POST["user-input"];

    // Prepare a SQL statement to select the row with the matching barcode from the products table
    $sql = "SELECT * FROM products WHERE barcode = '$userInput'";
    $result = $conn->query($sql);

    // Check if a row was found with the matching barcode
    if ($result->num_rows > 0) {

      // Fetch the row as an associative array
      $row = $result->fetch_assoc();

      // Prepare a SQL statement to insert the row into the other table
      $sql = "INSERT INTO cart (name , price, barcode) VALUES ('".$row["name"]."', '".$row["price"]."', '".$row["barcode"]."')";

      // Execute the SQL statement
      if ($conn->query($sql) === TRUE) {
          // SQL statement executed successfully
      } else {
          // Log the error somewhere
      }
    } else {
        // Barcode not found in database
    }
  }

  $sql = "SELECT * FROM cart";
  $result = mysqli_query($conn, $sql);

  // Check if any rows were found
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row["name"]."</td>";
      echo "<td>".$row["price"]."</td>";
      echo "<td>".$row["barcode"]."</td>";
      echo "<td><button onclick=\"deleteRow('".$row["name"]."')\">Delete</button></td>";
      echo "</tr>";
    }
  }

  // Add a script block to handle the delete button click event
  echo "<script>";
  echo "function deleteRow(name) {";
  echo "  if (confirm('Are you sure you want to delete this row?')) {";
  echo "    window.location.href = 'delete.php?name=' + name;";
  echo "  }";
  echo "}";
  echo "</script>";

  mysqli_close($conn);
  ?>
</table>
</div>
<div class="container" id ="zbeeb">
  <table class="cart-summary">
    <tr>
      <th>Total Items</th>
      <td><?php echo mysqli_num_rows($result); ?></td>
    </tr>
    <tr>
      <th>Total Price</th>
      <td><?php
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "shpd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT SUM(price) AS value_sum FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["value_sum"];
    }
} else {
    echo "0";
}
$conn->close();
      ?></td>
    </tr>
  </table>
</div>