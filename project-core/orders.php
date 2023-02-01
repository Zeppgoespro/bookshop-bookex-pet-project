<?php

include './config.php';
session_start();

$user_id = @$_SESSION['user_id'];

/*
if (!isset($user_id)) {
  header('location: login.php');
}
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <div class="heading">
    <h3>placed orders</h3>
    <p><a href="./home.php">home</a> | orders</p>
  </div>

  <section class="placed-orders">

    <h1 class="title">placed orders</h1>

    <div class="box-container">

      <?php

        $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Query failed');

        if (mysqli_num_rows($order_query) > 0):
          while ($fetch_orders = mysqli_fetch_assoc($order_query)):

      ?>

      <div class="box">
        <p>Placed on: <span><?= $fetch_orders['placed_on'] ?></span></p>
        <p>Name: <span><?= $fetch_orders['name'] ?></span></p>
        <p>Number: <span><?= $fetch_orders['number'] ?></span></p>
        <p>Email: <span><?= $fetch_orders['email'] ?></span></p>
        <p>Address: <span><?= $fetch_orders['address'] ?></span></p>
        <p>Payment method: <span><?= $fetch_orders['method'] ?></span></p>
        <p>Ordered books: <span><?= $fetch_orders['total_products'] ?></span></p>
        <p>Total price: <span>$<?= $fetch_orders['total_price'] ?>/-</span></p>
        <p>Payment status: <span style="color:
        <?php
          if ($fetch_orders['payment_status'] == 'pending'):
            echo 'var(--red);';
          else:
            echo 'green;';
          endif;
        ?>
        "><?= $fetch_orders['payment_status'] ?></span></p>
      </div>

      <?php

          endwhile;
        elseif (!isset($user_id)):
          echo '<p class="empty">Need to register or login</p>';
        else:
          echo '<p class="empty">No orders placed yet</p>';
        endif;

      ?>

    </div>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>