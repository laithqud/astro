<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class Category  extends Model
{

    public function __construct()
    {
        parent::__construct('categories');
    }
    
    public function getCategories()
    {
        return $this->query("SELECT * FROM categories WHERE deleted = 0");
    }
    
    public function findCategory($id)
    {
        return $this->query("SELECT * FROM categories WHERE id = ?", [$id]);
    }

    public function updateCategory($id, $name)
    {
        return $this->query("UPDATE categories SET name = ? WHERE id = ?", [$name, $id]);
    }

    public function addCategory($name)
    {
        return $this->query("INSERT INTO categories (name) VALUES (?)", [$name]);
    }

    public function softDelete($id)
    {
        return $this->update($id, ['deleted' => 1 ]);
        // return $this->query("UPDATE categories SET deleted = 1 WHERE id = (?)", [$id]);
    }
    public function getProductByCategory(){
        return $this->query("SELECT * FROM products WHERE category_id = ?", [$_POST['category_id']]);
    }

}
