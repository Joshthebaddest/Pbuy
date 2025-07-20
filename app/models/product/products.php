<?php 
    require_once __DIR__ .'/../../../config/models.php';
    
    class Product extends Model {
        protected static $table = 'vendorproducts';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'product_name' => ['type' => 'VARCHAR(225)', 'required' => true, 'unique' => true],
            'username' => ['type' => 'VARCHAR(100)', 'required' => true],
            'img_url' => ['type' => 'VARCHAR(225)', 'required' => true],
            'price' => ['type' => 'DECIMAL(10,2)', 'required' => true],
            'description' => ['type' => 'TEXT'],
            'product_size' => ['type' => 'VARCHAR(100)'],
            'quantity' => ['type' => 'INT', 'default' => 0],
            'category_id' => ['type' => 'INT'],
            'status' => ['type' => 'ENUM("active", "inactive")', 'default' => '"active"'],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'product_name' => 'string|required|unique:vendorproducts,product_name',
            'img_url' => 'string|required',
            'product_size' => 'string', 
            'quantity' => 'int|required',
            'description' => 'string|required',
            'price' => 'int|required',
            'username' => 'string|required',
            'category_id' => 'int|required',
        ];
    }
?>


