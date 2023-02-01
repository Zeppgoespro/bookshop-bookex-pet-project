<?php

include './config.php';
session_start();

$user_id = @$_SESSION['user_id'];

if (!isset($user_id)) {
  header('location: login.php');
}

if (isset($_POST['order_btn'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $method = mysqli_real_escape_string($conn, $_POST['method']);
  $address = mysqli_real_escape_string($conn, 'Apartment number: ' . $_POST['apartment'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['index']);

  $placed_on = date('d-M-Y');
  $cart_total = 0;
  $cart_products[] = '';

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

  if (mysqli_num_rows($cart_query) > 0) {
    while ($cart_item = mysqli_fetch_assoc($cart_query)) {
      $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
      $sub_total = ($cart_item['price'] * $cart_item['quantity']);
      $cart_total += $sub_total;
    }
  }

  $total_products = implode('|| ', $cart_products);

  $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name ='$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('Query failed');

  if ($cart_total == 0) {
    $message[] = 'Your cart is empty';
  } else {
    if (mysqli_num_rows($order_query) > 0) {
      $message[] = 'Order already placed';
    } else {
      mysqli_query($conn, "INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('Query failed');

      $message[] = 'Order placed successfully';

      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <div class="heading">
    <h3>checkout</h3>
    <p><a href="./home.php">home</a> | checkout</p>
  </div>

  <section class="display-order">

    <?php

      $grand_total = 0;
      $select_cart = mysqli_query($conn, " SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

      if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
          $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
          $grand_total += $total_price;

    ?>

    <p><?= $fetch_cart['name'] ?> <span>(<?= $fetch_cart['quantity'] . ' x ' . '$' . $fetch_cart['price'] ?>)</span></p>

    <?php

        }
      } else {
        echo '<p class="empty" style="color: var(--red);">Your cart is empty</p>';
      }

    ?>

    <div class="grand-total">Grand total: <span>$<?= $grand_total ?>/-</span></div>

  </section>

  <section class="checkout">

    <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
        <div class="input-box">
          <span>Your name:</span>
          <input type="text" name="name" required placeholder="Enter your name">
        </div>
        <div class="input-box">
          <span>Your telephone:</span>
          <input type="tel" name="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required placeholder="Format: 123-456-7890">
        </div>
        <div class="input-box">
          <span>Your email:</span>
          <input type="email" name="email" required placeholder="Enter your email">
        </div>
        <div class="input-box">
          <span>Payment method:</span>
          <select name="method">
            <option value="cash on delivery">Cash on delivery</option>
            <option value="credit card">Credit card</option>
            <option value="paypal">Paypal</option>
            <option value="mir">Mir</option>
          </select>
        </div>
        <div class="input-box">
          <span>Your apartment number:</span>
          <input type="number" min="0" name="apartment" required placeholder="Apartment number">
        </div>
        <div class="input-box">
          <span>Your street name:</span>
          <input type="text" name="street" required placeholder="Street name">
        </div>
        <div class="input-box">
          <span>Your city:</span>
          <input type="text" name="city" required placeholder="City name">
        </div>
        <div class="input-box">
          <span>Your state:</span>
          <input type="text" name="state" required placeholder="State name">
        </div>
        <div class="input-box">
          <span>Your country:</span>
          <input type="text" name="country" required placeholder="Country name">
        </div>
        <div class="input-box">
          <span>Your index:</span>
          <input type="number" min="0" name="index" required placeholder="Index">
        </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
    </form>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>