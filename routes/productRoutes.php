<?php
    require_once __DIR__ . '/../app/controllers/ProductsController.php';

    $productController = new ProductController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'create') {
        $productController->create();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['productId'])) {
        $productId = $_GET['productId'];
        $data = $productController->getOne($productId);
        $url = $_SERVER['REQUEST_URI'];
        $newPath = preg_replace('#^/pbuy/public/?#', '', $url);
        $productController->viewOne('admin', $data, $newPath);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['productId'])) {;
        $data = $productController->getAll();
        $url = $_SERVER['REQUEST_URI'];
        $newPath = preg_replace('#^/pbuy/public/?#', '', $url);
        $productController->viewAll('admin', $data, $newPath);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'delete') {
        $productController->delete($_POST['product_id'], $_POST['username']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'update') {
        $productController->update();
    }

?>