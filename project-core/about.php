<?php

include './config.php';
session_start();

$user_id = @$_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css?v=<?= time() ?>"> <!-- CACHE PROBLEM - NEED TO FIND BETTER SOLUTION -->
</head>
<body>

  <?php include './header.php' ?>

  <div class="heading">
    <h3>about us</h3>
    <p><a href="./home.php">home</a> | about</p>
  </div>

  <section class="about">

    <div class="flex">

      <div class="image">
        <img src="./images/about-img.jpg" alt="Magic book with butterflies flying from inside">
      </div>

      <div class="content">
        <h3>why us?</h3>
        <p>Because we wear clothes and staves like mages. Actually we're not mages, we just want to trick you, so you buy something we don't need. And you don't need as well.</p>
        <p>Buy some books friend. You don't need money, noone need it. You need books, not the money. We need money because we possesed with greed and lust. Money, money, money. It's all we need, we are like dirty angry pigs.</p>
        <a href="./contacts.php" class="btn">contact us</a>
      </div>

    </div>

  </section>

  <section class="reviews">

    <h1 class="title">our client's reviews</h1>

    <div class="box-container">

      <div class="box">
        <img src="./images/clients-img/pic-1-durov.jpg" alt="Client photo">
        <p>Wow! Super books, I am amazed. Bought whole "Lord of the Rings" here. Didn't like it though. Very boring. But shop is awesome.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <h3>Pavel Durov</h3>
      </div>

      <div class="box">
        <img src="./images/clients-img/pic-2-blackmore.jpg" alt="Client photo">
        <p>I am very intelligent so buying books only here because of my brilliant smartness.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h3>Ritchie Blackmore</h3>
      </div>

      <div class="box">
        <img src="./images/clients-img/pic-3-slash.jpg" alt="Client photo">
        <p>Amazing! Just amazing! I gonna read all the books this guys have.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h3>Slash</h3>
      </div>

      <div class="box">
        <img src="./images/clients-img/pic-4-navalny.jpg" alt="Client photo">
        <p>This shop is stands tall against authoritarian dictators for the sake of all society.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <h3>Alexey Navalny</h3>
      </div>

      <div class="box">
        <img src="./images/clients-img/pic-5-torvalds.jpg" alt="Client photo">
        <p>Love this! This shop is a galaxy of knowledge and wisdom. All people in the world must appreciate efforts of its creators.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <h3>Linus Torvalds</h3>
      </div>

      <div class="box">
        <img src="./images/clients-img/pic-6-justinian.jpg" alt="Client photo">
        <p>Guys i died many-many centuries ago. This shop is a fake, don't be such a dumb.</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h3>Emperor Justinian</h3>
      </div>

    </div>

  </section>

  <section class="authors">

    <h1 class="title">our authors</h1>

    <div class="box-container">

      <div class="box">
        <img src="./images/authors-img/img-1-tolkien.jpg" alt="Author photo">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>J.R.R. Tolkien</h3>
      </div>

      <div class="box">
        <img src="./images/authors-img/img-2-orwell.jpg" alt="Author photo">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>George Orwell</h3>
      </div>

      <div class="box">
        <img src="./images/authors-img/img-3-rand.jpg" alt="Author photo">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Ayn Rand</h3>
      </div>

      <div class="box">
        <img src="./images/authors-img/img-4-martin.jpg" alt="Author photo">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Robert Martin</h3>
      </div>

      <div class="box">
        <img src="./images/authors-img/img-5-shakespeare.jpg" alt="Author photo">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>William Shakespeare</h3>
      </div>

      <div class="box">
        <img src="./images/authors-img/img-6-kiyosaki.jpg" alt="Author photo">
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
          <a href="#" class="fab fa-linkedin"></a>
        </div>
        <h3>Robert Kiyosaki</h3>
      </div>

    </div>

  </section>

  <?php include './footer.php' ?>

  <!-- custom bookex javascript link -->
  <script src="./scripts/script.js"></script>
</body>
</html>