<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];

$conn = Db::getConnection();

$statement = $conn->prepare("
    SELECT *
    FROM orders
    WHERE user_id = :user_id
    ORDER BY created_at DESC
");

$statement->bindValue(":user_id", $userId, PDO::PARAM_INT);
$statement->execute();

$orders = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once("nav.inc.php"); ?>

<h1>Mijn bestellingen</h1>

<?php if(empty($orders)): ?>

<p>Je hebt nog geen bestellingen geplaatst.</p>

<a href="product.php">Ga naar producten</a>

<?php else: ?>

<table border="1" cellpadding="10">
<tr>
    <th>Bestelnummer</th>
    <th>Totaal</th>
    <th>Datum</th>
    <th>Detail</th>
</tr>

<?php foreach($orders as $order): ?>
<tr>
    <td>#<?php echo $order["id"]; ?></td>

    <td>€ <?php echo $order["total_price"]; ?></td>

    <td><?php echo $order["created_at"]; ?></td>

    <td>
        <a href="my_order_detail.php?id=<?php echo $order['id']; ?>">
            Bekijk bestelling
        </a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?php endif; ?>

<?php include_once("footer.inc.php"); ?>
