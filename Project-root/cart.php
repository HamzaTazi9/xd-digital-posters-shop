<?php
session_start();
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
</tr>

<?php 
$total = 0;

foreach($_SESSION["cart"] as $id => $item):
    
    $subtotal = $item["price"] * $item["quantity"];
    $total += $subtotal;
?>
<tr>
    <td><?php echo htmlspecialchars($item["name"]); ?></td>
    <td>€ <?php echo $item["price"]; ?></td>
    <td><?php echo $item["quantity"]; ?></td>
    <td>€ <?php echo $subtotal; ?></td>
</tr>

<?php endforeach; ?>

</table>

<h3>Totaal: € <?php echo $total; ?></h3>

<a href="checkout.php">Bestelling plaatsen</a>

<?php endif; ?>

<?php include_once("footer.inc.php"); ?>
