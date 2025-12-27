

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <?php include_once("nav.inc.php"); ?>
    <section class="auth-section">
      <div class="auth-container">
        <div class="auth-box">
          <h1>Welcome Back</h1>
          <p class="auth-subtitle">Login to your account</p>

          <form action="login_process.php" method="POST" class="auth-form">
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

            <button type="submit" class="auth-btn">Login</button>

            <p class="auth-switch">
              Don't have an account? <a href="register.html">Create one</a>
            </p>
          </form>
        </div>
      </div>
    </section>
    <?php include_once("footer.inc.php"); ?>
  </body>
</html>
