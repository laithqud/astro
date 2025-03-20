<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class WishlistItems  extends Model
{
    public function __construct()
    {
        parent::__construct('wishlist_items');
    }
    
    public function wishlistCount($userId) {
        $query = 'SELECT COUNT(*) as count FROM wishlist_items 
                JOIN wishlists ON wishlist_items.wishlist_id = wishlists.id 
                WHERE wishlists.user_id = ?';
        $result = $this->query($query, [$userId]);
        return $result[0]['count'];

    }
    
    
    public function allData($wishlistId)
    {
        $sql = "SELECT wishlist_items.*, products.name as name , products.image_url as product_image ,
            products.price as price , products.description as description , products.id as product_id FROM wishlist_items  
            INNER JOIN products ON wishlist_items.product_id = products.id 
            where wishlist_items.wishlist_id = ?
            ORDER BY wishlist_items.id DESC";
            return $this->query($sql , [$wishlistId]);
        
    }
    
    public function deleteItem($query, $params = []) {
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }
}
