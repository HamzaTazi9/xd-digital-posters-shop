<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}
require_once __DIR__ . "/classes/Db.php";

?>

<?php include_once("nav.inc.php"); ?>

<h1>Nieuw product toevoegen</h1>
<?php if(isset($_GET['error'])): ?>
  <p class="error">
    <?php echo htmlspecialchars($_GET['error']); ?>
  </p>
<?php endif; ?>

<?php if(isset($_GET['success'])): ?>
  <p class="success">Product succesvol toegevoegd</p>
<?php endif; ?>

<form action="admin_products_process.php" method="POST">
    
    <label>Product naam</label>
    <input type="text" name="title" required>

    <label>Prijs (€)</label>
    <input type="number" name="price" step="0.01" required>

    <label>Categorie ID</label>
    <input type="number" name="category_id" required>

    <button type="submit">Product opslaan</button>

</form>
<?php include_once("footer.inc.php"); ?>