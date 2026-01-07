<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if(empty($_SESSION["cart"])){
    die("Je winkelmandje is leeg");
}

$total = 0;

foreach($_SESSION["cart"] as $item){
    $total += $item["price"] * $item["quantity"];
}

$conn = Db::getConnection();
?>

<?php include_once("nav.inc.php"); ?>

<h1>Checkout</h1>

<h3>Overzicht bestelling</h3>

<table border="1" cellpadding="10">
<tr>
    <th>Product</th>
    <th>Prijs</th>
    <th>Aantal</th>
    <th>Subtotaal</th>
</tr>

<?php foreach($_SESSION["cart"] as $item): ?>

<tr>
    <td><?php echo htmlspecialchars($item["name"]); ?></td>
    <td>€ <?php echo $item["price"]; ?></td>
    <td><?php echo $item["quantity"]; ?></td>

    <td>
        € <?php echo $item["price"] * $item["quantity"]; ?>
    </td>
</tr>

<?php endforeach; ?>

</table>

<h3>Totaal: € <?php echo $total; ?></h3>

<form action="checkout_process.php" method="POST">
    <button type="submit">Bestelling plaatsen</button>
</form>

<?php include_once("footer.inc.php"); ?>
