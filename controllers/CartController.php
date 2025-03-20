<?php

require_once './models/products/Product.php';
include_once './controllers/Controller.php';
class CartController extends Controller
{
    public function index()
    {
        
        if (!isset($_SESSION['user']['id'])) {
            $this->redirect('/auth/login');
        }
        
        $cartModel = $this->model('cart');
        $userCart = $cartModel->where('user_id', $_SESSION['user']['id']);
        $cartId = $userCart[0]['id'];
        $cartItemsModel = $this->model('cartItems');
        $cartItems = $cartItemsModel->allData($cartId);
        $this->render('public.cart.show-cart' , ['cartItems' => $cartItems]);
    }
    
    public function add($id)
    {

        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['flash_error'] = 'User not logged in';
            $this->redirect($_SERVER['HTTP_REFERER']);
            // header('Location: /auth/login'); // Redirect to login page
            exit;
        }
    
        // Fetch the product's stock
        $productModel = $this->model('product');
        $product = $productModel->query('SELECT * FROM products WHERE id = ?', [$id]);
    
        // Check if the product exists
        if (!$product || count($product) === 0) {
            $_SESSION['flash_error'] = 'Product not found';
            $this->redirect($_SERVER['HTTP_REFERER']);
                        // header('Location: /products'); 
            exit;
        }
    
        $product = $product[0]; // Access the first row
        $stock = $product['stock']; // Get the available stock
    
        // Check if the product is out of stock
        if ($stock == 0) {
            $_SESSION['flash_error'] = 'Product is out of stock';
            $this->redirect($_SERVER['HTTP_REFERER']);
            // header('Location: /products'); // Redirect to products page
            exit;
        }
    
        // Fetch the user's cart
        $cartModel = $this->model('cart');
        $userCart = $cartModel->query('SELECT * FROM carts WHERE user_id = ?', [$_SESSION['user']['id']]);
    
        // Check if the user has a cart
        if ($userCart && count($userCart) > 0) {
            $userCart = $userCart[0]; // Access the first row
            $userCartId = $userCart['id'];
        } else {
            // Create a new cart for the user
            $userCartId = $cartModel->create([
                'user_id' => $_SESSION['user']['id']
            ]);
        }
    
        // Fetch the cart items model
        $cartItemsModel = $this->model('cartItems');
    
        // Check if the product already exists in the cart
        $cartItem = $cartItemsModel->query('SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?', [$userCartId, $id]);
    
        if ($cartItem && count($cartItem) > 0) {
            $cartItem = $cartItem[0]; // Access the first row
    
            // Check if adding one more item exceeds the stock
            if ($cartItem['quantity'] + 1 > $stock) {
                $_SESSION['flash_error'] = 'Cannot add more items than available stock';
                $this->redirect($_SERVER['HTTP_REFERER']);
                // header('Location: /cart'); // Redirect to cart page
                exit;
            }
    
            // Update the quantity
            $cartItemsModel->update($cartItem['id'], [
                'quantity' => $cartItem['quantity'] + 1
            ]);
    
            $_SESSION['flash_success'] = 'Item added to cart successfully';
            $this->redirect($_SERVER['HTTP_REFERER']);
            // header('Location: /cart'); // Redirect to cart page
            exit;
        } else {
            // Check if adding one item exceeds the stock
            if (1 > $stock) {
                $_SESSION['flash_error'] = 'Cannot add more items than available stock';
                $this->redirect($_SERVER['HTTP_REFERER']);
                // header('Location: /products'); // Redirect to products page
                exit;
            }
    
            // Create a new cart item
            $cartItemsModel->create([
                'cart_id' => $userCartId,
                'product_id' => $id,
                'quantity' => 1
            ]);
    
            $_SESSION['flash_success'] = 'Item added to cart successfully';
            
            $cartItemsModel = $this->model('cartItems');
            $count = $cartItemsModel->cartCount($_SESSION['user']['id']);
            $_SESSION['cartCount'] = $count;
            
            $this->redirect($_SERVER['HTTP_REFERER']);
            // header('Location: /cart'); // Redirect to cart page
            exit;
        }
    }

    public function delete($id)
    {
        $cartItemsModel = $this->model('cartItems');
        $cartItemsModel->delete($id);
        $_SESSION['flash_success'] = 'Item removed from cart successfully';
        $cartItemsModel = $this->model('cartItems');
        $count = $cartItemsModel->cartCount($_SESSION['user']['id']);
        $_SESSION['cartCount'] = $count;
        $this->redirect($_SERVER['HTTP_REFERER']);
        exit;
    }
    public function decrease($id)
    {
        $cartItemsModel = $this->model('cartItems');
        $cartItem= $cartItemsModel->find($id);

        if ($cartItem['quantity'] > 1) {
            $cartItemsModel->update($id, [
                'quantity' => $cartItem['quantity'] - 1
            ]);
            $_SESSION['flash_success'] = 'Item quantity decreased successfully';
            $cartItemsModel = $this->model('cartItems');
            $count = $cartItemsModel->cartCount($_SESSION['user']['id']);
            $_SESSION['cartCount'] = $count;
        } 
        // else {
        //     $cartItemsModel->delete($id);
        //     $_SESSION['flash_success'] = 'Item removed from cart successfully';
        // }
        
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function increase($id)
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['flash_error'] = 'User not logged in';
            $this->redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
    
        // Fetch the cart item
        $cartItemsModel = $this->model('cartItems');
        $cartItem = $cartItemsModel->find($id);
    
        // Check if the cart item exists
        if (!$cartItem) {
            $_SESSION['flash_error'] = 'Cart item not found';
            $this->redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
    
        // Fetch the product's stock
        $productModel = $this->model('product');
        $product = $productModel->query('SELECT * FROM products WHERE id = ?', [$cartItem['product_id']]);
    
        // Check if the product exists
        if (!$product || count($product) === 0) {
            $_SESSION['flash_error'] = 'Product not found';
            $this->redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
    
        $product = $product[0]; // Access the first row
        $stock = $product['stock']; // Get the available stock
    
        // Check if increasing the quantity exceeds the stock
        if ($cartItem['quantity'] + 1 > $stock) {
            $_SESSION['flash_error'] = 'Cannot increase quantity, not enough stock available';
            $this->redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
    
        // Update the quantity
        $cartItemsModel->update($id, [
            'quantity' => $cartItem['quantity'] + 1
        ]);
    
        $_SESSION['flash_success'] = 'Item quantity increased successfully';
        $cartItemsModel = $this->model('cartItems');
        $count = $cartItemsModel->cartCount($_SESSION['user']['id']);
        $_SESSION['cartCount'] = $count;
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

}