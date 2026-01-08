<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (empty($_SESSION["cart"])) {
    header("Location: cart.php");
    exit;
}

$conn = Db::getConnection();

$total = 0;

foreach ($_SESSION["cart"] as $item) {
    $total += $item["price"] * $item["quantity"];
}

if ($total <= 0) {
    header("Location: cart.php?error=invalidtotal");
    exit;
}



$walletStatement = $conn->prepare("
    SELECT wallet
    FROM users
    WHERE id = :id
");
$walletStatement->bindValue(":id", $_SESSION["user_id"], PDO::PARAM_INT);
$walletStatement->execute();

$user = $walletStatement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: cart.php?error=usernotfound");
    exit;
}

if ($user["wallet"] < $total) {
    header("Location: cart.php?error=notenoughmoney");
    exit;
}

$orderStatement = $conn->prepare("
    INSERT INTO orders (user_id, total_price, created_at)
    VALUES (:user_id, :total_price, NOW())
");

$orderStatement->bindValue(":user_id", $_SESSION["user_id"], PDO::PARAM_INT);
$orderStatement->bindValue(":total_price", $total);
$orderStatement->execute();

$orderId = $conn->lastInsertId();


$itemStatement = $conn->prepare("
    INSERT INTO order_items (order_id, product_id, quantity, price_each)
    VALUES (:order_id, :product_id, :quantity, :price_each)
");

foreach ($_SESSION["cart"] as $productId => $item) {

    $itemStatement->bindValue(":order_id", $orderId, PDO::PARAM_INT);
    $itemStatement->bindValue(":product_id", $productId, PDO::PARAM_INT);
    $itemStatement->bindValue(":quantity", $item["quantity"], PDO::PARAM_INT);
    $itemStatement->bindValue(":price_each", $item["price"]);

    $itemStatement->execute();
}


$updateWallet = $conn->prepare("
    UPDATE users
    SET wallet = wallet - :total
    WHERE id = :id
");

$updateWallet->bindValue(":total", $total);
$updateWallet->bindValue(":id", $_SESSION["user_id"], PDO::PARAM_INT);
$updateWallet->execute();
$_SESSION["wallet"] = $user["wallet"] - $total;

unset($_SESSION["cart"]);

header("Location: orders_success.php?id=" . $orderId);
exit;
