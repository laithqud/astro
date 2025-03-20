<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/profile.css">
</head>

<body>
    <?php include_once('./views/layout/public/header.php'); ?>

    <div id="container-whole" class="container-fluid d-flex flex-column gap-3 p-5">
        <!-- Profile Info Section -->
        <div id="info" class="div-adjustment p-4">
            <div class="d-flex align-items-center gap-4">
                <img class="info_img" src="/public/images/profile.jpg" alt="">
                <div id="info_details" class="d-flex flex-column justify-content-center">
                    <h2 class="text-font"><?php echo $_SESSION['user']['name'] ?></h2>
                    <p class="text-font"><?php echo $_SESSION['user']['email'] ?></p>
                    <a class="text-decoration-none  rounded-5 mt-1 py-2 px-3 bg-button-a" href="/profile/<?php echo $_SESSION['user']['id'] ?>/edit">Edit Profile</a>
                </div>
            </div>
        </div>

        <div id="orders_history" class="div-adjustment p-4">
            <div class="d-flex flex-column gap-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="text-light">Recent Orders</h2>
                </div>

                <?php if (isset($orders) && !empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <div class="d-flex flex-start align-items-center rounded-3 p-3" style="background-color: #000924;">
                            <div class="d-flex flex-column gap-3 w-100 p-2 m-2 justify-content-around align-items-center">
                                <div class="d-flex w-100 justify-content-between">
                                    <div>
                                        <h5 class="text-light">Order #<?php echo $order['id']; ?></h5>
                                        <p style="color: #7e6bf5;"><?php echo date('F j, Y', strtotime($order['created_at'] ?? '')); ?></p>
                                    </div>
                                    <div>
                                        <p class="text-decoration-none rounded-5 status <?php
                                                                                        switch ($order['status']) {
                                                                                            case 'pending':
                                                                                                echo 'bg-warning';
                                                                                                break;
                                                                                            case 'processing':
                                                                                                echo 'bg-info';
                                                                                                break;
                                                                                            case 'shipped':
                                                                                                echo 'bg-primary';
                                                                                                break;
                                                                                            case 'delivered':
                                                                                                echo 'bg-success';
                                                                                                break;
                                                                                            case 'canceled':
                                                                                                echo 'bg-danger';
                                                                                                break;
                                                                                            default:
                                                                                                echo '';
                                                                                        }
                                                                                        ?>"><?php echo $order['status'] ?? 'Unknown'; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <p class="text-light">
                                        <?php
                                        $itemCount = 0;
                                        if (isset($orderItems[$order['id']]) && is_array($orderItems[$order['id']])) {
                                            $itemCount = count($orderItems[$order['id']]);
                                        }
                                        echo $itemCount . ' items';
                                        ?>
                                    </p>
                                    <p style="color: #7e6bf5;">
                                        $<?php echo number_format($order['total_price'] ?? 0, 2); ?>
                                    </p>
                                </div>

                                <?php if (isset($orderItems[$order['id']]) && is_array($orderItems[$order['id']])): ?>
                                    <div class="w-100">
                                        <?php foreach ($orderItems[$order['id']] as $item): ?>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="/public/images/products/<?php echo $item['product_image']; ?>" alt="<?php echo $item['product_name']; ?>" width="100" style="border-radius: 8px; aspect-ratio: 16/9;">
                                                    <p class="text-light mb-0"><?php echo $item['product_name']; ?></p>
                                                </div>
                                                <div class="d-flex align-items-center gap-3">
                                                    <p class="text-light mb-0">Qty: <?php echo $item['quantity']; ?></p>
                                                    <p class="text-light mb-0">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($order['status'] === 'pending'): ?>
                                    <div class="d-flex justify-content-end w-100">
                                        <form method="post" action="/orders/<?php echo $order['id']; ?>/cancel" style="display: inline;">
                                            <input type="hidden" name="_method" value="put">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelOrderModal" data-order-id="<?php echo $order['id']; ?>">
                                                Cancel Order
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="d-flex justify-content-center align-items-center p-4">
                        <p class="text-light">You have no orders yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #0d162f; color: white;">
                    <div class="modal-header" style="border-bottom: 1px solid #2a3a5c;">
                        <h5 class="modal-title" id="cancelOrderModalLabel">Confirm Cancellation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this order?
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #2a3a5c;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmCancelButton">Yes, Cancel Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('./views/layout/public/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle the modal confirmation
        document.getElementById('cancelOrderModal').addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var orderId = button.getAttribute('data-order-id'); // Extract info from data-* attributes

            // Find the form associated with this order
            var cancelForm = button.closest('form');

            // Handle the confirmation button click
            document.getElementById('confirmCancelButton').onclick = function() {
                cancelForm.submit(); // Submit the form
            };
        });
    </script>

    <script src="/public/js/navbar.js"></script>
</body>

</html>