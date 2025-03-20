<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Category</title>
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
        <h1>Add Category</h1>
      </header>

      <!-- Add Category Form -->
      <form class="add-form" action="/admin/categories/create" method="POST">

        <?php
        if (isset($errors) && !empty($errors)) {
          foreach ($errors as $error) {
            echo '<li style="color:red">' . $error[0] . '</li> <br>';
          }
        }
        ?>

        <div class="input-group">
          <label for="name"><i class="fas fa-list"></i> Category Name</label>
          <input
            type="text"
            id="name"
            name="name"
            value="<?php if (isset($name) && !empty($name)) echo $name; ?>"
            placeholder="Enter category name"
            required />
        </div>
        <button type="submit" class="save-button">Add Category</button>
      </form>
    </div>
  </div>
</body>

</html>