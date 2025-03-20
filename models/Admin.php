<?php


require_once  './config/Database.php';
require_once  './models/Model.php';


class Admin  extends Model
{

    public function __construct()
    {
        parent::__construct('admins');
    }
    
    
    

    public function findByEmail($email)
    {
        return $this->query('SELECT * FROM admins WHERE email = ?', [$email]);
    }
    
    public function findByMobile($mobile)
    {
        return $this->query('SELECT * FROM admins WHERE mobile = ?', [$mobile]);
    }
    
    public function softDelete($id)
    {
        return $this->update($id, ['deleted' => 1 ]);
    }

}
