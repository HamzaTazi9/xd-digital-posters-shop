<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Niet ingelogd"
    ]);
    exit;
}


if (
    empty($_POST["product_id"]) ||
    empty($_POST["rating"]) ||
    empty($_POST["comment"])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Ongeldige invoer"
    ]);
    exit;
}

$userId    = (int) $_SESSION["user_id"];
$productId = (int) $_POST["product_id"];
$rating    = (int) $_POST["rating"];
$comment   = trim($_POST["comment"]);

$conn = Db::getConnection();

$stmt = $conn->prepare("
    INSERT INTO reviews (user_id, product_id, rating, comment, created_at)
    VALUES (:user_id, :product_id, :rating, :comment, NOW())
");

$stmt->bindValue(":user_id", $userId, PDO::PARAM_INT);
$stmt->bindValue(":product_id", $productId, PDO::PARAM_INT);
$stmt->bindValue(":rating", $rating, PDO::PARAM_INT);
$stmt->bindValue(":comment", $comment);

$stmt->execute();


echo json_encode([
    "status" => "success",
    "username" => $_SESSION["username"] ?? "Gebruiker",
    "rating" => $rating,
    "comment" => htmlspecialchars($comment),
    "created_at" => date("Y-m-d H:i:s")
]);
exit;
