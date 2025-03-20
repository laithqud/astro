<?php

include_once './models/products/Product.php';
include_once './controllers/Controller.php';
class ProductController extends Controller
{
    public function item($id)
    {
        $product = $this->model('product');
        $product = $product->item($id)[0];
        $this->render('public.products.item', ['product' => $product]);
    }
}