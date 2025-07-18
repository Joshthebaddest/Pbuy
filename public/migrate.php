<?php
    require_once __DIR__ . '/../app/models/carts.php';
    require_once __DIR__ . '/../app/models/products.php';
    require_once __DIR__ . '/../app/models/category.php';
    require_once __DIR__ . '/../app/models/users.php';
    
    try{
        User::init();
        Product::init();
        PasswordResetTokens::init();
        ProductImage::init();
        Category::init();
        Cart::init();
    }catch(Exception $e){
        echo $e -> getMessage();
    }


