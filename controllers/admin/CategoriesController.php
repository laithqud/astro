<?php

include_once './controllers/admin/BaseAdmin.php';
include_once './models/Category.php';

class CategoriesController extends BaseAdmin
{
    
    
    public function createCategory()
    {
        $this->render('admin.categories.create');
    }
    public function editCategory($id)
    {
        $category = $this->model('category');
        $category= $category->findCategory($id);
        $this->render('admin.categories.edit', ['id' => $id ,'category' => $category]);
    }
    public function index()
    {
        $product = $this->model('category');
        $categories = $product->getCategories();
        $this->render('admin.categories.index', ['categories' => $categories]);
    }
    public function storeCategory()
    {
        $name = $_POST['name'] ?? null;

        $errors = $this->validate([
            'name' => 'required|min:3',
        ]);

        if (!empty($errors)) {
            $category = $this->model('category');
            $categories = $category->getCategories();
            $this->render('admin.categories.create', ['errors' => $errors , 'name' => $name , 'categories' => $categories]);
        }

        $category = $this->model('category');
        $category->addCategory($name);
        
        $this->redirect('/admin/categories');
        
    }
    
    public function update($id)
    {
        $name = $_POST['name'] ?? null;

        $errors = $this->validate([
            'name' => 'required|min:3',
        ]);

        if (!empty($errors)) {
            $category = $this->model('category');
            $category= $category->findCategory($id);
            $this->render('admin.categories.edit', ['errors' => $errors , 'name' => $name , 'category' => $category]);
        }

        $category = $this->model('category');
        $category->updateCategory($id, $name);
        
        $this->redirect('/admin/categories');
        
    }

    public function delete($id)
    {
        $category = $this->model('category');
        $category->softDelete($id);
        $this->redirect('/admin/categories');
    }


}
