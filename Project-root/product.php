<?php
require_once __DIR__ . "/classes/Db.php";

//essenti ls
$conn = Db::getConnection();
$essentials = $conn->prepare("SELECT * FROM products WHERE category_id = 1");
$essentials->execute();
$essentials = $essentials->fetchAll(PDO::FETCH_ASSOC);

// Outerwear 
$outerwear = $conn->prepare("SELECT * FROM products WHERE category_id = 2");
$outerwear->execute();
$outerwear = $outerwear->fetchAll(PDO::FETCH_ASSOC);

// Bottom
$bottoms = $conn->prepare("SELECT * FROM products WHERE category_id = 3");
$bottoms->execute();
$bottoms = $bottoms->fetchAll(PDO::FETCH_ASSOC);

// Accessories
$accessories = $conn->prepare("SELECT * FROM products WHERE category_id = 4");
$accessories->execute();
$accessories = $accessories->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selfique</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include_once("nav.inc.php"); ?>

<section class="products-hero">
  <div class="products-hero-image"></div>
  <div class="products-hero-overlay"></div>
  <div class="products-hero-content">
    <h1>Our Collection</h1>
    <p>Minimal . Bold . Authentic</p>
  </div>
</section>



<section class="category-title">
  <h2>Selfique Essentials</h2>
</section>

<section class="product-grid-section">
<div class="container">
<div class="product-grid">

<?php foreach($essentials as $product): ?>
  
  <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-card">

    <div class="product-image">
      <img src="images/hoodie.jpg" alt="">
    </div>

    <div class="product-info">
      <h3 class="product-name">
        <?php echo htmlspecialchars($product['name']); ?>
      </h3>

      <p class="product-price">
        € <?php echo $product['price']; ?>
      </p>
    </div>

  </a>

<?php endforeach; ?>

</div>
</div>
</section>

<section class="category-title">
  <h2>Selfique Outerwear</h2>
</section>

<section class="product-grid-section">
<div class="container">
<div class="product-grid">

<?php foreach($outerwear as $product): ?>

  <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-card">

    <div class="product-image">
      <img src="images/fo.jpg" alt="">
    </div>

    <div class="product-info">
      <h3><?php echo htmlspecialchars($product['name']); ?></h3>
      <p>€ <?php echo $product['price']; ?></p>
    </div>

  </a>

<?php endforeach; ?>

</div>
</div>
</section>

<section class="category-title">
  <h2>Selfique Bottoms</h2>
</section>

<section class="product-grid-section">
<div class="container">
<div class="product-grid">

<?php foreach($bottoms as $product): ?>

  <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-card">

    <div class="product-image">
      <img src="images/jeans.jpg" alt="">
    </div>

    <div class="product-info">
      <h3><?php echo htmlspecialchars($product['name']); ?></h3>
      <p>€ <?php echo $product['price']; ?></p>
    </div>

  </a>

<?php endforeach; ?>

</div>
</div>
</section>


<section class="category-title">
  <h2>Selfique Accessories</h2>
</section>

<section class="product-grid-section">
<div class="container">
<div class="product-grid">

<?php foreach($accessories as $product): ?>

  <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-card">

    <div class="product-image">
      <img src="images/sjaal.jpg" alt="">
    </div>

    <div class="product-info">
      <h3><?php echo htmlspecialchars($product['name']); ?></h3>
      <p>€ <?php echo $product['price']; ?></p>
    </div>

  </a>

<?php endforeach; ?>

</div>
</div>
</section>





<?php include_once("footer.inc.php"); ?>

</body>
</html>
