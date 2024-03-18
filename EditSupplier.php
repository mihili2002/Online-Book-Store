
<?php
// Step 1: connect Database
$host = "localhost"; // MySQL server host address
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "online_book_store"; // MySQL database name

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Step 2: Get Supplers details
$SupplierId = $_GET['id']; // Assuming the SupplierId ID is passed as a query parameter

$selectQuery = "SELECT * FROM supliers WHERE id = $SupplierId";
$result = $connection->query($selectQuery);

if ($result->num_rows == 0) {
    die('Supplier not found.');
}

$supplier = $result->fetch_assoc();

// Step 4: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supplier_name = $_POST['supplier_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $joined_date = $_POST['joined_date'];

    // Step 5: Update the Supplier record
    $updateQuery = "UPDATE supliers SET supplier_name = '$supplier_name', address = '$address', email = '$email', joined_date = '$joined_date' WHERE id = $SupplierId";
    $updateResult = $connection->query($updateQuery);

    // Step 7: Handle success or failure
    if ($updateResult === true) {
        header("Location: ViewSupplier.php");
    exit();
       // echo 'Supplier updated successfully.';
    } else {
        echo 'Error updating Supplier: ' . $connection->error;
    }
}

// Step 3: Display the form
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <link rel="stylesheet" type="text/css" href="css/editsuplier.css">
</head>
<body>
<div class="container">
        <h1>Edit Supplier</h1>
        <form method="post" action="">
            <div>
            <label>Supplier Name:</label>
            <input type="text" name="supplier_name" value="<?php echo $supplier['supplier_name']; ?>" required>
            <br>
            </div>
            <div>
            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $supplier['address']; ?>" required>
            <br>
            </div>
            <div>
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $supplier['email']; ?>" required>
            <br>
            </div>
            <div>
            <label>Joined Date:</label>
            <input type="text" name="joined_date" value="<?php echo $supplier['joined_date']; ?>" required>
            <br>
</div>
<div>
            <input type="submit" value="Update">
</div>
        </form>
        <a href='ViewSupplier.php' class='btn btn-edit'>Back</a>
    </div>
</body>
</html>

<?php
// Step 4: Close the database connection
$connection->close();
?>
