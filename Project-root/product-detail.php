<?php
session_start();
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

$reviewStatement = $conn->prepare("
    SELECT r.rating, r.comment, r.created_at, u.username
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.product_id = :product_id
    ORDER BY r.created_at DESC
");
$reviewStatement->bindValue(":product_id", $product["id"], PDO::PARAM_INT);
$reviewStatement->execute();

$reviews = $reviewStatement->fetchAll(PDO::FETCH_ASSOC);
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

<hr>

<h2>Reviews</h2>

<?php if(isset($_SESSION["user_id"])): ?>

<form id="reviewForm">
    <input type="hidden" id="product_id" value="<?php echo $product['id']; ?>">

    <label>Rating</label><br>
    <select id="rating" required>
        <option value="">Kies</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <br><br>

    <textarea id="comment" placeholder="Schrijf je review..." required></textarea>

    <br><br>
    <button type="submit">Review plaatsen</button>
</form>

<?php else: ?>
    <p><a href="login.php">Log in</a> om een review te plaatsen.</p>
<?php endif; ?>

<div id="reviewsList">
<?php if(empty($reviews)): ?>
    <p>Er zijn nog geen reviews.</p>
<?php else: ?>
    <?php foreach($reviews as $review): ?>
        <div class="review">
            <strong><?php echo htmlspecialchars($review["username"]); ?></strong>
            – Rating: <?php echo (int)$review["rating"]; ?>/5<br>
            <small><?php echo $review["created_at"]; ?></small>
            <p><?php echo nl2br(htmlspecialchars($review["comment"])); ?></p>
            <hr>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<form method="POST" action="cart_add.php">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <label>Aantal</label>
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">Toevoegen aan winkelmand</button>
</form>

<?php include_once("footer.inc.php"); ?>

<script src="js/reviews.js"></script>
</body>
</html>
