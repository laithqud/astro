<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class CartItems  extends Model
{
    public function __construct()
    {
        parent::__construct('cart_items');
    }
    
    public function allData($cartId)
    {
        $sql = "SELECT cart_items.*, products.name as name , products.image_url as product_image ,
            products.price as price , products.description as description FROM cart_items 
            INNER JOIN products ON cart_items.product_id = products.id 
            where cart_items.cart_id = ?
            ORDER BY cart_items.id DESC";
            return $this->query($sql , [$cartId]);
        
    }
    
    public function cartCount($userId) {
        $sql = "SELECT COUNT(*) as count FROM cart_items 
        INNER JOIN carts ON cart_items.cart_id = carts.id 
        WHERE carts.user_id = ?";
        $count = $this->query($sql , [$userId]);
        return $count[0]['count'];
    }
    
}
