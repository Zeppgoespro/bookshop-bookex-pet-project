<?php

include './config.php';
session_start();

$admin_id = @$_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location: login.php');
  exit;
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('Query failed');
  header('location: admin-messages.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages</title> <!-- Contacts -->

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/admin-style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './admin-header.php' ?>

  <section class="messages">

    <h1 class="title">user messages</h1>

    <div class="box-container">

      <?php
        $select_message = mysqli_query($conn, "SELECT * FROM `messages`") or die('Query failed');

        if (mysqli_num_rows($select_message) > 0) {
          while ($fetch_message = mysqli_fetch_assoc($select_message)) {
      ?>

      <div class="box">
        <p>Name: <span><?= $fetch_message['name'] ?></span></p>
        <p>Number: <span><?= $fetch_message['number'] ?></span></p>
        <p>Email: <span><?= $fetch_message['email'] ?></span></p>
        <p>Message: <span><?= $fetch_message['message'] ?></span></p>
        <div>
          <a href="./admin-messages.php?delete=<?= $fetch_message['id'] ?>" onclick="return confirm('Delete this message?')" class="delete-btn">delete</a>
        </div>
      </div>

      <?php
          }
        } else {
          echo '<p class="empty">You have no messages yet</p>';
        }
      ?>
    </div>

  </section>

  <!-- custom administator page javascript link -->
  <script src="./scripts/admin-script.js"></script>
</body>
</html>