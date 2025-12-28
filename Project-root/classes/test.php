<?php

require_once __DIR__ . "/Db.php";

$conn = Db::getConnection();

$users = $conn->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($users);
echo "</pre>";
