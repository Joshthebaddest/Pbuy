<?php 
    require_once __DIR__ .'/../../config/models.php';

    class VariantOption extends Model {
        protected static $table = 'variant_options';

        protected static $schema = [
            'variant_id'   => ['type' => 'INT', 'required' => true], // ID of the variant this option belongs to
            'option_value' => ['type' => 'VARCHAR(100)', 'required' => true], // Option value, e.g., "Large", "Red"
        ];


        protected static $rules = [
            'variant_id'   => 'int|required|min:1',
            'option_value' => 'string|required', // e.g., "Large"
        ];
    }
?>