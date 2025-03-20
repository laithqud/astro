<?php

include_once './controllers/Controller.php';

class AuthController extends Controller
{
    public function registerPage()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->render('public.auth.register');
    }

    public function loginPage()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->render('public.auth.login');
    }

    public function register()
    {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $mobile = $_POST['mobile'] ?? null;
        $dob = $_POST['dob'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirm_password = $_POST['confirm_password'] ?? null;

        $user = $this->model('user');
        $userEmail = $user->findByEmail($email);

        if (!empty($userEmail)) {
            $this->render('public.auth.register', ['emailError' => 'Email Already Exist' , 'values' => $_POST ]);
            exit;
        }

        $userMobile = $user->findByMobile($mobile);

        if(!empty($userMobile)) {
            $this->render('public.auth.register', ['mobileError' => 'Mobile Already Exist' , 'values' => $_POST ]);
            exit;
        }

        
        $errors = $this->validate([
            'name' => 'required|min:3|alphaSpace',
            'email' => 'required|email',
            'mobile' => 'required|numeric|min:10',
            'dob' => 'required|date|date_before:2007-12-31|date_after:1900-01-01',
            'password' => 'required|password',
            'confirm_password' => 'required|match:password'
        ]);


        if (!empty($errors)) {
            $this->render('public.auth.register', ['errors' => $errors , 'values' => $_POST ]);
            exit;
        }


        $user->create([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'date_of_birth' => $dob,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        
        
        $userInfo = $user->findByEmail($email);
        $userId = $userInfo[0]['id'];
        
        $cart = $this->model('cart');
        $wishlist = $this->model('wishlist');
        
        $wishlist->create([
            'user_id' => $userId
        ]);
        $cart->create([
            'user_id' => $userId
        ]);

        $_SESSION['success_message'] = 'Registration successful! Redirecting to login...';

        // Render a temporary view to show the pop-up
        $this->render('public.auth.register_success');
    }

    public function login()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $user = $this->model('user');
        $user = $user->findByEmailLogin($email);

        if (empty($user)) {
            $this->render('public.auth.login', ['emailError' => 'Invalid email']);
            exit;
        } 
        
        if (!password_verify($password, $user[0]['password']) ) {
            $this->render('public.auth.login', ['passwordError' => 'Invalid password']);
            exit;
        }

        $userData = 
        [
            'id' => $user[0]['id'],
            'name' => $user[0]['name'],
            'email' => $user[0]['email'],
            
        ] ;
        
        
        $cartItemsModel = $this->model('cartItems');
        $count = $cartItemsModel->cartCount($user[0]['id']);
        $_SESSION['cartCount'] = $count;

        $wishlistItemsModel = $this->model('wishlistItems');
        $wishlistCount = $wishlistItemsModel->wishlistCount($user[0]['id']);
        $_SESSION['wishlistCount'] = $wishlistCount;
        
        
        $_SESSION['user'] = $userData;



        $this->redirect('/');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['cartCount']);
        unset($_SESSION['wishlistCount']);
        $this->redirect('/');
    }
    
    
    public function registerSuccess()
    {
        $this->render('public.auth.register_success');
    }

}