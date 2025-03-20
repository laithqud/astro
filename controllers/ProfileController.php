<?php

include_once './controllers/Controller.php';
include_once './models/User.php';

class ProfileController extends Controller
{
    public function index($id)
{
    // Check if the user is logged in and matches the requested profile
    if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id) {
        // Fetch orders for the user
        $order = $this->model('order');
        $orders = $order->where('user_id', $id);
        // var_dump($orders);
        
        // Fetch order items for each order
        $orderItem = $this->model('orderItems');
        $orderItems = [];
        foreach ($orders as $order) {
            // Fetch items for the current order
            $items = $orderItem->allData($order['id']);
            // Store items by order ID for easy access in the view
            $orderItems[$order['id']] = $items;
        }
        


        // Render the view with the necessary data
        $this->render('public.profile.index', [
            'id' => $id,
            'orders' => $orders,
            'orderItems' => $orderItems
        ]);
    } else {
        // Redirect if the user is not authorized
        $this->redirect('/');
    }
}

    public function edit($id)
    {
        $profile = $this->model('user');
        $profile = $profile->find($id);

        if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id) {
            $this->render('public.profile.edit', ['id' => $id, 'profile' => $profile]);
        } else {
            $this->redirect('/');
        }
    }

    public function update($id)
    {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $mobile = $_POST['mobile'] ?? null;
        $dob = $_POST['dob'] ?? null;

        $user = $this->model('user');
        $userData = $user->find($id);

        $userEmail = $user->findByEmail($email);

        if (!empty($userEmail) && $userData['email'] != $email) {
            $this->render('public.profile.edit', ['emailError' => 'Email Already Exist' , 'id' => $id, 'profile' => $userData]);
            exit;
        }
        

        $userMobile = $user->findByMobile($mobile);

        if(!empty($userMobile) && $userData['mobile'] != $mobile) {
            $this->render('public.profile.edit', ['mobileError' => 'Mobile Already Exist', 'id' => $id, 'profile' => $userData]);
            exit;
        }

        $errors = $this->validate([
            'name' => 'required|alphaSpace|min:3',
            'email' => 'required|email',
            'mobile' => 'required|phone',
            'dob' => 'required|date'
        ]);

        if (!empty($errors)) {
            $this->render('public.profile.edit', ['errors' => $errors, 'id' => $id, 'profile' => $userData]);
            exit;
        }

        $user->update($id,[
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'date_of_birth' => $dob
        ]);

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        
        $_SESSION['success_message'] = 'Profile updated successfully!';

        $this->redirect('/profile/'.$id);
    }
    
    public function cancel($id)
    {
        $ordersModel = $this->model('order');
        $ordersModel->update($id , ['status' => 'canceled']);
        
        $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
        
        $this->redirect('/profile/' . $userId);
    }
    
    
    public function addTestimonial(){
        if(!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        $this->render('public.profile.addTestimonial');
    }
    
    public function saveTestimonial(){
        if(!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        $name = $_POST['name'] ?? null;
        $message = $_POST['message'] ?? null;
        
        
        $errors = $this->validate([
            'message' => 'required|badWord'
        ]);
        
        if(!empty($errors)){
            $this->render('public.profile.addTestimonial', ['errors' => $errors]);
            exit;
        }
        
        $testimonial = $this->model('testimonial');
        $testimonial->create([
            'name' => $name,
            'message' => $message
        ]);
        
        $this->render('public.profile.addTestimonial', ['accepted' => true]);
    }
    
}