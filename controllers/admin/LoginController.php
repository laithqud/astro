<?php

include_once './controllers/Controller.php';

include_once './models/Admin.php';
class LoginController extends Controller
{
    
    
    
    public function index()
    {
        if (isset($_SESSION['admin'])) {
            $this->redirect('/admin/dashboard');
        }
        $this->render('admin.auth.login');
    }
    
    public function logout()
    {
        unset($_SESSION['admin']);
        $this->render('admin.auth.login');
    }
    
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $admin = $this->model('admin');
        $admin = $admin->findByEmail($email);
        
        if (empty($admin)) {
            $this->render('admin.auth.login', ['emailError' => 'Invalid email']);
            exit;
        } 
        
        if (!password_verify($password, $admin[0]['password']) ) {
            $this->render('admin.auth.login', ['passwordError' => 'Invalid password']);
            exit;
        }
        
        $adminData = 
        [
            'id' => $admin[0]['id'],
            'username' => $admin[0]['username'],
            'role' => $admin[0]['role'],
            
        ] ;
        
    
        $_SESSION['admin'] = $adminData;
        

        
        $this->redirect('/admin/dashboard');
    }
    
    

}