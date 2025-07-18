<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductVariant extends Model {
        protected static $table = 'product_variants';

        protected static $schema = [
            'product_id' => ['type' => 'INT', 'required' => true], // ID of the product this variant belongs to
            'name'       => ['type' => 'VARCHAR(100)', 'required' => true], // Name of the variant (e.g., "Size", "Color")
        ];


        protected static $rules = [
            'product_id' => 'int|required|min:1',
            'name'       => 'string|required', // e.g., "Size"
        ];
    }
?>
