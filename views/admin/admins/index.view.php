<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admins</title>
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
        <h1>Admins</h1>
        <button class="add-product" title="Add a new product">
          <a href="/admin/admins/create" class="add-product-link"><i class="fas fa-plus"></i> Add Admin</a>
        </button>
      </header>

      <!-- Admins Table -->
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Role</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($admins) && !empty($admins)): ?>
              <?php foreach ($admins as $key => $admin): ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $admin['username'] ?></td>
                  <td><?= $admin['email'] ?></td>
                  <td><?= $admin['mobile'] ?></td>
                  <td><?= $admin['role'] ?></td>
                  <td><?= $admin['created_at'] ?></td>
                  <td><?= $admin['updated_at'] ?></td>
                  <td>
                    <div class="actions">
                      <button class="edit" title="Edit this admin">
                        <a href="/admin/admins/<?php echo $admin['id']; ?>/edit" title="Edit this admin">
                          <i class="fas fa-edit"></i>
                        </a>
                      </button>

                      <!-- Delete Button -->
                      <form id="deleteForm_<?php echo $admin['id']; ?>" action="/admin/admins/<?php echo $admin['id']; ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="delete" title="Delete this admin" onclick="showDeleteModal(<?php echo $admin['id']; ?>)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                      <!-- Custom Pop-up (Modal) -->
                      <div id="deleteModal_<?php echo $admin['id']; ?>" class="modal">
                        <div class="modal-content">
                          <p>Are you sure you want to delete "<?php echo $admin['username']; ?>"?</p>
                          <div class="modal-buttons">
                            <button type="button" onclick="confirmDelete(<?php echo $admin['id']; ?>)">Sure</button>
                            <button type="button" onclick="closeDeleteModal(<?php echo $admin['id']; ?>)">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8">No admins found.</td>
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