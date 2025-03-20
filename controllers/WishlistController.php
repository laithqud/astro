<?php

require_once './models/products/Product.php';
include_once './controllers/Controller.php';
class WishlistController extends Controller
{
    public function index()
    {
        
        if (!isset($_SESSION['user']['id'])) {
            $this->redirect('/auth/login');
        }
        
        $wishlistModel = $this->model('wishlist');
        $userWishlist = $wishlistModel->where('user_id', $_SESSION['user']['id']);
        $wishlistId = $userWishlist[0]['id'];
        $wishlistItemsModel = $this->model('wishlistItems');
        $wishlistItems = $wishlistItemsModel->allData($wishlistId);
        $this->render('public.wishlist.index' , ['wishlistItems' => $wishlistItems]);
    }
    
    
    
    public function add($id)
{
    // Check if the user is logged in
    if (!isset($_SESSION['user']['id'])) {
        $_SESSION['flash_error'] = 'User not logged in';
        $this->redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    // Fetch the product
    $productModel = $this->model('product');
    $product = $productModel->query('SELECT * FROM products WHERE id = ?', [$id]);

    // Check if the product exists
    if (!$product || count($product) === 0) {
        $_SESSION['flash_error'] = 'Product not found';
        $this->redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    $product = $product[0]; // Access the first row

    // Fetch the user's wishlist
    $wishlistModel = $this->model('wishlist');
    $userWishlist = $wishlistModel->query('SELECT * FROM wishlists WHERE user_id = ?', [$_SESSION['user']['id']]);

    // Check if the user has a wishlist
    if ($userWishlist && count($userWishlist) > 0) {
        $userWishlistId = $userWishlist[0]['id']; // Access the first row
    } else {
        // Create a new wishlist for the user
        $userWishlistId = $wishlistModel->create([
            'user_id' => $_SESSION['user']['id']
        ]);
    }

    // Fetch the wishlist items model
    $wishlistItemsModel = $this->model('wishlistItems');

    // Check if the product already exists in the wishlist
    $wishlistItem = $wishlistItemsModel->query('SELECT * FROM wishlist_items WHERE wishlist_id = ? AND product_id = ?', [$userWishlistId, $id]);

    if ($wishlistItem && count($wishlistItem) > 0) {
        // Remove the product from the wishlist
        $wishlistItemsModel->deleteItem('DELETE FROM wishlist_items WHERE wishlist_id = ? AND product_id = ?', [$userWishlistId, $id]);

        $_SESSION['flash_success'] = 'Product removed from wishlist successfully';
        
        $wishlistItemsModel = $this->model('wishlistItems');
        $count = $wishlistItemsModel->wishlistCount($_SESSION['user']['id']);
        $_SESSION['wishlistCount'] = $count;
    } else {
        // Add the product to the wishlist
        $wishlistItemsModel->create([
            'wishlist_id' => $userWishlistId,
            'product_id' => $id
        ]);

        $_SESSION['flash_success'] = 'Product added to wishlist successfully';
        $wishlistItemsModel = $this->model('wishlistItems');
        $count = $wishlistItemsModel->wishlistCount($_SESSION['user']['id']);
        $_SESSION['wishlistCount'] = $count;
    }

    // Update the wishlist count in the session
    $count = $wishlistItemsModel->wishlistCount($_SESSION['user']['id']);
    $_SESSION['wishlistCount'] = $count;

    $this->redirect($_SERVER['HTTP_REFERER']);
    exit;
}


}