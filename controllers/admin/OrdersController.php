<?php

include_once './controllers/admin/BaseAdmin.php';

class OrdersController extends BaseAdmin
{
    
    
    public function editOrderStatus($id)
    {    
        $this->render('admin.orders.edit-status' , ['id' => $id]);
    }
    
    
    public function index()
    {
        // get all orders
        $orderModel = $this->model('order');
        $orders = $orderModel->all();
        
        $this->render('admin.orders.index' , ['orders' => $orders]);
    }
    
    public function editStatus($id)
    {
        
        if(!isset($_POST['status']))
        {
            $this->redirect('/admin/orders');
        } 
        
        
        $orderModel = $this->model('order');
        $orderModel->update($id , 
            [
                'status' => $_POST['status']
            ]);
        $this->redirect('/admin/orders');
    }

}