<?php

include_once './controllers/Controller.php';
class AboutController extends Controller
{
    public function index()
    {
        $this->render('public.pages.about-us');
    }

}