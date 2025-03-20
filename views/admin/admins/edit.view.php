<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Admin</title>
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
        <h1>Edit Admin <?php echo isset($admin) && !empty($admin) ?  $admin['username']  : ''; ?></h1>
      </header>

      <!-- Edit Admin Form -->
      <form class="add-form" action="/admin/admins/<?php echo isset($id) && !empty($id) ? $id : ''; ?>/edit" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?php echo isset($id) && !empty($id) ? $id : ''; ?>">

        <?php if (isset($errors) && !empty($errors) && !isset($errors['password'])) : ?>
          <ul>
            <?php foreach ($errors as $errorGroup): ?>
              <?php foreach ($errorGroup as $error): ?>
                <li style="color:red"><?php echo $error; ?></li>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <div class="input-group">
          <label for="username"><i class="fas fa-user"></i> Username</label>
          <input
            type="text"
            id="username"
            name="username"
            value="<?php if (isset($admin) && !empty($admin)) echo $admin['username']; ?>"
            placeholder="Enter admin username"
            required />
        </div>
        <div class="input-group">
          <label for="email"><i class="fas fa-envelope"></i> Email</label>
          <input
            type="email"
            id="email"
            name="email"
            value="<?php if (isset($admin) && !empty($admin)) echo $admin['email']; ?>"
            placeholder="Enter admin email"
            required />
        </div>
        <div class="input-group">
          <label for="mobile"><i class="fas fa-phone"></i> Mobile</label>
          <input
            type="text"
            id="mobile"
            name="mobile"
            value="<?php if (isset($admin) && !empty($admin)) echo $admin['mobile']; ?>"
            placeholder="Enter admin mobile"
            required />
        </div>
        <div class="input-group">
          <label for="role"><i class="fas fa-user-tag"></i> Role</label>
          <select id="role" name="role" required>
            <option value="">Select role</option>
            <option <?php if (isset($admin) && $admin['role'] === 'Admin') echo 'selected'; ?> value="Admin">Admin</option>
            <option <?php if (isset($admin) && $admin['role'] === 'Super Admin') echo 'selected'; ?> value="Super Admin">Super Admin</option>
          </select>
        </div>
        <!-- <div class="input-group">
            <label for="password"><i class="fas fa-lock"></i> Password <span style="color:red"> (keep empty if you don't want to change password)</span></label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter password"

            />
          </div>
          <div class="input-group">
            <label for="confirm-password"><i class="fas fa-lock"></i> Confirm Password</label>
            <input
              type="password"
              id="confirm-password"
              name="confirm-password"
              placeholder="Enter confirm password"

            />
          </div> -->
        <button type="submit" class="save-button">Edit Admin</button>
      </form>
      <br> <br>
      <form class="add-form" action="/admin/admins/<?php echo isset($id) && !empty($id) ? $id : ''; ?>/edit/password" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?php echo isset($id) && !empty($id) ? $id : ''; ?>">
        <h2>Change Password</h2>

        <?php if (isset($errors['password']) && !empty($errors['password'])): ?>
          <ul>
            <?php foreach ($errors as $errorGroup): ?>
              <?php foreach ($errorGroup as $error): ?>
                <li style="color:red"><?php echo $error; ?></li>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <div class="input-group">
          <label for="password"><i class="fas fa-lock"></i> New Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter new password"
            required />
        </div>
        <div class="input-group">
          <label for="confirm-password"><i class="fas fa-lock"></i> Confirm New Password</label>
          <input
            type="password"
            id="confirm-password"
            name="confirm-password"
            placeholder="Enter confirm new password"
            required />
        </div>
        <button type="submit" class="save-button">Change Password</button>
      </form>
    </div>
  </div>
</body>

</html>