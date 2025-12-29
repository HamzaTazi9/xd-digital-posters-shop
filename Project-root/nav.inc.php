<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<header class="navbar">
      <div class="nav-container">
        <a href="index.php" class="logo">Selfique</a>

        <nav class="links">
          <a href="product.php">Our products</a>
          <a href="featured.php">Featured</a>
          <a href="about.php">About</a>
        </nav>


        <div class="nav-actions">
    
        <?php if(isset($_SESSION["user_id"])): ?>

<span>
  Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>
</span>

<span class="wallet">
  Wallet: <?php echo $_SESSION["wallet"]; ?> 🪙
</span>

<a href="cart.php">
  <img src="images/online-shopping.png" alt="">
</a>

<a href="logout.php">Logout</a>

<?php else: ?>

<a href="login.php">
  <img src="images/user (1).png" alt="">
</a>

<a href="register.php">Register</a>

<a href="cart.php">
  <img src="images/online-shopping.png" alt="">
</a>

<?php endif; ?>
        </div>
      </div>
    </header>