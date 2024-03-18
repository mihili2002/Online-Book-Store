
<?php
// Database configuration
$hostname = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name


// Create a connection to the MySQL database
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the file was uploaded without errors
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Get the file name and temporary file location
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Move the uploaded file to the desired location
    $target_path = 'images/' . $image_name;
    move_uploaded_file($image_tmp, $target_path);

    // Check if the book name and price are provided
    if (isset($_POST['book_name'], $_POST['price']) && !empty($_POST['book_name']) && !empty($_POST['price'])) {
        $book_name = $_POST['book_name'];
        $price = $_POST['price'];

        // Insert the book details into the database
        $query = "INSERT INTO books (book_name, price, image) VALUES ('$book_name', '$price', '$target_path')";
        if ($conn->query($query) === TRUE) {
            echo "Book and image uploaded successfully.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Book name and price are required.";
    }
} else {
    //echo "Error uploading the image.";

}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book Form</title>
    <link rel="stylesheet" href="css/addbook.css">
</head>
<body>
    <div class="container">
        <h2>Add Book</h2>
        <form action="AddBook.php" method="POST" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="book_name">Book Name:</label>
                <input type="text" name="book_name"  required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text"  name="price" ></textarea>
            </div>
            <div class="form-group">
                 <label for="image">Image:</label>
                  <input type="file" name="image" />
            </div>
            <div class="form-group">
                <input type="submit" name="Upload" value="Upload">
            </div>
            <a href='ViewBooks.php' class='btn btn-edit'>Back</a>
        </form>

    </div>
</body>
</html>
