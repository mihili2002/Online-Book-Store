
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
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the required fields are empty
    if (empty($name) || empty($dob) || empty($contact)) {
        function_alert("Please fill in all the required fields");
    } else {       
        // Prepare the SQL query
       // Construct and execute the SQL query

       $sql = "INSERT INTO user (fullName, DOB, contact, email, address, userName, password) VALUES ('$name', '$dob', '$contact', '$email', '$address', '$username', '$password')";


       if ($connection->query($sql) === TRUE) {
        function_alert("Record inserted successfully");
        // Redirect user to the home page
      header("Location: AdminLogin.php");

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
    <title>Register Form</title>
    <link rel="stylesheet" href="css/signup.css">
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
                <label for="dob">date Of Birth:</label>
                <input type="date" name="dob" id="dob" required>
            </div>
            <div class="form-group">
                <label for="message">Contact Number:</label>
                <input type="number" name="contact" id="contact" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required>
            </div>
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">User Name:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
