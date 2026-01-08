<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if(!isset($_GET["id"])){
    die("Geen bestelling geselecteerd");
}

$orderId = $_GET["id"];

$conn = Db::getConnection();

$statement = $conn->prepare("
    SELECT o.*, u.username
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.id = :id
    AND o.user_id = :user_id
");
$statement->bindValue(":id", $orderId);
$statement->bindValue(":user_id", $_SESSION["user_id"]);
$statement->execute();

$order = $statement->fetch(PDO::FETCH_ASSOC);

if(!$order){
    die("Bestelling niet gevonden");
}

$itemStatement = $conn->prepare("
    SELECT oi.*, p.name
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = :order_id
");
$itemStatement->bindValue(":order_id", $orderId);
$itemStatement->execute();

$items = $itemStatement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once("nav.inc.php"); ?>

<h1>Bestelling #<?php echo $order["id"]; ?></h1>

<p>Datum: <?php echo $order["created_at"]; ?></p>
<p>Totaal: € <?php echo $order["total_price"]; ?></p>

<hr>

<h2>Producten</h2>

<table border="1" cellpadding="10">
<tr>
  <th>Product</th>
  <th>Prijs</th>
  <th>Aantal</th>
  <th>Subtotaal</th>
</tr>

<?php foreach($items as $item): 

$price = $item["price_each"];
$qty = $item["quantity"];
$subtotal = $price * $qty;

?>
<tr>
<td><?php echo htmlspecialchars($item["name"]); ?></td>

<td>
  € <?php echo number_format($price, 2); ?>
</td>

<td><?php echo $qty; ?></td>

<td>
  € <?php echo number_format($subtotal, 2); ?>
</td>
</tr>
<?php endforeach; ?>

</table>

<a href="my_orders.php">← Terug naar bestellingen</a>

<?php include_once("footer.inc.php"); ?>
