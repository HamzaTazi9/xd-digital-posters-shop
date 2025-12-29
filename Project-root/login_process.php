<?php
require_once __DIR__ . "/classes/Db.php";
session_start();

if(!empty($_POST)){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        die("Alle velden zijn verplicht");
    }

    $conn = Db::getConnection();

    
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $statement->bindValue(":email", $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        die("Gebruiker bestaat niet");
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
        die("Wachtwoord is fout");
    }
}
