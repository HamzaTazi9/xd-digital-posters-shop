<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.php");
    exit;
}
?>

<?php include_once("nav.inc.php"); ?>

<h1>Admin — Productbeheer</h1>
<p>Hier kan de admin producten toevoegen, bewerken en verwijderen.</p>

<?php include_once("footer.inc.php"); ?>