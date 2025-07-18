<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductVariant extends Model {
        protected static $table = 'product_variants';

        protected static $rules = [
            'product_id' => 'int|required|min:1',
            'name'       => 'string|required', // e.g., "Size"
        ];
    }
?>
