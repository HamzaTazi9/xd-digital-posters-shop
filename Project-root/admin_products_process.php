<?php
session_start();
require_once __DIR__ . "/classes/Db.php";


if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}

if (!empty($_POST)) {


    $title       = trim($_POST['title']);       
    $price       = $_POST['price'];              
    $category_id = $_POST['category_id'];        

  
    if (empty($title) || empty($price) || empty($category_id)) {
        header("Location: admin_products.php?error=Vul alle velden in");
        exit;
    }

    if ($price < 0) {
        header("Location: admin_products.php?error=Prijs mag niet negatief zijn");
        exit;
    }


    $conn = Db::getConnection();

    $statement = $conn->prepare("
    INSERT INTO products (name, price, category_id, created_at)
    VALUES (:name, :price, :category_id, NOW())
");

$statement->bindValue(":name", $title);
$statement->bindValue(":price", $price);
$statement->bindValue(":category_id", $category_id, PDO::PARAM_INT);

$statement->execute();


    $statement->execute();


    header("Location: ./admin_products.php?success=1");
    exit;
}
