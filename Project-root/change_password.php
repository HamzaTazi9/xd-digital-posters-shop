<?php
session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-box">

            <h1>Change password</h1>

            <?php if(isset($_GET["error"])): ?>
                <p class="error"><?php echo htmlspecialchars($_GET["error"]); ?></p>
            <?php endif; ?>

            <?php if(isset($_GET["success"])): ?>
                <p class="success">Wachtwoord succesvol aangepast</p>
            <?php endif; ?>

            <form action="change_password_process.php" method="POST" class="auth-form">

                <div class="form-group">
                    <label>Huidig wachtwoord</label>
                    <input type="password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label>Nieuw wachtwoord</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label>Bevestig nieuw wachtwoord</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <button type="submit" class="auth-btn">Wijzig wachtwoord</button>

            </form>

        </div>
    </div>
</section>

<?php include_once("footer.inc.php"); ?>

</body>
</html>
