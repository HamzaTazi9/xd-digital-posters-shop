<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}

if(!empty($_POST)){

    $id   = $_POST["id"];
    $name = trim($_POST["name"]);
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];

    if(empty($name) || empty($price)){
        header("Location: admin_edit_product.php?id=$id&error=empty");
        exit;
    }

    $conn = Db::getConnection();

    $statement = $conn->prepare("
        UPDATE products
        SET name = :name,
            price = :price,
            category_id = :category_id
        WHERE id = :id
    ");

    $statement->bindValue(":name", $name);
    $statement->bindValue(":price", $price);
    $statement->bindValue(":category_id", $category_id);
    $statement->bindValue(":id", $id);

    $statement->execute();

    header("Location: admin_products_list.php?success=edit");
    exit;
}
