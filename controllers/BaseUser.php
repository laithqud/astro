<?php

include_once './controllers/Controller.php';

class BaseUser extends Controller
{
    public function __construct()
    {
      // the session should be initialized before authentication
      $this->initializeSession();
    //   $this->isAuthenticated();

    }
    
    
    public function isAuthenticated()
    { 
        if (!isset($_SESSION['user'])) {
            header("Location: /auth/login");
            exit;
        }
    }
}
