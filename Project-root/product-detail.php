<?php
echo "<pre>";
print_r($_GET);
echo "</pre>";
require_once __DIR__ . "/classes/Db.php";

if(!isset($_GET['id'])){
    die("Geen product geselecteerd");
}

$id = $_GET['id'];

$conn = Db::getConnection();

$statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
$statement->bindValue(":id", $id, PDO::PARAM_INT);
$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

if(!$product){
    die("Product niet gevonden");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<section class="product-detail">

    <h1><?php echo htmlspecialchars($product['name']); ?></h1>

    <p>Prijs: € <?php echo $product['price']; ?></p>

    <p>Beschrijving:</p>
    <p>
        <?php echo nl2br(htmlspecialchars($product['description'] ?? "")); ?>
    </p>

    <a href="product.php">← Terug naar producten</a>

</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
