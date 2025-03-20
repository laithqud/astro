<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orders</title>
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
        <h1>Orders</h1>
        <!-- <button class="add-order" title="Add a new order">
            <i class="fas fa-plus"></i> Add Order
          </button> -->
      </header>

      <?php if (isset($orders) && count($orders) > 0): ?>

        <!-- Orders Table -->
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Order No.</th>
                <th>Date</th>
                <th>Total</th>
                <th>Shipping Address</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $key => $order): ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= '#' . date('Y', strtotime($order['order_date'])) . 'X-' . $order['id'] ?? 'Not set' ?></td>
                  <td><?= $order['order_date'] ?? 'Not set' ?></td>
                  <td><?= $order['total_price'] ?? 'Not set' ?></td>
                  <td><?= $order['shipping_address'] ?? 'Not set' ?></td>
                  <td>
                    <p class="status-<?= strtolower($order['status'] ?? 'not-set') ?>">
                      <?= $order['status'] ?? 'Not set' ?>
                    </p>
                  </td>
                  <td>
                    <button class="edit" title="Edit this product">
                      <a href="/admin/orders/<?php echo $order['id']; ?>/edit" title="Edit this order">
                        <i class="fas fa-edit"></i>
                      </a>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <p>There are no orders yet.</p>
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
</body>

</html>