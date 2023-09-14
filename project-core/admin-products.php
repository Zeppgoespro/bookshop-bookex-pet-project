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

if (isset($_POST['add_product'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $price = $_POST['price'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = './uploaded-img/' . $image;

  $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('Query failed');

  if (mysqli_num_rows($select_product_name) > 0) {
    $_SESSION['msg'] = 'Product name already added';
    header('location: admin-products.php');
    exit;

  } else {
    $add_product_query = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$name', '$price', '$image')") or die('Query failed');

    if ($add_product_query) {
      if ($image_size > 2000000) {
        $_SESSION['msg'] = 'Image size is too large';
        header('location: admin-products.php');
        exit;

      } else {
        move_uploaded_file($image_tmp_name, $image_folder);
        $_SESSION['msg'] = 'Product added successfully';
        header('location: admin-products.php');
        exit;
      }
    } else {
      $_SESSION['msg'] = 'Product could not be added';
      header('location: admin-products.php');
      exit;
    }
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id ='$delete_id'") or die('Query failed');
  $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
  unlink('./uploaded-img/' . $fetch_delete_image['image']);
  mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('Query failed');
  header('location: admin-products.php');
  exit;
}

if (isset($_POST['update_product'])) {
  $update_p_id = $_POST['update_p_id'];
  $update_name = $_POST['update_name'];
  $update_price = $_POST['update_price'];

  mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('Query failed');

  $update_image = $_FILES['update_image']['name'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_folder = './uploaded-img/' . $update_image;
  $update_old_image = $_POST['update_old_image'];

  if (!empty($update_image)) {
    if ($update_image_size > 2000000) {
      $_SESSION['msg'] = 'Image size is too large';
      header('location: admin-products.php');
      exit;

    } else {
      mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('Query failed');
      move_uploaded_file($update_image_tmp_name, $update_folder);
      unlink('./uploaded-img/' . $update_old_image);
    }
  }
  $_SESSION['msg'] = 'Product updated successfully';
  header('location: admin-products.php');
  exit;
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
  <title>Products</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/admin-style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './admin-header.php' ?>

  <!-- Product CRUD ON -->

  <section class="add-products">

    <h1 class="title">Shop products</h1>

    <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" name="name" class="box" placeholder="Enter product name" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter product price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add product" name="add_product" class="btn">
    </form>

  </section>

  <!-- Product CRUD OFF -->

  <!-- Products representation -->

  <section class="show-products">

    <div class="box-container">

      <?php

        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query faild');
        if (mysqli_num_rows($select_products) > 0) {
          while ($fetch_products = mysqli_fetch_assoc($select_products)) {

      ?>

        <div class="box">
          <img src="./uploaded-img/<?= $fetch_products['image'] ?>" alt="This book cover">
          <div class="name"><?= $fetch_products['name'] ?></div>
          <div class="price">$<?= $fetch_products['price'] ?>/-</div>
          <div>
            <a href="admin-products.php?update=<?= $fetch_products['id'] ?>" class="option-btn">update</a>
            <a href="admin-products.php?delete=<?= $fetch_products['id'] ?>" class="delete-btn" onclick="return confirm('Delete this product?');">delete</a>
          </div>
        </div>

      <?php

          }
        } else {
          echo '<p class="empty">No product added yet</p>';
        }

      ?>

    </div>

  </section>

  <section class="edit-product-form">

    <?php

      if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('Query failed');
        if (mysqli_num_rows($update_query) > 0) {
          while ($fetch_update = mysqli_fetch_assoc($update_query)) {

    ?>

    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?= $fetch_update['id'] ?>">
      <input type="hidden" name="update_old_image" value="<?= $fetch_update['image'] ?>">
      <img src="./uploaded-img/<?= $fetch_update['image'] ?>" alt="This book cover">
      <input type="text" name="update_name" value="<?= $fetch_update['name'] ?>" class="box" required placeholder="Enter product name">
      <input type="number" name="update_price" value="<?= $fetch_update['price'] ?>" min="0" class="box" required placeholder="Enter product price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
    </form>

    <?php

          }
        }
      } else {
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }

    ?>

  </section>

  <!-- custom administator page javascript link -->
  <script src="./scripts/admin-script.js"></script>
</body>
</html>