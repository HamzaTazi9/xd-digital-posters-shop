<?php
require_once __DIR__ . "/classes/Db.php";

$conn = Db::getConnection();

$statement = $conn->prepare("SELECT * FROM products");
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);


echo "<pre>";
print_r($products);
echo "</pre>";
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

      <?php foreach($products as $product): ?>
      
        <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-card">

          <div class="product-image">
           
            <img src="images/hoodie.jpg" alt="product">
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
      <a href="#" class="product-card">
        <div class="product-image">
          <img src="images/fo.jpg" alt="">
        </div>
        <div class="product-info">
          <h3 class="product-name">Puffer Jacket Black</h3>
          <p class="product-price">129€</p>
        </div>
      </a>

      <a href="#" class="product-card">
        <div class="product-image">
          <img src="images/fo.jpg" alt="">
        </div>
        <div class="product-info">
          <h3 class="product-name">Puffer Jacket Cream</h3>
          <p class="product-price">129€</p>
        </div>
      </a>
    </div>
  </div>
</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
