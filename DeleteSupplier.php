<?php

// Step 1: Connect a my sql database 
$host = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}


// Step 2: Get the id parameter from the URL header
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    // Handle the case when the ID parameter is missing
    echo "ID parameter is missing.";
    exit();
}

// Step 3: Delete the record from the database
$sql = "DELETE FROM supliers WHERE id = $id";

if ($connection->query($sql) === TRUE) {
    header("Location: ViewSupplier.php");

} else {
    echo "Error deleting record: " . $connection->error;
}

// Step 4: Close the database connection
$connection->close();
?>
