<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class User  extends Model
{

    public function __construct()
    {
        parent::__construct('users');
    }
    
    
    

    public function findByEmailLogin($email)
    {
        return $this->query('SELECT * FROM users WHERE email = ? AND deleted = 0 ', [$email]);
        // return $this->where('deleted',0);
    }

    public function findByEmail($email)
    {
        return $this->query('SELECT * FROM users WHERE email = ?', [$email]);
    }
    
    public function findByMobile($mobile)
    {
        return $this->query('SELECT * FROM users WHERE mobile = ? ', [$mobile]);
    }
    
    public function softDelete($id)
    {
        return $this->update($id, ['deleted' => 1 ]);
    }
    

}
