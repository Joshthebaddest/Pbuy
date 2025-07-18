<?php 
    require_once __DIR__ .'/../../config/models.php';

    class VariantOption extends Model {
        protected static $table = 'variant_options';

        protected static $rules = [
            'variant_id'   => 'int|required|min:1',
            'option_value' => 'string|required', // e.g., "Large"
        ];
    }
?>