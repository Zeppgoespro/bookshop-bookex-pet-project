<?php

include './config.php';
session_start();

$user_id = @$_SESSION['user_id'];

/*
if (!isset($user_id)) {
  header('location: login.php');
}
*/

if (isset($_POST['add_to_cart'])) {

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];

  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query failed');

  if (mysqli_num_rows($check_cart_numbers) > 0) {
    $message[] = 'Already added to cart';
  } elseif (!isset($user_id)) {
    $message[] = 'You are not registered yet. Please register or login!';
  } else {
    mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');
    $message[] = 'Product added to cart';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <section class="home">

    <div class="content">
      <h3>Best books in the universe for fill your soul call.</h3>
      <p>Books from all around the world. Almost every genre that you can possibly imagine! Drive your lust for awesome reading insane!</p>
      <a href="./about.php" class="white-btn">Discover more</a>
    </div>

  </section>

  <section class="products">

    <h1 class="title">actual products</h1>

    <div class="box-container">

      <?php

        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('Query failed');

        if (mysqli_num_rows($select_products) > 0) {
          while ($fetch_products = mysqli_fetch_assoc($select_products)) {

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

          }
        } else {
          echo '<p class="empty">No products added yet</p>';
        }

      ?>

    </div>

    <div class="load-more" style="margin-top: 2rem; text-align: center;">
      <a href="./shop.php" class="option-btn">load more</a>
    </div>

  </section>

  <section class="about">

    <div class="flex">

      <div class="image">
        <img src="./images/about-img.jpg" alt="Magic book with butterflies flying from inside">
      </div>

      <div class="content">
        <h3>about us</h3>
        <p>We're cool and awesome team of book lovers in search for the best experience we can share with you. We've seen a lot, know much, have many treasures. So stay awhile and listen...</p>
        <a href="./about.php" class="btn">read more</a>
      </div>

    </div>

  </section>

  <section class="home-contacts">

    <div class="content">
      <h3>have any questions?</h3>
      <p>Then ask us! We're eager to help. And we have any information you may need on your journey.</p>
      <a href="./contacts.php" class="white-btn">contact us</a>
    </div>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>