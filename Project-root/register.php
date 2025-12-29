
<?php include_once("nav.inc.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <section class="auth-section">
      <div class="auth-container">
        <div class="auth-box">
          <h1>Create Account</h1>
          <p class="auth-subtitle">Join Selfique today</p>

          <?php if(isset($_GET['error'])): ?>

<?php if($_GET['error'] === 'empty'): ?>
  <p class="error">Gelieve alle velden in te vullen</p>

<?php elseif($_GET['error'] === 'email_exists'): ?>
  <p class="error">Dit emailadres bestaat al</p>

<?php endif; ?>

<?php endif; ?>


<?php if(isset($_GET['success'])): ?>
<p class="success">Account aangemaakt — je kan nu inloggen</p>
<?php endif; ?>



          <form action="register_process.php" method="POST" class="auth-form">
            <div class="form-group">
              <label>Username</label>
              <input
                type="text"
                name="username"
                placeholder="username"
                required
              />
            </div>

            <div class="form-group">
              <label>Email</label>
              <input
                type="email"
                name="email"
                placeholder="your@email.com"
                required
              />
            </div>

            <div class="form-group">
              <label>Password</label>
              <input
                type="password"
                name="password"
                placeholder="••••••••"
                required
              />
            </div>

            <button type="submit" class="auth-btn">Create Account</button>

            <p class="auth-switch">
              Already have an account? <a href="login.html">Login</a>
            </p>
          </form>
        </div>
      </div>
    </section>
    <?php include_once(__DIR__ . "/footer.inc.php"); ?>
  </body>
</html>
