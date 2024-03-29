<?php

include './config.php';
session_start();

if (isset($_SESSION['user_id'])):
  $user_id = $_SESSION['user_id'];
else:
  $user_id = '';
endif;

if (isset($_GET['submit'])):
  unset($_SESSION['srch']);
  $_SESSION['srch'] = $_GET['search'];
  header('location: search-page.php#search-anchor');
  exit;
endif;

if (isset($_POST['add_to_cart'])) {

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];

  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query failed');

  if (mysqli_num_rows($check_cart_numbers) > 0) {
    $_SESSION['msg'] = 'Already added to cart';
    header('location: search-page.php#search-anchor');
    exit;
  } elseif ($user_id === '') {
    $_SESSION['msg'] = 'You are not registered yet. Please register or login!';
    header('location: search-page.php#search-anchor');
    exit;
  } else {
    mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');
    $_SESSION['msg'] = 'Product added to cart';
    header('location: search-page.php#search-anchor');
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
  <title>Search</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <div class="heading" id="search-anchor">
    <h3>search page</h3>
    <p><a href="./home.php">home</a> | search</p>
  </div>

  <section class="search-form">

    <form action="" method="get">
      <input type="text" name="search"
        placeholder="<?php
          if (isset($_SESSION['srch']) && $_SESSION['srch'] != ''):
            echo $_SESSION['srch'];
          else:
            echo 'Search some books...';
          endif;
        ?>"
        class="box"
      >
      <input type="submit" name="submit" value="search" class="btn">
    </form>

  </section>

  <section class="products" style="padding-top: 0;">

    <div class="box-container">
      <?php

        if (isset($_SESSION['srch']) && $_SESSION['srch'] != ''):
          $search_item = $_SESSION['srch'];
          $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('Query failed');
            if (mysqli_num_rows($select_products) > 0):
              while ($fetch_products = mysqli_fetch_assoc($select_products)):

      ?>

      <form action="" method="post" class="box">
        <img src="./uploaded-img/<?= $fetch_products['image'] ?>" alt="This book cover">
        <div class="name"><?= $fetch_products['name'] ?></div>
        <div class="price">$<?= $fetch_products['price'] ?>/-</div>
        <input type="number" min="1" name="product_quantity" value="1" class="quantity">
        <input type="hidden" name="product_name" value="<?= $fetch_products['name'] ?>">
        <input type="hidden" name="product_price" value="<?= $fetch_products['price'] ?>">
        <input type="hidden" name="product_image" value="<?= $fetch_products['image'] ?>">
        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>

      <?php

              endwhile;
            else:
              echo '<p class="empty">No results</p>';
            endif;
        else:
          echo '<p class="empty">Search something</p>';
        endif;

      ?>
    </div>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>