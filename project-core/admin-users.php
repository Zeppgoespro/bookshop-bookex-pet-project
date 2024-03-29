<?php

include './config.php';
session_start();

if (isset($_SESSION['admin_id'])):
  $admin_id = $_SESSION['admin_id'];
else:
  $admin_id = '';
  header('location: login.php');
  exit;
endif;

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('Query failed');
  header('location: admin-users.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/admin-style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './admin-header.php' ?>

  <section class="users">

    <h1 class="title">user accounts</h1>

    <div class="box-container">

      <?php

        $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('Query failed');

        while ($fetch_users = mysqli_fetch_assoc($select_users)) {

      ?>

      <div class="box">
        <p>User name: <span><?= $fetch_users['name'] ?></span></p>
        <p>Email: <span><?= $fetch_users['email'] ?></span></p>
        <p>User type: <span style="color:
        <?php
          if ($fetch_users['user_type'] == 'admin') {
            echo 'var(--orange)';
          }
        ?>"><?= $fetch_users['user_type'] ?></span></p>
        <a href="./admin-users.php?delete=<?= $fetch_users['id'] ?>" onclick="return confirm('Delete this user?')" class="delete-btn">delete</a>
      </div>

      <?php
        };
      ?>

    </div>

  </section>

  <!-- custom administator page javascript link -->
  <script src="./scripts/admin-script.js"></script>
</body>
</html>