<?php

include './config.php';
session_start();

$user_id = @$_SESSION['user_id'];

/*
if (!isset($user_id)) {
  header('location: login.php');
}
*/

if (isset($_POST['update_cart'])) {
  $cart_id = $_POST['cart_id'];
  $cart_quantity = $_POST['cart_quantity'];

  mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('Query failed');

  $message[] = 'Cart quantity updated';
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('Query failed');
  header('location: cart.php');
}

if (isset($_GET['delete_all'])) {
  mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
  header('location: cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <div class="heading">
    <h3>shopping cart</h3>
    <p><a href="./home.php">home</a> | cart</p>
  </div>

  <section class="shopping-cart">

    <h1 class="title">added products</h1>

    <div class="box-container">

      <?php

        $grand_total = 0; # need for total cost

        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die("Query failed");

        if (mysqli_num_rows($select_cart) > 0) {
          while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {

      ?>

      <div class="box">

        <a href="./cart.php?delete=<?= $fetch_cart['id'] ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
        <img src="./uploaded-img/<?= $fetch_cart['image'] ?>" alt="This book cover">
        <div class="name"><?= $fetch_cart['name'] ?></div>
        <div class="price">$<?= $fetch_cart['price'] ?>/-</div>
        <form action="" method="post">
          <input type="hidden" name="cart_id" value="<?= $fetch_cart['id'] ?>">
          <input type="number" name="cart_quantity" min="1" value="<?= $fetch_cart['quantity'] ?>">
          <input type="submit" name="update_cart" value="update" class="option-btn">
        </form>
        <div class="sub-total">
          <span>Subtotal: $<?= $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']) ?>/-</span>
        </div>

      </div>

      <?php

            $grand_total += $sub_total;
          }
        } elseif (!isset($user_id)) {
          echo '<p class="empty">Need to register or login</p>';
        } else {
          echo '<p class="empty">Your cart is empty</p>';
        }

      ?>

    </div>

    <div style="margin-top: 2rem; text-align: center;">
      <a href="./cart.php?delete_all" class="delete-btn <?=
        ($grand_total > 1)? '' : 'disabled' ?>" onclick="return confirm('Delete all from cart?');" title="This will delete all the books">delete all</a>
    </div>

    <div class="cart-total">
      <p>Grand total: <span>$<?= $grand_total ?>/-</span></p>
      <div class="flex">
        <a href="./shop.php" class="option-btn">continue shopping</a>
        <a href="./checkout.php" class="btn <?=
        ($grand_total > 1)? '' : 'disabled' ?>">proceed to checkout</a>
      </div>
    </div>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>