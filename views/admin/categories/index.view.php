<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categories</title>
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
        <h1>Categories</h1>
        <button class="add-product" title="Add a new product">
          <a href="/admin/categories/create" class="add-product-link"><i class="fas fa-plus"></i> Add Category</a>
        </button>
      </header>

      <!-- Categories Table -->
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($categories) && !empty($categories)): ?>
              <?php foreach ($categories as $key => $category): ?>
                <tr>
                  <td><?php echo $key + 1; ?></td>
                  <td><?php echo $category['name']; ?></td>
                  <td><?php echo $category['created_at']; ?></td>
                  <td><?php echo $category['updated_at']; ?></td>
                  <td>
                    <div class="actions">
                      <button class="edit" title="Edit this product">
                        <a href="/admin/categories/<?php echo $category['id']; ?>/edit" title="Edit this category">
                          <i class="fas fa-edit"></i>
                        </a>
                      </button>

                      <!-- Delete Button -->
                      <form id="deleteForm_<?php echo $category['id']; ?>" action="/admin/categories/<?php echo $category['id']; ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="delete" title="Delete this category" onclick="showDeleteModal(<?php echo $category['id']; ?>)">
                          <i class="fas fa-trash"></i>
                        </button>
                        <!-- Custom Pop-up (Modal) -->
                        <div id="deleteModal_<?php echo $category['id']; ?>" class="modal">
                          <div class="modal-content">
                            <p>Are you sure you want to delete <?= $category['name']; ?>?</p>
                            <div class="modal-buttons">
                              <button type="submit" onclick="confirmDelete(<?php echo $category['id']; ?>)">Sure</button>
                              <button type="button" onclick="closeDeleteModal(<?php echo $category['id']; ?>)">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="12">No categories available.</td>
              </tr>
            <?php endif; ?>

            <!-- Add more rows as needed -->
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
    // Show the delete confirmation modal for the selected category
    function showDeleteModal(categoryId) {
      document.getElementById('deleteModal_' + categoryId).style.display = 'flex';
    }

    // Close the delete confirmation modal for the selected category
    function closeDeleteModal(categoryId) {
      document.getElementById('deleteModal_' + categoryId).style.display = 'none';
    }

    // Confirm deletion and submit the form for the selected category
    function confirmDelete(categoryId) {
      document.getElementById('deleteForm_' + categoryId).submit();
    }
  </script>

</body>

</html>