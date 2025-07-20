<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class ProductImage extends Model {
        protected static $table = 'product_images';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'product_id' => ['type' => 'INT', 'required' => true],
            'img_url' => ['type' => 'VARCHAR(255)', 'required' => true],
            'is_main' => ['type' => 'TINYINT(1)', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'product_id' => 'int|required',
            'img_url' => 'string|required',
            'is_main' => 'boolean|required', 
        ];
    }
?>
