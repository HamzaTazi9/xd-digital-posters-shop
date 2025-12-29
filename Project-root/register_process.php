<?php
require_once __DIR__ . "/classes/Db.php";

if(!empty($_POST)){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];


    if(empty($username) || empty($email) || empty($password)){
        header("Location: register.php?error=empty");
        exit;
    }

    $conn = Db::getConnection();


    $check = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $check->bindValue(":email", $email);
    $check->execute();

    if($check->rowCount() > 0){
        header("Location: register.php?error=email_exists");
        exit;
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $statement = $conn->prepare("
        INSERT INTO users (username, email, password, wallet)
        VALUES (:username, :email, :password, 1000)
    ");

    $statement->bindValue(":username", $username);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":password", $hashedPassword);
    $statement->execute();

    header("Location: register.php?success=1");
exit;;
} 

