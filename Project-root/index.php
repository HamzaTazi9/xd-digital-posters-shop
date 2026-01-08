<?php
require_once __DIR__ . "/classes/Db.php";

$conn = Db::getConnection();

$statement = $conn->prepare("
    SELECT p.*, c.name AS category_name
    FROM products p
    LEFT JOIN categories c
    ON p.category_id = c.id
    ORDER BY c.id ASC
");
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);

$categories = [];

foreach($products as $product){
    $catName = $product["category_name"] ?? "Onbekende categorie";
    $categories[$catName][] = $product;
}

function renderProduct($product){


  
  $image = "images/placeholder.jpg";

  if(!empty($product['image'])){
      $image = $product['image'];

    
      if(strpos($image, "uploads/") === 0){
          $image = $image;
      }
  }
  ?>
  <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-card">

      <div class="product-image">
      <img 
  src="<?php echo htmlspecialchars($image); ?>"
  alt="<?php echo htmlspecialchars($product['name']); ?>"
>
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
<?php
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Selfique</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <?php include_once("nav.inc.php"); ?>
    <section class="hero">
      <video class="hero-video" autoplay muted loop playsinline>
        <source src="images/hero_video.mp4" type="video/mp4" />
      </video>

      <div class="hero-overlay"></div>

      <div class="hero-content">
        <h1>Wear Your Uniqueness</h1>
        <p>Minimal . Bold . Authentic</p>
        <a href="product.php" class="hero-btn">Shop Now</a>
      </div>
    </section>

    <?php include_once("nav.inc.php"); ?>


<?php foreach($categories as $categoryName => $productsInCat): ?>

<section class="category-title">
  <h2><?php echo htmlspecialchars($categoryName); ?></h2>
</section>

<section class="product-grid-section">
  <div class="container">
    <div class="product-grid">

        <?php foreach($productsInCat as $product): ?>
            <?php renderProduct($product); ?>
        <?php endforeach; ?>

    </div>
  </div>
</section>

<?php endforeach; ?>
    
    <?php include_once("footer.inc.php"); ?>
  </body>
</html>
