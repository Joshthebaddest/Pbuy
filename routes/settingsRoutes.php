<?php
    require_once __DIR__ . '/../app/utils/render.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
        $data = [];
        render('storeSettings', 'dashboard', ['pageTitle' => 'Store Settings', 'data' => $data ]);
    }