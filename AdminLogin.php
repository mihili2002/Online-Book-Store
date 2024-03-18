<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $userName = $_POST['userName'];
  $password = $_POST['password'];

  // Validate the form data (you can add more validation if required)
  if (empty($userName) || empty($password)) {
    echo 'Please enter both username and password.';
  } else {
    // Connect to the database
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'online_book_store';
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check the database connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    // SQL query
    $sql = "SELECT * FROM user WHERE userName = '$userName' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
      echo 'Login successful!';
      // Redirect user to the Admin page
      header("Location: Admindashboard.php");
    } else {
      echo 'Invalid username or password.';
    }

    // Close the database connection
    $conn->close();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/login.css">
  <title>Login</title>
 
</head>
<body>
  <div class="header">
    <h1>Welcome to Book Worms</h1>
    <p><?php echo 'Today is ' . date('F j, Y'); ?></p>
  </div>

  <div class="container">
    <h2>Login</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="userName">Username:</label>
      <input type="text" name="userName" id="userName" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="AdminRegister.php">SignUp</a></p>

  </div>
</body>
</html>