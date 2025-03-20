<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class OrderItems extends Model
{
    public function __construct()
    {
        parent::__construct('order_items');
    }
    
    public function allData($orderId)
    {
        $sql = "SELECT order_items.*, products.name as product_name, products.image_url as product_image 
                FROM order_items 
                INNER JOIN products ON order_items.product_id = products.id 
                WHERE order_items.order_id = ?";
        $orderItems = $this->query($sql, [$orderId]);
        return $orderItems;
    }
}
    
