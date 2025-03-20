<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Testimonials</title>
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
        <h1>Testimonials</h1>

      </header>

      <!-- Testimonials Table -->
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Message</th>
              <th>Accepted</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($testimonials) && !empty($testimonials)): ?>
              <?php foreach ($testimonials as $key => $testimonial): ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $testimonial['name'] ?></td>
                  <td><?= $testimonial['message'] ?></td>
                  <td>
                    <p class="status-<?= strtolower($testimonial['status'] ?? 'pending') ?>">
                      <?= $testimonial['status'] ?? 'Pending' ?>
                    </p>
                  </td>
                  <td>
                    <div class="actions">
                      <!-- Accept Button -->
                      <form id="acceptForm_<?php echo $testimonial['id']; ?>" action="/admin/testimonials/<?php echo $testimonial['id']; ?>/accept" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="accept" title="Accept this testimonial">
                          <i class="fas fa-check"></i>
                        </button>
                      </form>

                      <!-- Reject Button -->
                      <form id="rejectForm_<?php echo $testimonial['id']; ?>" action="/admin/testimonials/<?php echo $testimonial['id']; ?>/reject" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="reject" title="Reject this testimonial">
                          <i class="fas fa-times"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No testimonials found.</td>
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
</body>

</html>