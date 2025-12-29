<?php
require_once __DIR__ . "/classes/Db.php";
session_start();

if(!empty($_POST)){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        header("Location: login.php?error=empty");
        exit;
    }

    $conn = Db::getConnection();


    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $statement->bindValue(":email", $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        header("Location: login.php?error=wrong");
        exit;
    }


    if(password_verify($password, $user['password'])){

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["wallet"] = $user["wallet"];

        header("Location: index.php");
        exit;
    }
    else {
        header("Location: login.php?error=wrong");
        exit;
    }
}
