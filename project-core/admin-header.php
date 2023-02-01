<?php

  if (isset($message)) {
    foreach ($message as $message) {
      echo '
      <div class="message">
        <span>' . $message . '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
  }

?>

<header class="header">

  <div class="flex">

    <a href="./admin-page.php" class="logo">Administrator <span>Page</span></a>

    <nav class="navbar">
      <a href="./admin-page.php">Home</a>
      <a href="./admin-products.php">Products</a>
      <a href="./admin-orders.php">Orders</a>
      <a href="./admin-users.php">Users</a>
      <a href="./admin-messages.php">Messages</a>
    </nav>

    <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <div id="user-btn" class="fas fa-user"></div>
    </div>

    <div class="account-box">
      <p>Administrator: <span><?= $_SESSION['admin_name'] ?></span></p>
      <p>Email: <span><?= $_SESSION['admin_email'] ?></span></p>
      <a href="./logout.php" class="delete-btn">logout</a>
      <div>New <a href="./login.php">login</a> | <a href="./register.php">register</a></div>
    </div>

  </div>

</header>