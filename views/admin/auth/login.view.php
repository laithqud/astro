<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="/public/css/admin.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <img src="/public/images/logo.png" alt="Logo" width="200px" class="login-logo" />
        <h2>Admin Dashboard</h2>
        <p>Please log in to access the admin panel</p>
      </div>
      <form class="login-form" action="/admin" method="post">
        <div class="input-group">
          <label for="email"><i class="fas fa-envelope"></i> Admin Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your admin email"
            required />
          <?php if (isset($emailError)): ?>
            <span style="color: red;"><?= $emailError; ?></span>
          <?php endif; ?>
        </div>
        <div class="input-group">
          <label for="password"><i class="fas fa-lock"></i> Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter your password"
            required />
          <?php if (isset($passwordError)): ?>
            <span style="color: red;"><?= $passwordError; ?></span>
          <?php endif; ?>
        </div>
        <button type="submit" class="login-button">Log In</button>
      </form>
      <div class="login-footer">
        <p>Contact the system administrator for access.</p>
      </div>
    </div>
  </div>
</body>

</html>