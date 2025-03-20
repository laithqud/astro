<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit User</title>
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
        <h1>Edit User #<?php echo $id; ?> </h1>
      </header>

      <!-- Edit User Form -->
      <form class="edit-form">
        <div class="input-group">
          <label for="name"><i class="fas fa-user"></i> Name</label>
          <input type="text" id="name" value="John Doe" required />
        </div>
        <div class="input-group">
          <label for="email"><i class="fas fa-envelope"></i> Email</label>
          <input type="email" id="email" value="john@example.com" required />
        </div>
        <div class="input-group">
          <label for="role"><i class="fas fa-user-tag"></i> Role</label>
          <select id="role">
            <option value="Customer">Customer</option>
            <option value="Admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="save-button">Save Changes</button>
      </form>
    </div>
  </div>
</body>

</html>