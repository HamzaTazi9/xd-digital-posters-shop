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

$statement = $conn->prepare("
    DELETE FROM products
    WHERE id = :id
");
$statement->bindValue(":id", $id, PDO::PARAM_INT);
$statement->execute();

header("Location: admin_products_list.php?success=deleted");
exit;
