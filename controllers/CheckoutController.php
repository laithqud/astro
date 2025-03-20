<?php

require_once './models/products/Product.php';
include_once './controllers/Controller.php';
class CheckoutController extends Controller
{
    
    

    
    public function checkout()
    {
        $cartModel = $this->model('cart');
        $userCart = $cartModel->where('user_id', $_SESSION['user']['id']);
        $cartId = $userCart[0]['id'];
        $cartItemsModel = $this->model('cartItems');
        $cartItems = $cartItemsModel->allData($cartId);
        
        if (empty($cartItems)) {
            $this->redirect('/cart');
        }
        
        $this->render('public.cart.checkout' , [ 'cartItems' => $cartItems ]); 
    }
    
    
    public function complete()
    {
        $name = $_POST['name'] ?? null;
        $planet_galaxy = $_POST['planet_galaxy'] ?? null;
        $dimension_code = $_POST['dimension_code'] ?? null;
        $cosmic_address = $_POST['cosmic_address'] ?? null;
        $total = $_POST['total'] ?? null;
    
        $cartModel = $this->model('cart');
        $userCart = $cartModel->where('user_id', $_SESSION['user']['id']);
        $cartId = $userCart[0]['id'];
        $cartItemsModel = $this->model('cartItems');
        $cartItems = $cartItemsModel->allData($cartId);

        if (empty($cartItems)) {
            $this->redirect('/cart');
        }
        
        $orderModel = $this->model('order');
        $orderModel->create(
            [
                'user_id' => $_SESSION['user']['id'],
                'status' => 'pending',
                'total_price' => $total,
                'shipping_address' => $planet_galaxy . ' | ' . $cosmic_address . ' | ' . $dimension_code,
            ]
        );
    
        $orderId = $orderModel->getLastInsertId(); // Assuming you have a method like this in your model
    
        
        foreach ($cartItems as $item) {
            $orderItemsModel = $this->model('orderItems');
            $orderItemsModel->create(
                [
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]
            );
        }
    
        foreach ($cartItems as $item) {
            $cartItemsModel->delete($item['id']);
        }
        
        $_SESSION['cartCount'] = 0;
    
        $this->render('public.cart.complete' , 
                        ['shipping_address' => ($planet_galaxy . ' | ' . $cosmic_address . ' | ' . $dimension_code) ,
                        'name' => $name,
                        'order_id' => $orderId ,
                        'date' => date('Y-m-d'),]);
    }

}