<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_POST['product_id'])){
    header("Location: product.php");
    exit;
}

$productId = (int)$_POST['product_id'];
$quantity = (int)$_POST['quantity'];

if($quantity < 1){
    $quantity = 1;
}

$conn = Db::getConnection();

$statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
$statement->bindValue(":id", $productId, PDO::PARAM_INT);
$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

if(!$product){
    header("Location: product.php");
    exit;
}


if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];
}


if(isset($_SESSION["cart"][$productId])){
    $_SESSION["cart"][$productId]["quantity"] += $quantity;
} else {
    $_SESSION["cart"][$productId] = [
        "name" => $product["name"],
        "price" => $product["price"],
        "quantity" => $quantity
    ];
}

header("Location: cart.php");
exit;
