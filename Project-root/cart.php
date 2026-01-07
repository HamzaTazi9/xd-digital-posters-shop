<?php
session_start();

if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];
}
?>

<?php include_once("nav.inc.php"); ?>

<h1>Winkelmandje</h1>

<?php if(empty($_SESSION["cart"])): ?>

<p>Je winkelmandje is leeg.</p>
<a href="product.php">← Verder winkelen</a>

<?php else: ?>

<table border="1" cellpadding="10">
<tr>
    <th>Product</th>
    <th>Prijs</th>
    <th>Aantal</th>
    <th>Subtotaal</th>
    <th>Actie</th>
</tr>

<?php 
$total = 0;

foreach($_SESSION["cart"] as $id => $item):

    $qty = $item["qty"] ?? $item["quantity"] ?? 1;

    $subtotal = $item["price"] * $qty;
    $total += $subtotal;
?>

<tr>
    <td><?php echo htmlspecialchars($item["name"]); ?></td>

    <td>€ <?php echo number_format($item["price"], 2); ?></td>

    <td><?php echo $qty; ?></td>

    <td>€ <?php echo number_format($subtotal, 2); ?></td>

    <td>
        <a href="cart_remove.php?id=<?php echo $id; ?>">
            Verwijderen
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

<h3>Totaal: € <?php echo number_format($total, 2); ?></h3>

<a href="checkout.php">Bestelling plaatsen</a>

<?php endif; ?>

<?php include_once("footer.inc.php"); ?>
