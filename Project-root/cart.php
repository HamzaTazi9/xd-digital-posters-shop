<?php
session_start();

if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Winkelmandje</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<section class="cart-section">
    <div class="container">

        <h1>Winkelmandje</h1>

        <?php if(empty($_SESSION["cart"])): ?>

            <p>Je winkelmandje is leeg.</p>
            <a href="product.php" class="btn">← Verder winkelen</a>

        <?php else: ?>

            <table class="cart-table">
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
                        <a href="cart_remove.php?id=<?php echo $id; ?>" class="link-danger">
                            Verwijderen
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h3 class="cart-total">
                Totaal: € <?php echo number_format($total, 2); ?>
            </h3>

            <a href="checkout.php" class="btn-primary">
                Bestelling plaatsen
            </a>

        <?php endif; ?>

    </div>
</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
