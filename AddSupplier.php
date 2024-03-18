
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
    $supplier_name = $_POST['supplier_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $joined_date = $_POST['joined_date'];

    // Check if the required fields are empty
    if (empty($supplier_name) || empty($address) || empty($email)|| empty($joined_date)) {
        function_alert("Please fill in all the required fields");
    } else {       
        // Prepare the SQL query
       // Construct and execute the SQL query
       $sql = "INSERT INTO supliers (supplier_name, address, email, joined_date) VALUES ('$supplier_name', '$address', '$email', '$joined_date')";


       if ($connection->query($sql) === TRUE) {
        function_alert("Suppler inserted successfully");

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
    <title>Student Form</title>
    <link rel="stylesheet" href="css/addSuppliers.css">
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="supplier_name" id="supplier_name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="joined_date">Joined Date:</label>
                <input type="date" name="joined_date" id="joined_date" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
