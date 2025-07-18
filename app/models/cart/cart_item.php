<?php
    require_once __DIR__ .'/../../config/models.php';

    class CartItem extends Model {
        protected static $table = 'cart_items';

        protected static $shema = [
            'id'         => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'cart_id'    => ['type' => 'INT', 'required' => true],
            'product_id' => ['type' => 'INT', 'required' => true],
            'quantity'   => ['type' => 'INT', 'required' => true, 'default' => 1],
            'variant'    => ['type' => 'VARCHAR(255)', 'default' => null], // optional variant field
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];
        
        protected static $rules = [
            'cart_id'    => 'int|required',
            'product_id' => 'int|required',
            'quantity'   => 'int|required',
            'variant'    => 'string', // optional
        ];
    }
?>
