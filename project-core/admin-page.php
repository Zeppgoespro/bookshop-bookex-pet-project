<?php

include './config.php';
session_start();

$admin_id = @$_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location: login.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin page</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/admin-style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './admin-header.php' ?>

  <!-- Dashboard section ON -->

  <section class="dashboard">

    <h1 class="title">dashboard</h1>

    <div class="box-container">

      <div class="box">

        <?php

          $total_pendings = 0;
          $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('Query failed');

          if (mysqli_num_rows($select_pending) > 0) {
            while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
              $total_price = $fetch_pendings['total_price'];
              $total_pendings += $total_price;
            }
          }

        ?>

        <h3>$<?= $total_pendings ?>/-</h3>
        <p>Total pendings</p>

      </div>

      <div class="box">

        <?php

          $total_completed = 0;
          $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('Query failed');

          if (mysqli_num_rows($select_completed) > 0) {
            while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
              $total_price = $fetch_completed['total_price'];
              $total_completed += $total_price;
            }
          }

        ?>

        <h3>$<?= $total_completed ?>/-</h3>
        <p>Completed payments</p>

      </div>

      <div class="box">

        <?php

          $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
          $number_of_orders = mysqli_num_rows($select_orders);

        ?>

        <h3><?= $number_of_orders ?></h3>
        <p>Orders placed</p>

      </div>

      <div class="box">

        <?php

          $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed');
          $number_of_products = mysqli_num_rows($select_products);

        ?>

        <h3><?= $number_of_products ?></h3>
        <p>Products added</p>

      </div>

      <div class="box">

        <?php

          $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('Query failed');
          $number_of_users = mysqli_num_rows($select_users);

        ?>

        <h3><?= $number_of_users ?></h3>
        <p>Regular users</p>

      </div>

      <div class="box">

        <?php

          $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('Query failed');
          $number_of_admins = mysqli_num_rows($select_admins);

        ?>

        <h3><?= $number_of_admins ?></h3>
        <p>Administrators</p>

      </div>

      <div class="box">

        <?php

          $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('Query failed');
          $number_of_account = mysqli_num_rows($select_account);

        ?>

        <h3><?= $number_of_account ?></h3>
        <p>Total accounts</p>

      </div>

      <div class="box">

        <?php

          $select_messages = mysqli_query($conn, "SELECT * FROM `messages`") or die('Query failed');
          $number_of_messages = mysqli_num_rows($select_messages);

        ?>

        <h3><?= $number_of_messages ?></h3>
        <p>New messages</p>

      </div>

    </div>

  </section>

  <!-- Dashboard section OFF -->

  <!-- custom administator page javascript link -->
  <script src="./scripts/admin-script.js"></script>

</body>
</html>