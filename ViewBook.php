<?php include("header.php"); ?>
<?php
// use Getmethod to get the book_id parameter from the URL
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $host = "localhost"; // MySQL server host address
    $username = "root"; // MySQL username
    $password = ""; // MySQL password
    $dbname = "online_book_store"; // MySQL database name
    
    // Establish a connection to the MySQL server
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Connect to the database
    // Replace "your_host", "your_username", "your_password", and "your_database" with your database credentials
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the book details from the database
    $sql = "SELECT * FROM books WHERE book_id = '$book_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
       
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>View Book</title>
            <link rel="stylesheet" type="text/css" href="css/viewbook.css">
        </head>
        <body>
     
            <div class="container">
            <h2>Book Details</h2>
            <p><strong>Book Id:</strong> <?php echo $book['book_id']; ?></p>
            <p><strong>Title:</strong> <?php echo $book['book_name']; ?></p>
            <p><strong>Price:</strong> <?php echo $book['price']; ?></p>
            <img src="<?php echo $book['image']; ?>" alt="Book Image" width="300" height="200">
            
    </div>
        </body>
        </html>
<?php
    } else {
        echo "Book not found.";
    }

    $conn->close();
} else {
    echo "Invalid book ID.";
}

?>
<?php include("footer.php"); ?>