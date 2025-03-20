<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmic Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="/public/css/style.css">

    <link rel="stylesheet" href="/public/css/wishlist.css">

</head>

<body>
    <?php include_once('./views/layout/public/header.php'); ?>

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

    <?php if (isset($wishlistItems) && count($wishlistItems) > 0) : ?>
        <div class="container wishlist-container">
            <h2 class="text-center">Your Cosmic Wishlist</h2>
            <p class="text-center"><?php echo count($wishlistItems); ?> items in your wishlist</p>
            <div class="container row justify-content-around  gap-5 flex-wrap">
                <?php foreach ($wishlistItems as $item) : ?>
                    <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"> -->
                    <div class="mx-2 card" onclick="location.assign('./products/<?php echo $item['id']; ?>')">
                        <div class="image_container">
                            <img src="/public/images/products/<?php echo $item['product_image']; ?>" alt="" />
                            <form method="POST" action="/wishlist/add/<?php echo $item['product_id']; ?>" class="love-icon">
                                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <i class="fas fa-heart" style="color:rgb(160, 0, 0); font-size: 20px;"></i>
                                </button>
                            </form>
                        </div>
                        <div class="title">
                            <span><?php echo $item['name']; ?></span>
                        </div>
                        <div class="description">
                            <?php echo $item['description']; ?>
                        </div>
                        <div class="action">
                            <div class="price">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-baseline">
                                        <path d="M4 20h16" />
                                        <path d="m6 16 6-12 6 12" />
                                        <path d="M8 12h8" />
                                    </svg> <?php echo $item['price']; ?></span>
                            </div>
                            <form class="add-cart-form" id="add-cart-form-<?php echo $item['id']; ?>" action="/cart/add/<?php echo $item['id']; ?>" method="POST">
                                <button type="submit" class="cart-button">
                                    <svg class="cart-icon" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linejoin="round" stroke-linecap="round"></path>
                                    </svg>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                        </div>
                        <!-- </div> -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="container wishlist-container">
            <h2 class="text-center">Your Cosmic Wishlist</h2>
            <p class="text-center">Your wishlist is empty.</p>
        </div>
    <?php endif; ?>

    <?php include_once('./views/layout/public/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/navbar.js"></script>
</body>

</html>