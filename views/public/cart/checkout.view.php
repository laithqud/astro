<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="public/css/checkout.css">

    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/variables.css">

</head>

<body>


    <?php include_once('./views/layout/public/header.php'); ?>

    <!-- <?php if (isset($cartItems) && count($cartItems) > 0) {
                var_dump($cartItems);
            } ?> -->

    <form method="post" action="/checkout/complete" class="checkout container py-5">
        <h3 class="text-center"> Star Dust Elixirs</h3>
        <div class="row g-4 reverse">
            <div class="col-md-8">
                <div class="card p-4 mb-4">
                    <h5>Shipping Details</h5>
                    <div class="row g-3">
                        <div class="col-12"><input type="text" name="name" class="form-control" placeholder="Name" required></div>
                        <div class="col-md-6"><input type="text" name="planet_galaxy" class="form-control" placeholder="Planet/Galaxy" required></div>
                        <div class="col-md-6"><input type="text" name="dimension_code" class="form-control" placeholder="Dimension Code" required></div>
                        <div class="col-12"><input type="text" name="cosmic_address" class="form-control" placeholder="Cosmic Address" required></div>
                    </div>
                </div>

                <div class="card p-4">
                    <h5>Payment Method</h5>
                    <div class="form-check">
                        <input checked class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery">
                        <label class="form-check-label" for="cash_on_delivery">
                            Cash on Delivery
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                        <label class="form-check-label" for="card">
                            Pay by Card
                        </label>
                    </div>

                    <div id="card-details">
                        <input type="text" name="card_number" class="form-control mb-2 mt-3" placeholder="Card Number">
                        <div class="row g-2">
                            <div class="col-md-6"><input type="text" name="expiry_date" class="form-control" placeholder="MM/YY"></div>
                            <div class="col-md-6"><input type="text" name="cvc" class="form-control" placeholder="CVC"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn login-btn btn-primary w-100 mt-3"> Confirm Order</button>
            </div>

            <div class="col-md-4">
                <div class="card p-4">
                    <h5>Order Summary</h5>
                    <?php
                    $total = 0;
                    if (isset($cartItems) && count($cartItems) > 0) {
                        foreach ($cartItems as $item) {
                            $total += $item['price'] * $item['quantity'];
                            echo '<p>' . $item['name'] . ' x ' . $item['quantity'] . '<span class="float-end">' . $item['price'] * $item['quantity'] . ' Astro</span></p>';
                        }
                    }
                    ?>
                    <hr style="color: #8e54d9;">
                    <p>Subtotal <span class="float-end"><?php echo $total; ?> Astro</span></p>
                    <p>Interstellar Shipping <span class="float-end">500 Astro</span></p>
                    <?php $tax = (int)($total * 0.16); ?>
                    <p>Tax (16%) <span class="float-end"><?php echo $tax; ?> Astro</span></p>
                    <h5>Total <span class="float-end"><?php echo $total + 500 + $tax; ?> Astro</span></h5>
                    <?php $total = $total + 500 + $tax; ?>
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                </div>
            </div>
        </div>
    </form>

    <?php include_once('./views/layout/public/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/navbar.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardDetails = document.getElementById('card-details');
            const cardRadio = document.getElementById('card');
            const cashRadio = document.getElementById('cash_on_delivery');

            function toggleCardDetails() {
                if (cardRadio.checked) {
                    cardDetails.style.display = 'block';
                } else {
                    cardDetails.style.display = 'none';
                }
            }

            cardRadio.addEventListener('change', toggleCardDetails);
            cashRadio.addEventListener('change', toggleCardDetails);

            // Initialize on page load
            toggleCardDetails();
        });
    </script>


</body>

</html>