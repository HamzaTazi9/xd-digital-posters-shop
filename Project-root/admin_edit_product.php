<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}

$conn = Db::getConnection();

$id = $_GET['id'];

$statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
$statement->bindValue(":id", $id);
$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

if(!$product){
    die("Product niet gevonden");
}
?>

<?php include_once("nav.inc.php"); ?>

<h1>Product bewerken</h1>

<form action="admin_edit_product_process.php" method="POST">

    <input type="hidden" name="id"
           value="<?php echo $product['id']; ?>">

    <label>Titel</label>
    <input type="text" name="name"
           value="<?php echo htmlspecialchars($product['name']); ?>">

    <label>Prijs (€)</label>
    <input type="number" step="0.01" name="price"
           value="<?php echo $product['price']; ?>">

    <label>Categorie ID</label>
    <input type="number" name="category_id"
           value="<?php echo $product['category_id']; ?>">

    <button type="submit">Opslaan</button>

</form>

<?php include_once("footer.inc.php"); ?>
