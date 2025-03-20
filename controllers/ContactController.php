<?php
include_once './controllers/Controller.php';

class ContactController extends Controller
{
    public function index()
    {
        $this->render('public.pages.contact');
    }

}