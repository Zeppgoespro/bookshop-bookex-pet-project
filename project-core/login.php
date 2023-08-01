<?php

include './config.php';
session_start();

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name' AND email = '$email' AND password = '$pass'") or die('Query failed');

  if (mysqli_num_rows($select_users) > 0) {
    $row = mysqli_fetch_assoc($select_users);

    if ($row['user_type'] == 'admin') {
      $_SESSION['admin_name'] = $row['name'];
      $_SESSION['admin_email'] = $row['email'];
      $_SESSION['admin_id'] = $row['id'];
      header('location: admin-page.php');
      exit;
    } elseif ($row['user_type'] == 'user') {
      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id'];
      header('location: home.php');
      exit;
    }

  } else {
    $_SESSION['msg'] = 'Incorrect name, email or password';
    header('location: login.php');
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
  <title>Login</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php

    if (isset($message)) {
      foreach($message as $message) {
        echo '
        <div class="message">
          <span>' . $message . '</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
      }
    }

  ?>

  <div class="form-container">

    <form action="" method="post">
      <h3>please login</h3>
      <input type="text" name="name" placeholder="Enter your name" required class="box">
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>Don't have an account? <a href="./register.php">Register</a></p>
      <p style="padding-top: .3rem; font-size: 1.5rem;">Or go to the <a href="./home.php">main page</a></p>
    </form>

  </div>

</body>
</html>