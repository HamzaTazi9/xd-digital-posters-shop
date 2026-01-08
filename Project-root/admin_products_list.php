<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}

$conn = Db::getConnection();

$statement = $conn->prepare("
    SELECT p.id, p.name, p.price, c.name AS category
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.id DESC
");
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product beheer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<section class="admin-section">
    <div class="admin-container">

        <h1>Product beheer</h1>

        <a href="admin_products.php" class="btn-primary admin-add-btn">
            + Nieuw product
        </a>

        <?php if(isset($_GET['success'])): ?>
            <p class="success">Actie succesvol uitgevoerd</p>
        <?php endif; ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Prijs</th>
                    <th>Categorie</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($products as $product): ?>
                <tr>
                    <td><?php echo $product["id"]; ?></td>
                    <td><?php echo htmlspecialchars($product["name"]); ?></td>
                    <td>€ <?php echo number_format($product["price"], 2); ?></td>
                    <td><?php echo htmlspecialchars($product["category"] ?? "—"); ?></td>
                    <td class="admin-actions">

                        <a href="admin_edit_product.php?id=<?php echo $product['id']; ?>">
                            Wijzigen
                        </a>

                        <form action="admin_delete_product.php"
                              method="POST"
                              onsubmit="return confirm('Zeker dat je dit product wil verwijderen?')">

                            <input type="hidden" name="id"
                                   value="<?php echo $product['id']; ?>">

                            <button type="submit" class="link-danger">
                                Verwijderen
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
