<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Users</title>
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
        <h1>Users</h1>
      </header>

      <!-- Users Table -->
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($users) && !empty($users)): ?>
              <?php foreach ($users as $key => $user) : ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $user['name'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['mobile'] ?></td>
                  <td><?= $user['created_at'] ?></td>
                  <td><?= $user['updated_at'] ?></td>
                  <td>
                    <div class="actions">

                      <!-- Delete Button -->
                      <form id="deleteForm_<?php echo $user['id']; ?>" action="/admin/users/<?php echo $user['id']; ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="delete" title="Delete this user" onclick="showDeleteModal(<?php echo $user['id']; ?>)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                      <!-- Custom Pop-up (Modal) -->
                      <div id="deleteModal_<?php echo $user['id']; ?>" class="modal">
                        <div class="modal-content">
                          <p>Are you sure you want to delete "<?php echo $user['name']; ?>"?</p>
                          <div class="modal-buttons">
                            <button type="button" onclick="confirmDelete(<?php echo $user['id']; ?>)">Sure</button>
                            <button type="button" onclick="closeDeleteModal(<?php echo $user['id']; ?>)">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8">No users found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <button title="Previous page">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button title="Page 1">1</button>
        <button title="Page 2">2</button>
        <button title="Page 3">3</button>
        <button title="Next page">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>


  <script>
    // Show the delete confirmation modal for the selected product
    function showDeleteModal(productId) {
      document.getElementById('deleteModal_' + productId).style.display = 'flex';
    }

    // Close the delete confirmation modal for the selected product
    function closeDeleteModal(productId) {
      document.getElementById('deleteModal_' + productId).style.display = 'none';
    }

    // Confirm deletion and submit the form for the selected product
    function confirmDelete(productId) {
      document.getElementById('deleteForm_' + productId).submit();
    }
  </script>
</body>

</html>