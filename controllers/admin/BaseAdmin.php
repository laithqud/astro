<?php

include_once './controllers/Controller.php';

class BaseAdmin extends Controller
{
    public function __construct()
    {
      // the session should be initialized before authentication
      $this->initializeSession();
      $this->isAuthenticated();

    }
    
    
    protected function isAuthenticated()
    { 
        if (!isset($_SESSION['admin'])) {
            header("Location: /admin");
            exit;
        }
    }
}
