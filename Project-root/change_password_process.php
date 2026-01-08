<?php
session_start();
require_once __DIR__ . "/classes/Db.php";

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if(empty($_POST)){
    header("Location: change_password.php");
    exit;
}

$currentPassword = $_POST["current_password"];
$newPassword     = $_POST["new_password"];
$confirmPassword = $_POST["confirm_password"];

if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword)){
    header("Location: change_password.php?error=Vul alle velden in");
    exit;
}

if($newPassword !== $confirmPassword){
    header("Location: change_password.php?error=Wachtwoorden komen niet overeen");
    exit;
}

$conn = Db::getConnection();


$statement = $conn->prepare("
    SELECT password
    FROM users
    WHERE id = :id
");
$statement->bindValue(":id", $_SESSION["user_id"], PDO::PARAM_INT);
$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);

if(!$user){
    header("Location: change_password.php?error=Gebruiker niet gevonden");
    exit;
}


if(!password_verify($currentPassword, $user["password"])){
    header("Location: change_password.php?error=Huidig wachtwoord incorrect");
    exit;
}


$newHash = password_hash($newPassword, PASSWORD_DEFAULT);


$update = $conn->prepare("
    UPDATE users
    SET password = :password
    WHERE id = :id
");
$update->bindValue(":password", $newHash);
$update->bindValue(":id", $_SESSION["user_id"], PDO::PARAM_INT);
$update->execute();

header("Location: change_password.php?success=1");
exit;
