<?php

include_once './controllers/admin/BaseAdmin.php';

class UsersController extends BaseAdmin
{
    
    
    public function editUser($id)
    {
        $this->render('admin.users.edit', ['id' => $id]);
    }
    public function index()
    {
        $users = $this->model('user');
        $users = $users->where('deleted', 0);

        $this->render('admin.users.index' , ['users' => $users]);
    }

    public function update($id)
    {
        $user = $this->model('user');
        $user = $user->find($id);
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->mobile = $_POST['mobile'];
        $user->save();
        header('Location: /admin/users');
    }

    public function delete($id)
    {
        $user = $this->model('user');
        $user->softDelete($id);
        $this->redirect('/admin/users');
    }


}
