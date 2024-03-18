<?php
// delete.php

// Step 1: Establish a database connection
$host = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}


// Step 2: Retrieve the ID parameter from the URL
if (isset($_GET["book_id"])) {
    $id = $_GET["book_id"];
} else {
    // Handle the case when the ID parameter is missing
    echo "ID parameter is missing.";
    exit();
}

// Step 3: Delete the record from the database
$sql = "DELETE FROM books WHERE book_id = $id";

if ($connection->query($sql) === TRUE) {
    header("Location: ViewBooks.php");

} else {
    echo "Error deleting record: " . $connection->error;
}
function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

// Step 4: Close the database connection
$connection->close();
?>
