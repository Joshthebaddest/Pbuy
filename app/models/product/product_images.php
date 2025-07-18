<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductImage extends Model {
        protected static $table = 'product_images';

        protected static $schema = [
            'product_id' => ['type' => 'INT', 'required' => true], // ID of the related product
            'img_url'    => ['type' => 'VARCHAR(255)', 'required' => true], // URL of the image
            'is_main'    => ['type' => 'TINYINT(1)', 'default' => 0], // 1 = main image, 0 = not main
        ];


        protected static $rules = [
            'product_id' => 'int|required',
            'img_url' => 'string|required',
            'is_main' => 'boolean|required', 
        ];
    }
?>
