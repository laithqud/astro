<?php

include_once './controllers/admin/BaseAdmin.php';


class DashboardController extends BaseAdmin 
{
    public function index()
    {
        $username = null;
        
        if (isset($_SESSION['admin'])) {
            $username = $_SESSION['admin']['username'];
        }

        $this->render('admin.dashboard.dashboard' , ['username' => $username]);
    }

}