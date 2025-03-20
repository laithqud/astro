<?php

include_once './controllers/admin/BaseAdmin.php';
include_once './models/Admin.php';


class AdminsController extends BaseAdmin
{

    
    public function checkRole()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'Admin') {
                $this->redirect('/admin/dashboard');
            
        }
    }
    
    public function editAdmin($id)
    {   
        $this->checkRole();
        $admin = $this->model('admin');
        $admin = $admin->find($id);
        $this->render('admin.admins.edit', ['id' => $id , 'admin' => $admin]);
    }
    
    public function update($id)
    {
        $this->checkRole();
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $mobile = $_POST['mobile'] ?? null;
        $role = $_POST['role'] ?? null;

        

        $errors = $this->validate([
            'username' => 'required|min:3',
            'email' => 'required|email',
            'mobile' => 'required|numeric|min:10',
            'role' => 'required',
        ]);
        
        if (!empty($errors)) {
            $this->render('admin.admins.edit', [ 'id' => $id , 'errors' => $errors , 'admin' => $_POST ]);
            exit;
        }


        $admin = $this->model('admin');
        $admin->update( $id, [
            'username' => $username,
            'email' => $email,
            'mobile' => $mobile,
            'role' => $role,

        ]);
        
        $this->redirect('/admin/admins');
    }

    public function updatePassword( $id )
    {
        $this->checkRole();
        $id = $_POST['id'] ?? null;
        $admin = $this->model('admin');
        $admin = $admin->find($id);
        
        $password = $_POST['password'] ?? null;
        $confirm_password = $_POST['confirm-password'] ?? null;
        
        $errors = $this->validate([
            'password' => 'required|password',
            'confirm-password' => 'required|match:password'
        ]);
        
        if (!empty($errors)) {
            $this->render('admin.admins.edit', [ 'id' => $id , 'errors' => $errors , 'admin' => $admin   ]);
            exit;
        }
        
        $admin = $this->model('admin');
        $admin->update( $id, [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        
        $this->redirect('/admin/admins');
        
    }
    
    
    
    public function delete($id)
    {
        $this->checkRole();
        $admin = $this->model('admin');
        $admin->softDelete($id);
        $this->redirect('/admin/admins');
    }
    
    
    
    
    
    public function createAdmin()
    {
        $this->checkRole();
        $this->render('admin.admins.create');
    }
    
    public function store()
    {   
        $this->checkRole();
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $mobile = $_POST['mobile'] ?? null;
        $role = $_POST['role'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirm_password = $_POST['confirm-password'] ?? null;
        
        $admin = $this->model('admin');
        $adminEmail = $admin->findByEmail($email);
        

        
        if (!empty($adminEmail)) {
            $this->render('admin.admins.create', ['emailError' => 'Email Already Exist']);
            exit;
        } 
        
        $adminMobile = $admin->findByMobile($mobile);
        
        if (!empty($adminMobile)) {
            $this->render('admin.admins.create', ['mobileError' => 'Mobile Already Exist']);
            exit;
        } 
        

        
        $errors = $this->validate([
            'username' => 'required|min:3|alphanumeric',
            'email' => 'required|email',
            'mobile' => 'required|numeric|min:10',
            'role' => 'required',
            'password' => 'required|password',
            'confirm-password' => 'required|match:password'
        ]);
        
        if (!empty($errors)) {
            $this->render('admin.admins.create', ['errors' => $errors , 'values' => $_POST ]);
            exit;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        

        $admin = $this->model('admin');
        $admin->create([
            'username' => $username,
            'email' => $email,
            'mobile' => $mobile,
            'role' => $role,
            'password' => $hashedPassword,
        ]);
        
        $this->redirect('/admin/admins');
    
    }
    
    
    public function index()
    {
        $this->checkRole();
        $admins = $this->model('admin');
        $admins = $admins->where('deleted', 0);

        $this->render('admin.admins.index' , ['admins' => $admins]);
    }

}
