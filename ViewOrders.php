<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/vieworder.css">
</head>
<body>
    
  <div class="container">
    <div class="sidebar">
    
      <ul class="menu">
      <img class="img3" src="images/logo.jpeg">
    <div class="logos">
            <p>BOOK WORMS</p>
        </div>
        <li class="menu-item"><a href="Admindashboard.php">Dashboard</a></li>
        <li class="menu-item"><a href="ViewBooks.php">Books</a></li>
        <li class="menu-item"><a href="ViewOrders.php">Orders</a></li>
        <li class="menu-item"><a href="ViewSupplier.php">Suppliers</a></li>
      </ul>
    </div>
    <div class="content">
    <?php
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "online_book_store";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        // SQL query to retrieve data
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Display table headers
            echo "<table>";
            echo "<tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Total Price</th>
      
            </tr>";
            
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["customer_name"] . "</td>";
                echo "<td>" . $row["customer_address"] . "</td>";
                echo "<td>" . $row["total_amount"] . "</td>";
                // Buttons column
          
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "No records found";
        }
    // Close the database connection
    $conn->close();
    ?>
    </div>
  </div>
</body>
</html>
