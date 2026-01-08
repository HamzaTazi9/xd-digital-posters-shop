<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}

require_once __DIR__ . "/classes/Db.php";

$conn = Db::getConnection();

$statement = $conn->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nieuw product toevoegen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<section class="admin-form-section">
    <div class="admin-container">

        <h1>Nieuw product toevoegen</h1>

        <?php if(isset($_GET['error'])): ?>
            <p class="error">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </p>
        <?php endif; ?>

        <?php if(isset($_GET['success'])): ?>
            <p class="success">Product succesvol toegevoegd</p>
        <?php endif; ?>

        <form 
            action="admin_products_process.php" 
            method="POST" 
            enctype="multipart/form-data"
            class="admin-form"
        >

            <div class="form-group">
                <label>Product naam</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Prijs (€)</label>
                <input type="number" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Categorie</label>
                <select name="category_id" required>
                    <option value="">-- kies een categorie --</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Afbeelding uploaden</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn-primary">
                Product opslaan
            </button>

        </form>

    </div>
</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
