<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="/public/css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <div class="dashboard">
    <!-- Sidebar -->
    <?php include_once './views/layout/admin/sidebar.php'; ?>

    <!-- Content Area -->
    <div class="content">
      <header>
        <h1>Welcome, Admin <?php if (isset($username) && !empty($username)) echo $username; ?></h1>
        <div class="profile-icon">
          <i class="fas fa-user-circle"></i>
        </div>
      </header>

      <!-- Key Metrics Cards -->
      <div class="metrics">
        <div class="card">
          <h3>Total Sales</h3>
          <p>$12,345</p>
          <i class="fas fa-chart-line"></i>
        </div>
        <div class="card">
          <h3>Users</h3>
          <p>1,234</p>
          <i class="fas fa-users"></i>
        </div