<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if(empty($_SESSION["cart"])){
    header("Location: cart.php");
    exit;
}

$conn = Db::getConnection();

$total = 0;

foreach($_SESSION["cart"] as $item){
    $total += $item["price"] * $item["quantity"];
}


$statement = $conn->prepare("
    INSERT INTO orders (user_id, total_price, created_at)
    VALUES (:user_id, :total_price, NOW())
");

$statement->bindValue(":user_id", $_SESSION["user_id"]);
$statement->bindValue(":total_price", $total);

$statement->execute();

$orderId = $conn->lastInsertId();

foreach($_SESSION["cart"] as $productId => $item){

    $line = $conn->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price_each)
        VALUES (:order_id, :product_id, :quantity, :price_each)
    ");

    $line->bindValue(":order_id", $orderId);
    $line->bindValue(":product_id", $productId);
    $line->bindValue(":quantity", $item["quantity"]);
    $line->bindValue(":price_each", $item["price"]);

    $line->execute();
}


$_SESSION["cart"] = [];

header("Location: orders_success.php");
exit;
