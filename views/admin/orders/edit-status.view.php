<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Order</title>
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
        <h1>Edit Order #<?php echo $id; ?> Status</h1>
      </header>

      <!-- Edit Order Form -->
      <form class="edit-form" action="/admin/orders/<?php echo $id; ?>/edit" method="POST">
        <div class="input-group">
          <label for="status"><i class="fas fa-tasks"></i> Status</label>
          <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
            <option value="canceled">Canceled</option>
          </select>
        </div>
        <button type="submit" class="save-button">Save Changes</button>
      </form>
    </div>
  </div>
</body>

</html>