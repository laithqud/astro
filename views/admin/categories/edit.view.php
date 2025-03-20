<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Category</title>
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
        <h1>Edit Category <?php echo '#' . $id; ?></h1>
      </header>

      <!-- Edit Category Form -->
      <form class="edit-form" action="/admin/categories/<?php echo $id; ?>/edit" method="POST">


        <?php
        if (isset($errors) && !empty($errors)) {
          foreach ($errors as $error) {
            echo '<li style="color:red">' . $error[0] . '</li> <br>';
          }
        }
        ?>

        <input type="hidden" name="_method" value="PUT" />
        <div class="input-group">
          <label for="name"><i class="fas fa-list"></i> Name</label>
          <input type="text" id="name" name="name" value="<?php if (isset($category) && !empty($category)) echo $category[0]['name']; ?>" required />
        </div>
        <button type="submit" class="save-button">Save Changes</button>
      </form>
    </div>
  </div>
</body>

</html>