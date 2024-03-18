
<?php
// Step 1: Establish a database connection
$host = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Step 2: Retrieve book details
$bookId = $_GET['book_id']; // Assuming the book ID is passed as a query parameter

$selectQuery = "SELECT * FROM books WHERE book_id = $bookId";
$result = $connection->query($selectQuery);

if ($result->num_rows == 0) {
    die('Book not found.');
}

$book = $result->fetch_assoc();

// Step 4: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_name = $_POST['book_name'];
    $price = $_POST['price'];

    // Step 5: Update the book record
    $updateQuery = "UPDATE books SET book_name = '$book_name', price = '$price' WHERE book_id = $bookId";
    $updateResult = $connection->query($updateQuery);

    // Step 7: Handle success or failure
    if ($updateResult === true) {
        function_alert ('Book updated successfully.');
        header("Location: ViewBooks.php");
    } else {
        echo 'Error updating book: ' . $connection->error;
    }
}
function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

// Step 3: Display the form
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" type="text/css" href="css/editbook.css">
</head>
<body>
<div class="container">
        <h1>Edit Book</h1>
        <form method="post" action="">
            <label>Book Name:</label>
            <input type="text" name="book_name" value="<?php echo $book['book_name']; ?>" required>
            <br>
            <label>Author:</label>
            <input type="text" name="price" value="<?php echo $book['price']; ?>" required>
            <br>
            
            <input type="submit" value="Update">
        </form>
        <a href='ViewBooks.php' class='btn btn-edit'>Back</a>
    </div>
</body>
</html>

<?php
// Step 4: Close the database connection
$connection->close();
?>
