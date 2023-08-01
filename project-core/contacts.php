<?php

include './config.php';
session_start();

$user_id = @$_SESSION['user_id'];

if (!isset($user_id)) {
  $message[] = 'You are not registered yet. Please register or login to send a message!';
}

if (isset($_POST['send'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $number = $_POST['number'];
  $msg = mysqli_real_escape_string($conn, $_POST['message']);

  $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('Query failed');

  if (mysqli_num_rows($select_message) > 0) {
    $_SESSION['msg'] = 'Message sent already';
    header('location: contacts.php');
    exit;
  } elseif (!isset($user_id)) {
    header('location: contacts.php');
    exit;
  } else {
    mysqli_query($conn, "INSERT INTO `messages` (user_id, name, email, number, message) VALUES ('$user_id', '$name', '$email', '$number', '$msg')") or die('Query failed');
    $_SESSION['msg'] = 'Message sent successfully';
    header('location: contacts.php');
    exit;
  }
}

if (isset($_SESSION['msg'])) {
  $message[] = $_SESSION['msg'];
  unset($_SESSION['msg']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <div class="heading">
    <h3>contact us</h3>
    <p><a href="./home.php">home</a> | contacts</p>
  </div>

  <section class="contacts">

    <form action="" method="post">
      <h3>share your thoughts</h3>
      <input type="text" name="name" required placeholder="Enter your name" class="box">
      <input type="email" name="email" required placeholder="Enter your email" class="box">
      <input type="tel" name="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required placeholder="Enter your telephone number" class="box">
      <small style="font-size: 1.5rem; color: var(--black);">Format: 123-456-7890</small>
      <textarea name="message" class="box" required placeholder="Enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
    </form>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>