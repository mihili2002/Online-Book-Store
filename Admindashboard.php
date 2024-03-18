<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <div class="logo">
        <img src="images/logo.jpeg" alt="Company Logo" />
      </div>
      <div class="company-name">
        BOOK WORMS
      </div>
      <ul class="menu">
        <li class="menu-item"><a href="Admindashboard.php">Dashboard</a></li>
        <li class="menu-item"><a href="ViewBooks.php">Books</a></li>
        <li class="menu-item"><a href="ViewOrders.php">Orders</a></li>
        <li class="menu-item"><a href="ViewSupplier.php">Suppliers</a></li>
      </ul>
    </div>

    <div class="content">
      <div class="header">
        <h1>Welcome to Book Warms Admin!</h1>
      </div>

      <div class="card-container">
        <div class="card">
          <img src="images/order.jpg" alt="Image 1" />
          <h2>Orders</h2>
          <p>View Order Details.</p>
          <button onclick="window.location.href='ViewOrders.php'">Click Me</button>
        </div>

        <div class="card">
          <img src="images/books.jpg" alt="Image 2" />
          <h2>Books</h2>
          <p>View Books Details.</p>
          <button onclick="window.location.href='ViewBooks.php'">Click Me</button>
        </div>

        <div class="card">
          <img src="images/supp.jpg" alt="Image 3" />
          <h2>Suppliers</h2>
          <p>View Supplier Details.</p>
          <button onclick="window.location.href='ViewSupplier.php'">Click Me</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
