<?php include("header.php"); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/shoppingcart.css">
</head>
<body>
<div class="container">
<?php

if (isset($_POST['submit1'])) {
    header("Location: Products.php");
    exit();
  } elseif (isset($_POST['submit2'])) {
    header("Location: Order.php");
    exit();
  }
// Retrieve the cart from the cookie, if it exists
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : array();

// Pass the order details to Order.php using hidden input fields
echo '<form id="orderForm" action="Order.php" method="post">';
foreach ($cart as $index => $item) {
    echo '<input type="hidden" name="orderDetails[' . $index . '][book_id]" value="' . $item['book_id'] . '">';
    echo '<input type="hidden" name="orderDetails[' . $index . '][book_name]" value="' . $item['book_name'] . '">';
    echo '<input type="hidden" name="orderDetails[' . $index . '][price]" value="' . $item['price'] . '">';
    echo '<input type="hidden" name="orderDetails[' . $index . '][quantity]" value="' . $item['quantity'] . '">';
}
echo '</form>';

// Submit the form using JavaScript when the "CheckOut" button is clicked
echo '<script>
function submitOrderForm() {
    document.getElementById("orderForm").submit();
}
</script>';

$totalPrice = 0;

if (empty($cart)) {
    echo '<h2 style="display: flex; justify-content: center;">Your shopping cart is empty.</h2>';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteIndex'])) {
        $deleteIndex = intval($_POST['deleteIndex']);

        if ($deleteIndex >= 0 && $deleteIndex < count($cart)) {
            array_splice($cart, $deleteIndex, 1);
            setcookie('cart', json_encode($cart), time() + (86400 * 30), '/');
            header('Location: ShoppingCart.php');
            exit;
        }
    }

    echo '<h2 style="display: flex; justify-content: center;">Your Shopping Cart</h2>';
    echo '<div style="display: flex; justify-content: center;">';
    echo '<form action="ShoppingCart.php" method="post">';
    echo '<table style="border-collapse: collapse;">';
    echo '<tr>';
    //echo '<th style="border: 1px solid black; padding: 5px;">Image</th>';
    echo '<th>Product Name</th>';
    echo '<th>Price</th>';
    echo '<th>Quantity</th>';
    echo '<th>Sub Total</th>';
    echo '<th></th>';
    echo '</tr>';

    foreach ($cart as $index => $item) {
        $totalPrice += $item['quantity'] * $item['price'];

        echo '<tr>';
        //echo '<td style="border: 1px solid black; padding: 5px;"><img src="' . $item['image'] . '" alt="' . $item['productName'] . '"></td>';
        echo '<td>' . $item['book_name'] . '</td>';
        echo '<td>$' . $item['price'] . '</td>';
        echo '<td>' . $item['quantity'] . '</td>';
        echo '<td>$' . $item['quantity'] * $item['price'] . '</td>';
        echo '<td style="border: 1px solid black; padding: 5px;"><button class="delete-button" type="submit" name="deleteIndex" value="' . $index . '">Delete</button></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</form>';
    echo '</div>';    
    echo '<h3 style="display: flex; justify-content: center;">Total Price: $' . $totalPrice . '</h3>';
}
echo '<div align="center">';
echo '<form method="POST">';
echo '<input type="submit" name="submit1" value="Go back to product list" class="button-style">';
echo ' ';
echo '<input type="button" name="submit2" value="CheckOut" class="checkout-button-style" onClick="submitOrderForm()">';
echo '</form>';
echo '</div>';


?>
</div>
</body>
</html>
<?php include("footer.php"); ?>