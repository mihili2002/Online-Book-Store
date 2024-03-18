<?php include("header.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="css/products.css">
</head>
<body>
<div class="search-form">
    <form action="Products.php" method="GET">
        <input type="text" name="search" placeholder="Search by book name">
        <input type="submit" value="Search">
    </form>
</div>
<?php

// MySQL database connection details-------------------------------------------------------------
$host = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name

// Establish a connection to the MySQL server
$connection = new mysqli ($host, $username, $password, $dbname);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
//connection--------------------------------------------------------------------------------------


// Get the search term from the GET parameters
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Query the database with the search term
$sql = "SELECT * FROM books WHERE book_name LIKE '%$searchTerm%'";
$result = $connection->query($sql);

$books = array();

// $books = array(); // Initialize an empty array to store books

if ($result->num_rows > 0) {
    // Loop through each row and store book data in the array
    while ($row = $result->fetch_assoc()) {
        $books[] = $row; // Append the row to the books array
    }
} else {
    echo "No books found in the database.";
}
// Close the connection
$connection->close();
// // Sample list of products
// $products = array(
//     array(
//         'productID' => 1,
//         'productName' => 'Product 1',
//         'unitPrice' => 10.99,
//         'image' => 'Images/pic3.jpg'
//     ),
//     array(
//         'productID' => 2,
//         'productName' => 'Product 2',
//         'unitPrice' => 15.99,
//         'image' => 'Images/pic3.jpg'
//     ),
//     array(
//         'productID' => 3,
//         'productName' => 'Product 3',
//         'unitPrice' => 12.99,
//         'image' => 'Images/pic3.jpg'
//     )
// );

// Function to add a product to the cart cookie
if (isset($_POST['submit1'])) {
    header("Location: ViewBook.php");
    exit();
  } 
function addToCart($book, $quantity)
{
    // Retrieve the cart from the cookie, if it exists
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : array();

    // Check if the product already exists in the cart
    $existingProductIndex = -1;
    foreach ($cart as $index => $cartItem) {
        if ($cartItem['book_id'] === $book['book_id']) {
            $existingProductIndex = $index;
            break;
        }
    }

    if ($existingProductIndex >= 0) {
        // Update the quantity of the existing product
        $cart[$existingProductIndex]['quantity'] += $quantity;
    } else {
        // Add the selected product to the cart
        $cart[] = array(
            'book_id' => $book['book_id'],
            'book_name' => $book['book_name'],
            'price' => $book['price'],
            'image' => $book['image'],
            'quantity' => $quantity
        );
    }

    // Store the updated cart in the cookie
    setcookie('cart', json_encode($cart), time() + (86400 * 30), '/'); // Cookie valid for 30 days

    // Redirect to shoppingCart.php
    header('Location: ShoppingCart.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book']) && isset($_POST['quantity'])) {
    $selectedProduct = json_decode($_POST['book'], true);
    $selectedQuantity = intval($_POST['quantity']);
    addToCart($selectedProduct, $selectedQuantity);
}

// Displaying products
foreach ($books as $book) {
    echo '<div class="book">';
    echo '<img src="' . $book['image'] . '" alt="' . $book['book_name'] . '">';
    echo '<h3>' . $book['book_name'] . '</h3>';
    echo '<p>$' . $book['price'] . '</p>';
    echo '<form action="Products.php" method="post">';
    echo '<input type="hidden" name="book" value="' . htmlspecialchars(json_encode($book)) . '">';
    echo 'Quantity: <input type="number" name="quantity" value="1" min="1">';
    echo '<input type="submit" value="Add to Cart">';
    echo '</form>';
    echo '<form action="viewBook.php" method="get">';
    echo '<input type="hidden" name="book_id" value="' . $book['book_id'] . '">';
    echo '<input type="submit" value="View Book">';
    echo '</form>';
    echo '</div>';
}
?>
</body>
</html>

<?php include("footer.php"); ?>  