<?php
require_once __DIR__ . "/classes/Db.php";

if(!isset($_GET['id'])){
    die("Geen product geselecteerd");
}

$id = $_GET['id'];

$conn = Db::getConnection();

$statement = $conn->prepare("
    SELECT p.*, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.id = :id
");
$statement->bindValue(":id", $id, PDO::PARAM_INT);
$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

if(!$product){
    die("Product niet gevonden");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include_once("nav.inc.php"); ?>

<section class="product-detail">

    <h1><?php echo htmlspecialchars($product['name']); ?></h1>

    <img 
    src="<?php echo !empty($product['image']) 
        ? htmlspecialchars($product['image']) 
        : 'images/placeholder.jpg'; ?>"
    alt="<?php echo htmlspecialchars($product['name']); ?>"
>


    <p>Prijs: € <?php echo $product['price']; ?></p>

    <p>
        Categorie:
        <?php echo htmlspecialchars($product['category_name'] ?? "Onbekend"); ?>
    </p>

    <p>Beschrijving:</p>
    <p><?php echo nl2br(htmlspecialchars($product['description'] ?? "")); ?></p>

    <a href="product.php">← Terug naar producten</a>

</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
