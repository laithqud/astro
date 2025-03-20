<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmic Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="public/css/cart.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="stylesheet" href="public/css/global.css">
</head>

<body>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="width: auto; z-index: 1050; transition: transform 0.3s ease; transform: translateY(-50px);">
            <?php echo $_SESSION['flash_error'];
            unset($_SESSION['flash_error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="width: auto; z-index: 1050; transition: transform 0.3s ease; transform: translateY(-50px);">
            <?php echo $_SESSION['flash_success'];
            unset($_SESSION['flash_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <script>
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>

    <?php include_once('./views/layout/public/header.php'); ?>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #0d162f; color: white;">
                <div class="modal-header" style="border-bottom: 1px solid #2a3a5c;">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item from your cart?
                </div>
                <div class="modal-footer" style="border-top: 1px solid #2a3a5c;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container cart-container">
        <h2 class="text-center">Your Cosmic Cart</h2>
        <p class="text-center"><?php echo count($cartItems); ?> items in your cart</p>
        <div class="row">

            <?php foreach ($cartItems as $item) : ?>
                <div class="col-12 mb-4">
                    <div class="card total-box">
                        <div class="row">
                            <div class="col-sm-2 product-image-container">
                                <img src="/public/images/products/<?php echo $item['product_image']; ?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-sm-8 text-white">
                                <h5><?php echo $item['name']; ?></h5>
                                <p><?php echo $item['description']; ?></p>
                                <div class="d-flex quantity align-items-center">
                                    <form method="post" action="/cart/decrease/<?php echo $item['id']; ?>">
                                        <input type="hidden" name="_method" value="PUT">
                                        <button type="submit" class="btn btn-outline-light btn-sm border-0">-</button>
                                    </form>
                                    <input type="text" value="<?php echo $item['quantity']; ?>" class="form-control form-control-sm mx-2 input-design" maxlength="1" disabled>
                                    <form method="post" action="/cart/increase/<?php echo $item['id']; ?>">
                                        <input type="hidden" name="_method" value="PUT">
                                        <button type="submit" class="btn btn-outline-light btn-sm border-0">+</button>
                                    </form>
                                    <div class="d-flex align-items-center ms-2">
                                        <p><?php echo $item['price']; ?> Astro</p>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="/cart/delete/<?php echo $item['id']; ?>" class="col-sm-2 d-flex align-items-center justify-content-end" id="deleteForm-<?php echo $item['id']; ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-item-id="<?php echo $item['id']; ?>">
                                    <i class="fa-solid fa-trash text-white"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        $totalPrice = 0;
        $tax = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $tax += ($item['price'] * $item['quantity']) * 0.16;
        }
        $totalPrice += $tax;
        ?>
        <div class="total-box">
            <p>Subtotal: <span class="float-end"><?php echo number_format($totalPrice - $tax, 0); ?> Astro</span></p>
            <p>Tax: <span class="float-end"><?php echo number_format($tax, 0); ?> Astro</span></p>
            <hr>
            <p>Total: <span class="float-end"><?php echo number_format($totalPrice, 0); ?> Astro</span></p>
            <p class="text-muted">🚀 Estimated Delivery: 7 Days (Standard Shipping)</p>
        </div>

        <form action="/checkout" method="post">
            <button type="submit" class="btn login-btn btn-primary cart-checkout">Proceed to Checkout</button>
        </form>


    </div>

    <?php include_once('./views/layout/public/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/navbar.js"></script>

    <script>
        // JavaScript to handle the modal confirmation
        document.getElementById('deleteConfirmationModal').addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var itemId = button.getAttribute('data-item-id'); // Extract info from data-* attributes
            var deleteForm = document.getElementById('deleteForm-' + itemId);

            document.getElementById('confirmDeleteButton').onclick = function() {
                deleteForm.submit(); // Submit the form
            };
        });
    </script>
</body>

</html>