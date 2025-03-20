<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Admin</title>
  <link rel="stylesheet" href="/public/css/admin.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
  <div class="dashboard">

    <!-- Sidebar -->
    <?php include_once './views/layout/admin/sidebar.php'; ?>

    <!-- Content Area -->
    <div class="content">
      <header>
        <h1>Add Admin</h1>
      </header>

      <!-- Add Admin Form -->
      <form class="add-form" action="/admin/admins/create" method="post">

        <?php if (isset($errors) && !empty($errors)): ?>
          <ul>
            <?php foreach ($errors as $errorGroup): ?>
              <?php foreach ($errorGroup as $error): ?>
                <li style="color:red"><?php echo $error; ?></li>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>



        <?php if (isset($emailError) && !empty($emailError)): ?>
          <p style="color:red"><?php echo $emailError; ?></p>
        <?php endif; ?>
        <?php if (isset($mobileError) && !empty($mobileError)): ?>
          <p style="color:red"><?php echo $mobileError; ?></p>
        <?php endif; ?>



        <div class="input-group">
          <label for="username"><i class="fas fa-user"></i> Username</label>
          <input
            type="text"
            id="username"
            name="username"
            value="<?php if (isset($values) && !empty($values)) echo $values['username']; ?>"
            placeholder="Enter admin username"
            required />
        </div>
        <div class="input-group">
          <label for="email"><i class="fas fa-envelope"></i> Email</label>
          <input
            type="email"
            id="email"
            name="email"
            value="<?php if (isset($values) && !empty($values)) echo $values['email']; ?>"
            placeholder="Enter admin email"
            required />
        </div>
        <div class="input-group">
          <label for="mobile"><i class="fas fa-phone"></i> Mobile</label>
          <input
            type="text"
            id="mobile"
            name="mobile"
            value="<?php if (isset($values) && !empty($values)) echo $values['mobile']; ?>"
            placeholder="Enter admin mobile"
            required />
        </div>
        <div class="input-group">
          <label for="role"><i class="fas fa-user-tag"></i> Role</label>
          <select id="role" name="role" required>
            <option value="">Select role</option>
            <option <?php if (isset($values) && $values['role'] === 'Admin') echo 'selected'; ?> value="Admin">Admin</option>
            <option <?php if (isset($values) && $values['role'] === 'Super Admin') echo 'selected'; ?> value="Super Admin">Super Admin</option>
          </select>
        </div>
        <div class="input-group">
          <label for="password"><i class="fas fa-lock"></i> Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter password"
            required />
        </div>
        <div class="input-group">
          <label for="confirm-password"><i class="fas fa-lock"></i> Confirm Password</label>
          <input
            type="password"
            id="confirm-password"
            name="confirm-password"
            placeholder="Enter confirm password"
            required />
        </div>
        <button type="submit" class="save-button">Add Admin</button>
      </form>
    </div>
  </div>
</body>

</html>