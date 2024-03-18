<?php include("header.php"); ?>
<?php
// MySQL database connection details
$host = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name

// Establish a connection to the MySQL server
$connection = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Retrieve the values from the form
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $contact_number = $_POST['contact_number'];
    $total_amount = $_POST['total_amount'];

    // Check if the required fields are empty
    if (empty($customer_name) || empty($customer_address) || empty($contact_number) || empty($total_amount)) {
        function_alert("Please fill in all the required fields");
    } else {       
        $sql = "INSERT INTO orders (customer_name, customer_address, contact_number,total_amount) 
        VALUES ('$customer_name', '$customer_address', '$contact_number','$total_amount')";


        if ($connection->query($sql) === TRUE) {
                // Retrieve the generated order ID
                $orderId = $connection->insert_id;
                echo $orderId;
                if (isset($_POST['orderDetails'])) {
                    $orderDetails = $_POST['orderDetails'];
                // Insert order items into `order_item` table
                foreach ($orderDetails as $index => $item) {
                    $bookId = $item['book_id'];
                        $bookName = $item['book_name'];
                        $price = $item['price'];
                        $quantity = $item['quantity'];

                    echo $bookId;
                    echo $bookName; 
                    echo $price;
                    echo $quantity;

            
                    $sql = "INSERT INTO order_books (order_id, book_id, price,quantity,book_name) VALUES ('$orderId', '$bookId', '$price','$quantity', '$bookName')";
                    $connection->query($sql);
                }  
            } 
         function_alert("Record inserted successfully");
 
        } else {
            echo "Error inserting record: " . $connection->error;
        }
}
}
// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Order</title>
    <link rel="stylesheet" href="css/order.css">

</head>
<body>
    <div class="container">
        <h2>Customer Information</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_address">Customer Address</label>
                <input type="text" id="customer_address" name="customer_address" required></textarea>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" required></textarea>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="text" id="total_amount" name="total_amount" required></textarea>
            </div>
            <h2>My Order Details</h2>
            <?php
                // Retrieve the order details from the $_POST array
                if (isset($_POST['orderDetails'])) {
                    $orderDetails = $_POST['orderDetails'];
                    $numItems = count($orderDetails);

                    // Display the order details
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Book Name</th>";
                    echo "<th>Price</th>";
                    echo "<th>Quantity</th>";
                    echo "</tr>";

                    foreach ($orderDetails as $index => $item) {
                        $bookId = $item['book_id'];
                        $bookName = $item['book_name'];
                        $price = $item['price'];
                        $quantity = $item['quantity'];

                        echo "<tr>";
                        echo "<td>$bookName</td>";
                        echo "<td>$price</td>";
                        echo "<td>$quantity</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<h2>No order details found.</h2>";                    
                }
            ?> 
            <br><hr><br>  
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>  
           
        </form>
    </div>
</body>
</html>
<?php include("footer.php"); ?>