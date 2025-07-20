<?php
    require_once __DIR__ . '/../app/utils/render.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
        $data = [];
        render('orders', 'dashboard', ['pageTitle' => 'Store Settings', 'data' => $data ]);
    }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'add-category') {
    //     $name = $_POST['name'];
    //     Category::create(['name' => ucwords($name), 'url' => strtolower(str_replace(' ', '-', $name)), 'slug' => strtolower(str_replace(' ', '-', $name))]);
    //     Header('Location: ' . BASE_PATH . 'dashboard/categories');
    //     exit;
    // }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'add-tag') {
    //     $name = $_POST['name'];
    //     Tag::create(['name' => strtolower(str_replace(' ', '-', $name))]);
    //     Header('Location: ' . BASE_PATH . 'dashboard/categories');
    //     exit;
    // }
