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

    $imagePath = null;

if(!empty($_FILES['image']['name'])){

    $fileName = time() . "_" . basename($_FILES['image']['name']);

    
    $target = __DIR__ . "/uploads/" . $fileName;

    move_uploaded_file($_FILES['image']['tmp_name'], $target);


    $imagePath = "uploads/" . $fileName;
}
    

    $statement = $conn->prepare("
        INSERT INTO products (name, price, category_id, image, created_at)
        VALUES (:name, :price, :category_id, :image, NOW())
    ");
    
    $statement->bindValue(":name", $title);
    $statement->bindValue(":price", $price);
    $statement->bindValue(":category_id", $category_id, PDO::PARAM_INT);
    $statement->bindValue(":image", $imagePath);
    
    $statement->execute();
    
    header("Location: admin_products.php?success=1");
    exit;
    
}
