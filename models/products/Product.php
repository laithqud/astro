<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class Product  extends Model
{
    private $conn;

    public function __construct()
    {
        // $this->conn = Database::getInstance()->getConnection();
        parent::__construct('products');
    }
    
    
    
    public function allData()
    {
            $sql = "SELECT products.*, categories.name as category FROM products 
                INNER JOIN categories ON products.category_id = categories.id 
                WHERE products.deleted = 0
                ORDER BY products.id DESC";
        return $this->query($sql); 

    }
    
    public function getCategories()
    {
        return $this->query("SELECT * FROM categories ");
    }
    
    public function softDelete($id)
    {
        return $this->update($id, 
        ['deleted' => 1 ]);
    }
    
    
    
    
    public function ten()
    {
        return $this->query("SELECT * FROM products WHERE deleted = 0 LIMIT 10 ");
    }
    
    public function lastTen()
    {
        return $this->query("SELECT * FROM products WHERE deleted = 0 ORDER BY id DESC LIMIT 10");
    }
    
    public function item($id)
    {
        
        $sql = "SELECT products.* , categories.name as category FROM products 
                INNER JOIN categories ON products.category_id = categories.id
                WHERE products.id = ?";
        $params = [$id];
        $product = $this->query($sql, $params);
        return $product;
    }
    
    public function productCount($query)
    {
        $countQuery = "SELECT COUNT(*) FROM ($query) AS subquery";
        $result = $this->query($countQuery);
        return $result[0]['COUNT(*)'] ?? 0;
    }

    
}
