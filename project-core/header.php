<?php

if (isset($_SESSION['user_id'])):
  $user_id = $_SESSION['user_id'];
else:
  $user_id = '';
endif;

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

  <div class="header-1">
    <div class="flex">
      <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
      </div>
      <p>New <a href="./login.php">Login</a> | <a href="./register.php">Register</a></p>
    </div>
  </div>

  <div class="header-2">
    <div class="flex">
      <a href="./home.php" class="logo">Bookex</a>

      <nav class="navbar">
        <a href="./home.php">Home</a>
        <a href="./about.php">About</a>
        <a href="./shop.php">Shop</a>
        <a href="./contacts.php">Contacts</a>
        <a href="./orders.php">Orders</a>
      </nav>

      <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <a href="./search-page.php" class="fas fa-search"></a>
        <div id="user-btn" class="fas fa-user"></div>

        <?php

          $select_cart_quantity = mysqli_query($conn, "SELECT SUM(quantity) AS total_quantity FROM `cart` WHERE user_id ='$user_id'") or die('Query failed');
          $quantity_sum = mysqli_fetch_assoc($select_cart_quantity);
          if ($quantity_sum['total_quantity'] > 0) {
            $total_quantity = $quantity_sum['total_quantity'];
          } else {
            $total_quantity = 0;
          }

        ?>

        <a href="./cart.php"><i class="fas fa-shopping-cart"></i> <span>(<?= $total_quantity ?>)</span></a>
      </div>

      <div class="user-box">
        <?php if ($user_id === ''): ?>
          <p>You're not registered!</p>
          <a href="./login.php" class="btn">login</a>
          <a href="./register.php" class="option-btn">register</a>
        <?php else: ?>
          <p>Username: <span><?= $_SESSION['user_name'] ?></span></p>
          <p>Email: <span><?= $_SESSION['user_email'] ?></span></p>
          <a href="./logout.php" class="delete-btn">logout</a>
        <?php endif ?>
      </div>
    </div>
  </div>

</header>