<div class="card" onclick="location.assign('./products/<?php echo $product['id']; ?>')">
    <div class="image_container">
        <img src="/public/images/products/<?php echo $product['image_url']; ?>" alt="" />
        
        <!-- Check if the product is in the wishlist -->
        <?php
        $isInWishlist = false;
        if (isset($wishlistItems) && is_array($wishlistItems)) {
            foreach ($wishlistItems as $wishlistItem) {
                if ($wishlistItem['product_id'] === $product['id']) {
                    $isInWishlist = true;
                    break;
                }
            }
        }
        ?>
        
        <form method="POST" action="/wishlist/add/<?php echo $product['id']; ?>" class="love-icon">
            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                <!-- Use fas fa-heart if the product is in the wishlist, otherwise use far fa-heart -->
                <i class="<?php echo $isInWishlist ? 'fas' : 'far'; ?> fa-heart" style="color:rgb(160, 0, 0); font-size: 20px;"></i>
            </button>
        </form>
    </div>
    <div class="title">
        <span><?php echo $product['name']; ?></span>
    </div>
    <div class="description">
        <?php echo $product['description']; ?>
    </div>
    <div class="action">
        <div class="price">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-baseline">
                    <path d="M4 20h16"/>
                    <path d="m6 16 6-12 6 12"/>
                    <path d="M8 12h8"/>
                </svg>
                <?php echo $product['price']; ?>
            </span>
        </div>
        <form class="add-cart-form" id="add-cart-form-<?php echo $product['id']; ?>" action="/cart/add/<?php echo $product['id']; ?>" method="POST">
            <button type="submit" class="cart-button">
                <svg class="cart-icon" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
                <span>Add to Cart</span>
            </button>
        </form>
    </div>
</div>