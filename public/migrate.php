<?php
    require_once __DIR__ . '/../app/models/cart/carts.php';
    require_once __DIR__ . '/../app/models/product/products.php';
    require_once __DIR__ . '/../app/models/category.php';
    require_once __DIR__ . '/../app/models/users.php';
    require_once __DIR__ . '/../app/models/product/product_images.php';
    require_once __DIR__ . '/../app/models/password_reset_token.php';
    require_once __DIR__ . '/../app/models/tag.php';

    try{
        User::init();
        Product::init();
        PasswordResetTokens::init();
        ProductImage::init();
        Category::init();
        Cart::init();
        Tag::init();
    }catch(Exception $e){
        echo $e -> getMessage();
    }


