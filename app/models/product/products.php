<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class Product extends Model {
        protected static $table = 'vendorproducts';

        protected static $schema = [
            'product_name'  => ['type' => 'VARCHAR(255)', 'required' => true], // Name of the product
            'img_url'       => ['type' => 'VARCHAR(255)'], // Optional product image URL
            'product_size'  => ['type' => 'VARCHAR(100)'], // Optional size info
            'quantity'      => ['type' => 'INT', 'default' => 0], // Stock quantity
            'description'   => ['type' => 'TEXT'], // Product description
            'price'         => ['type' => 'INT', 'required' => true], // Price in smallest currency unit (e.g., cents)
            'username'      => ['type' => 'VARCHAR(100)', 'required' => true], // Username of the vendor
            'created_at'    => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'    => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];


        protected static $rules = [
            'product_name' => 'string|required',
            'img_url' => 'string|required',
            'product_size' => 'string', 
            'quantity' => 'int|required',
            'description' => 'string|required',
            'price' => 'int|required',
            'username' => 'string|required',
        ];
    }
?>
