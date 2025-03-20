<?php

include_once './controllers/admin/BaseAdmin.php';

class TestimonialsController extends BaseAdmin
{
    
    

    
    public function index()
    {
        // get all orders
        $testimonialModel = $this->model('testimonial');
        $testimonials = $testimonialModel->all();
        
        $this->render('admin.testimonials.index' ,  ['testimonials' => $testimonials]);
    }
    
    
    public function accept($id)
    {
        $testimonialModel = $this->model('testimonial');
        $testimonialModel->update($id , ['status' => 'accepted']);
        $this->redirect('/admin/testimonials');
    }
    
    public function reject($id)
    {
        $testimonialModel = $this->model('testimonial');
        $testimonialModel->update($id , ['status' => 'rejected']);
        $this->redirect('/admin/testimonials');
    }
    


}