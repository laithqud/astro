<?php


require_once './models/products/Product.php';
include_once './controllers/Controller.php';

class HomeController extends Controller
{
  

    public function bestSellers()
    {
        $product = $this->model('product');
        $bestSellers = $product->ten();
        return $bestSellers;
    }
    
    public function newArrivals()
    {
        $productModel = new Product();
        $newArrivals = $productModel->lastTen();
        
        return $newArrivals;
    }
    
    
    public function index()
    {
     
        $wishlistItems = null;
        if (isset($_SESSION['user']['id'])) {
            $wishlistModel = $this->model('wishlist');
            $userWishlist = $wishlistModel->where('user_id', $_SESSION['user']['id']);
            if (isset($userWishlist[0]['id'])) {
                $wishlistId = $userWishlist[0]['id'];
                $wishlistItemsModel = $this->model('wishlistItems');
                $wishlistItems = $wishlistItemsModel->allData($wishlistId);
            }
        }
        
        $testimonials = $this->model('testimonial')->where('status' , 'accepted');

        
        $bestSellers = $this->bestSellers();
        $newArrivals = $this->newArrivals();
        // require_once './views/home/index.view.php';
        $this->render('public.pages.home', ['bestSellers' => $bestSellers , 'newArrivals' => $newArrivals , 'wishlistItems' => $wishlistItems , 'testimonials' => $testimonials]);
    }

}
