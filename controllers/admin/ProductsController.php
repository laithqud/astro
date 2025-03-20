<?php

include_once './controllers/admin/BaseAdmin.php';

include_once './models/products/Product.php';

class ProductsController extends BaseAdmin
{
    
    
    public function createProductPage()
    {
        $product = $this->model('product');
        $categories = $product->getCategories();
        $this->render('admin.products.create' , ['categories' => $categories]);
    }
    
    public function store()
    {   
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;
        $description = $_POST['description'] ?? null;
        // $image_url = $_POST['image_url'] ?? null;
        $duration = $_POST['duration'] ?? null;
        $power_level = $_POST['power_level'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        
        // Handle file upload
        $image_url = null;
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
            $uploadDir = './public/images/products/'; 

            // Ensure directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['image_url']['tmp_name'];
            $fileOriginalName = $_FILES['image_url']['name'];
            $fileExtension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);

            // Generate a unique filename to prevent conflicts
            $newFileName = uniqid("img_", true) . '.' . $fileExtension;
            $destinationPath = $uploadDir . $newFileName;

            // Move the file to the target directory
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                $image_url = $newFileName; // Store only the filename in the database
            } else {
                $errors['image_url'] = "File upload failed.";
            }
        } else {
            $errors['image_url'] = "Image is required.";
        }
        
        
        
        
        $errors = $this->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'description' => 'required|min:5',
            // 'image_url' => 'required',
            'duration' => 'required|numeric',
            'power_level' => 'required',
            'stock' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);
        
        if (!empty($errors)) {
            $product = $this->model('product');
            $categories = $product->getCategories();
            $this->render('admin.products.create', ['errors' => $errors , 'values' => $_POST , 'categories' => $categories]);
        }
        
        $product = $this->model('product');
        $product->create([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image_url' => $image_url,
            'duration' => $duration,
            'power_level' => $power_level,
            'stock' => $stock,
            'category_id' => $category_id,
        ]);
        
        $this->redirect('/admin/products');
    }


    public function editProduct($id)
    {
        $item = $this->model('product');
        $product = $item->find($id);
        $categories = $item->getCategories();
        $this->render('admin.products.edit', ['id' => $id , 'product' => $product , 'categories' => $categories]);
    }
    
    
    public function update($id)
    {
        
        $product = $this->model('product')->find($id);
        
        
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;
        $description = $_POST['description'] ?? null;
        $image_url = $_POST['image_url'] ?? null;
        $duration = $_POST['duration'] ?? null;
        $power_level = $_POST['power_level'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        
        // Handle file upload
    $image_url = $product['image_url']; // Keep the old image by default
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
        $uploadDir = __DIR__ . '/../../public/images/products/'; // Ensure this directory exists

        // Ensure directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmpPath = $_FILES['image_url']['tmp_name'];
        $fileOriginalName = $_FILES['image_url']['name'];
        $fileExtension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);

        // Generate a unique filename
        $newFileName = uniqid("img_", true) . '.' . $fileExtension;
        $destinationPath = $uploadDir . $newFileName;

        // Move the file to the target directory
        if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            // Delete the old image if a new one is uploaded
            if (!empty($product['image_url']) && file_exists($uploadDir . $product['image_url'])) {
                unlink($uploadDir . $product['image_url']);
            }
            $image_url = $newFileName; // Save the new filename
        } else {
            $errors['image_url'] = "File upload failed.";
        }
    }
        
        
        $errors = $this->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'description' => 'required|min:5',
            // 'image_url' => 'required',
            'duration' => 'required|numeric',
            'power_level' => 'required',
            'stock' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);
        
        if (!empty($errors)) {
            $product = $this->model('product');
            $categories = $product->getCategories();
            $this->render('admin.products.edit', ['errors' => $errors , 'product' => $_POST , 'categories' => $categories , 'id' => $id]);
        }
        
        $product = $this->model('product');
        $product->update($id,[
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image_url' => $image_url,
            'duration' => $duration,
            'power_level' => $power_level,
            'stock' => $stock,
            'category_id' => $category_id,
        ]);
        $this->redirect('/admin/products');
    }

    
    
    public function delete($id)
    {
        $product = $this->model('product');
        $product->softDelete($id);
        $this->redirect('/admin/products');
    }

    public function index()
    {   
        $product = $this->model('product');
        $products = $product->allData();
        $this->render('admin.products.index' , ['products' => $products]);
    }

}
