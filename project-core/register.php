<?php

include './config.php';

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
  $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
  $user_type = $_POST['user_type'];

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('Query failed');

  if (mysqli_num_rows($select_users) > 0) {
    setcookie('msg', 'User already exist', time() + 3600);
    header('location: register.php');
    exit;

  } else {
    if ($pass != $cpass) {
      setcookie('msg', 'Confirmed password not matched', time() + 3600);
      header('location: register.php');
      exit;

    } else {
      mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES ('$name', '$email', '$cpass', '$user_type')") or die('Query failed');
      setcookie('msg', 'Successfully registered', time() + 3600);
      header('location: login.php');
      exit;

    }
  }
}

if (isset($_COOKIE['msg'])) {
  $message[] = $_COOKIE['msg'];
  unset($_COOKIE['msg']);
  setcookie('msg', '', time() - 3600);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

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

  <div class="form-container">

    <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter your name" required class="box">
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
      <select name="user_type" class="box">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>Already have an account? <a href="./login.php">Login now</a></p>
      <p style="padding-top: .3rem; font-size: 1.5rem;">Or go to the <a href="./home.php">main page</a></p>
    </form>

  </div>

</body>
</html>