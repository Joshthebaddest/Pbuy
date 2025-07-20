<?php
require_once __DIR__ . '/../../config/globalConfig.php';
require_once __DIR__ . '/fileUploadController.php';
require_once __DIR__ . '/../models/product/products.php';
require_once __DIR__. '/../utils/render.php';

class ProductController {

    public function create() {
        $errors = [];
        $type = $_POST['type'] ?? 'add';

        $product_name = $this -> test_input($_POST["product_name"]);
        $product_size = 'xxl';
        $quantity = $this -> test_input($_POST["stock"]);
        $descriptions = $this -> test_input($_POST["description"]);
        $price = $this -> test_input($_POST["price"]);
        $category_id = $this -> test_input($_POST["category_id"]);
        $images = [];

        foreach (['img_url_0', 'img_url_1', 'img_url_2', 'img_url_3', 'img_url_4'] as $key) {
            if (isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
                $uploadResult = handleFileUpload($key);
                if ($uploadResult['success']) {
                    $images[] = $uploadResult['filePath'];
                } else {
                    $errors[$key] = $uploadResult['error'];
                    break;
                }
            } elseif ($type === 'edit' && !empty($_POST[$key])) {
                $images[] = test_input($_POST[$key]);
            }
        }

        if ($type === 'add' && empty($images)) {
            $errors['images'] = "Please upload at least one image.";
        }

        $errors = $this -> validate_product_form($product_name, $product_size, $quantity, $descriptions, $price, $errors);

        if (empty($errors)) {
            try {
                $img_url = $images[0];

                if ($type === "add") {
                    $product = Product::create([
                        'product_name' => $product_name,
                        'img_url' => $img_url,
                        'quantity' => $quantity,
                        'product_size' => $product_size,
                        'description' => $descriptions,
                        'price' => $price,
                    ]);
                    $productId = $product->id ?? null;
                } else {
                    $productId = $_POST['product_id'];
                    $username = $_POST['username'];
                    Product::update(['id' => $productId, 'username' => $username], [
                        'product_name' => $product_name,
                        'img_url' => $img_url,
                        'quantity' => $quantity,
                        'product_size' => $product_size,
                        'description' => $descriptions,
                        'price' => $price,
                    ]);
                }

                if ($type === 'edit') {
                    ProductImage::delete(['product_id' => $productId]);
                }

                $productId = 2;
                foreach ($images as $index => $img) {
                    $isMain = ($index === 0) ? 1 : 0;
                    ProductImage::create([
                        'product_id' => $productId,
                        'img_url' => $img,
                        'is_main' => $isMain
                    ]);
                }

                $_SESSION['toast'] = [
                    'message' => 'Product ' . ($type === 'add' ? 'created' : 'updated') . ' Successfully!',
                    'type' => 'success'
                ];

                header('Location: ' . BASE_PATH . 'dashboard/products');
                exit();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }else{
            header('Location: '. BASE_PATH . '/pbuy/public/dashboard/products');
            exit();
        }
    }

    public function getAll() {
        $products = Product::query()->select('*')->get();

        if (empty($products)) {
            return [];
        }

        $images = [];
        foreach ($products as $product) {
            $imgs = ProductImage::query()->select('*')->where('product_id', $product['id'])->get();
            foreach ($imgs as $index => $row) {
                $images['img_url_' . $index] = $row['img_url'];
            }
        }

        // Typically this would be passed to a view renderer
        return [
            'products' => $products,
            'images' => $images
        ];
    }

    public function getOne($productId) {
        $product = Product::query()->select('*')->where('id', $productId)->first();

        if (empty($product)) {
            echo "Product not found.";
            //   require_once __DIR__ . '/../../../public/404.html';
            //   exit();
            return [];
        }

        $images = [];
        $imgs = ProductImage::query()->select('*')->where('product_id', $productId)->get();
        foreach ($imgs as $index => $row) {
            $images['img_url_' . $index] = $row['img_url'];
        }

        // Typically this would be passed to a view renderer
        return [
            'product' => $product,
            'images' => $images
        ];
    }

    public function delete($productId, $username) {
        try {
            Product::delete(['product_id' => $productId, 'username' => $username]);
            header('Location: ' . BASE_PATH . '/products.php');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update() {
        // You could just call $this->create() with type = 'edit'
        $_POST['type'] = 'edit';
        $this->create();
    }

    public function viewAll($context = 'public', $data = [], $url){
        if (str_contains($url, 'dashboard')) {
            render('products', 'dashboard', ['pageTitle' => 'Products', 'data' => $data ]);
        } else {
            render('products', 'web', ['pageTitle' => 'Products', 'data' => $data]);
        }
    }

    public function viewOne($context = 'public', $data = [], $url){
        if (str_contains($url, 'dashboard')) {
            render('products', 'dashboard', ['pageTitle' => 'Products', 'data' => $data ]);
        } else {
            render('productDetail', 'web', ['pageTitle' => 'Products', 'data' => $data]);
        }
    }

    public function search() {
        $keyword = $_GET['search'] ?? '';
        $query = Product::query()->select('*');

        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', '%' . $keyword . '%');
        }

        $products = $this->getFilteredProducts($query);
        $categories = $this->getCategories();

        render('site/products/index', [
            'products' => $products,
            'categories' => $categories,
            'searchTerm' => $keyword
        ]);
    }

    private function getFilteredProducts($query = null) {
        $products = [];
        $query = $query ?? Product::query()->select('*');

        // Category filters
        foreach ($_GET as $key => $value) {
            if (str_starts_with($key, 'category_')) {
                $category_id = str_replace('category_', '', $key);
                $query->where('category_id', $category_id);
            }
        }

        // Price filters
        if (!empty($_GET['minRange'])) {
            $query->where('price', '>=', $_GET['minRange']);
        }

        if (!empty($_GET['maxRange'])) {
            $query->where('price', '<=', $_GET['maxRange']);
        }

        // Sorting (optional)
        if (!empty($_GET['sort_by'])) {
            $allowedSorts = ['price', 'product_name', 'created_at'];
            $sortBy = in_array($_GET['sort_by'], $allowedSorts) ? $_GET['sort_by'] : 'created_at';
            $sortOrder = (strtolower($_GET['sort_order'] ?? 'asc') === 'desc') ? 'desc' : 'asc';
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pageSize = isset($_GET['page_size']) ? (int)$_GET['page_size'] : 10;
        $results = $query->paginate($page, $pageSize)->getWithPagination();
        $data = $results['data'];

        foreach ($data as $row) {
            $products[] = [
                'id' => $row['id'],
                'name' => $row['product_name'],
                'image' => $row['img_url'],
                'vendorId' => 0,
                'vendorName' => $row['username'],
                'discount' => 20,
                'rating' => 4.3,
                'reviews' => 87,
                'price' => $row['price'],
                'originalPrice' => 99.99
            ];
        }

        return $products;
    }

    private function getCategories() {
        return Category::query()->select('*')->get();
    }

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    function validate_product_form($product_name, $product_size, $quantity, $descriptions, $price, $errors) {
        if (empty($product_name)) {
            $errors["product_name"] = "Product name is required.";
        }

        if (empty($product_size)) {
            $errors["product_size"] = "Size is required.";
        }

        if (empty($quantity) || !filter_var($quantity, FILTER_VALIDATE_INT) || $quantity <= 0) {
            $errors["quantity"] = "Quantity must be a positive number.";
        }

        if (empty($descriptions)) {
            $errors["description"] = "Description is required.";
        }

        if (empty($price) || !filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
            $errors["price"] = "Price must be a positive number.";
        }
        return $errors;
    }
}

