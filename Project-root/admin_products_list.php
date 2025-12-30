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
");
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once("nav.inc.php"); ?>

<h1>Product beheer</h1>

<a href="admin_products.php">+ Nieuw product</a>

<h1>Product beheer</h1>

<a href="admin_products.php">+ Nieuw product</a>

<?php if(isset($_GET['success'])): ?>
    <p class="success">Actie uitgevoerd</p>
<?php endif; ?>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Titel</th>
        <th>Prijs</th>
        <th>Categorie</th>
        <th>Acties</th>
    </tr>

    <?php foreach($products as $product): ?>
    <tr>
        <td><?php echo $product["id"]; ?></td>

        <td><?php echo htmlspecialchars($product["name"]); ?></td>

        <td>€ <?php echo $product["price"]; ?></td>

        <td>
            <?php echo $product["category"] ?? "—"; ?>
        </td>

        <td>

            <a href="admin_edit_product.php?id=<?php echo $product['id']; ?>">
                Wijzigen
            </a>

            |

            <form action="admin_delete_product.php"
                  method="POST"
                  style="display:inline">

                <input type="hidden" name="id"
                       value="<?php echo $product['id']; ?>">

                <button type="submit"
                    onclick="return confirm('Zeker dat je dit product wil verwijderen?')">
                    Verwijderen
                </button>

            </form>

        </td>
    </tr>
    <?php endforeach; ?>
</table>


<?php include_once("footer.inc.php"); ?>
