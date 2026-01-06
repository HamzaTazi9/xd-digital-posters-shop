<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}

if(empty($_POST["id"])){
    header("Location: admin_products_list.php?error=noproduct");
    exit;
}

$id = $_POST["id"];

$conn = Db::getConnection();


$getProduct = $conn->prepare("SELECT image FROM products WHERE id = :id");
$getProduct->bindValue(":id", $id, PDO::PARAM_INT);
$getProduct->execute();

$product = $getProduct->fetch(PDO::FETCH_ASSOC);

$delete = $conn->prepare("
    DELETE FROM products
    WHERE id = :id
");
$delete->bindValue(":id", $id, PDO::PARAM_INT);
$delete->execute();

$imagePath = __DIR__ . "/" . $product["image"];

$imagePath = __DIR__ . "/" . $product["image"];

if(!empty($product["image"]) && file_exists($imagePath)){
    unlink($imagePath);
}


header("Location: admin_products_list.php?success=deleted");
exit;
