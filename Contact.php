
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Check if the required fields are empty
    if (empty($name) || empty($email) || empty($message)) {
        function_alert("Please fill in all the required fields");
    } else {       
        // Prepare the SQL query
       // Construct and execute the SQL query
       $sql = "INSERT INTO inquiry (name, email, message) VALUES ('$name', '$email', '$message')";


       if ($connection->query($sql) === TRUE) {
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
    <title>Student Form</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" cols="20"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
<?php include("footer.php"); ?>