<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class Order extends Model
{
    public function __construct()
    {
        parent::__construct('orders');
    }
    
    public function getLastInsertId() { 
        $lastId = $this->query("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
        return $lastId[0]['id'];

    }

}
