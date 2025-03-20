<?php

require_once './models/products/Product.php';
include_once './controllers/Controller.php';

class ShopController extends Controller
{
    
    
    public function index()
    {
        if (isset($_SESSION['user']['id'])) {
            $wishlistModel = $this->model('wishlist');
            $userWishlist = $wishlistModel->where('user_id', $_SESSION['user']['id']);
            $wishlistId = $userWishlist[0]['id'];
            $wishlistItemsModel = $this->model('wishlistItems');
            $wishlistItems = $wishlistItemsModel->allData($wishlistId);
        }    
        else {
            $wishlistItems = [];
        }


        $search = $_GET['search'] ?? ''; 
        $priceRange = $_GET['priceRange'] ?? null; 
        $duration = $_GET['duration'] ?? null; 
        $powerLevel = $_GET['powerLevel'] ?? null;

        
        $categories = [];
        foreach ($_GET as $key => $value) {
            if (strpos($key, 'category') === 0) { 
                $categories[] = intval($value); 
            }
        }

        
        $query = "SELECT * FROM products WHERE deleted = 0 ";

        if (!empty($search)) {
            
            $query .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
        }
        if ($priceRange !== null) {
            $query .= " AND price <= $priceRange";
        }
        if (!empty($powerLevel)) {
            $query .= " AND power_level = '$powerLevel'";
        }
        if (!empty($categories)) {
            $categories = implode(',', $categories); // Convert array to comma-separated string
            $query .= " AND category_id IN ($categories)";
        }
        if ($duration !== null && $duration !== '0') {
            $query .= " AND duration = $duration";
        }
        
        $productModel = $this->model('product');
        $productCount = $productModel->productCount($query);
        
        
        $limit = 6;
        
        $totalPages = ceil($productCount / $limit);
        
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        $offset = ($currentPage - 1) * $limit;
        $query .= " LIMIT $limit OFFSET $offset";
        
        $product = $this->model('product');        
        $products = $product->query($query);


        $this->render('public.products.shop' , ['products' => $products , 'wishlistItems' => $wishlistItems , 'totalPages' => $totalPages , 'currentPage' => $currentPage]);
    }


}