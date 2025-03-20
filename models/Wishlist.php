<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class Wishlist  extends Model
{
    public function __construct()
    {
        parent::__construct('wishlists');
    }
    
}
