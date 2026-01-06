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

  
    $image = $_POST["old_image"];

    if(empty($name) || empty($price)){
        header("Location: admin_edit_product.php?id=$id&error=empty");
        exit;
    }


    if(!empty($_FILES["image"]["name"])){

        $fileName = time() . "_" . $_FILES["image"]["name"];
        $target = "uploads/" . $fileName;

        move_uploaded_file($_FILES["image"]["tmp_name"], $target);

        $image = $target;   
    }

    $conn = Db::getConnection();

    $statement = $conn->prepare("
        UPDATE products
        SET name = :name,
            price = :price,
            category_id = :category_id,
            image = :image
        WHERE id = :id
    ");

    $statement->bindValue(":name", $name);
    $statement->bindValue(":price", $price);
    $statement->bindValue(":category_id", $category_id);
    $statement->bindValue(":image", $image);
    $statement->bindValue(":id", $id);

    $statement->execute();

    header("Location: admin_products_list.php?success=edit");
    exit;
}