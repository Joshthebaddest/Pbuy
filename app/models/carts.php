<?php 
    require_once __DIR__ .'/../../config/models.php';



    class CartItem extends Model {
        protected static $table = 'cartitems';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'cart_id' => ['type' => 'VARCHAR(255)', 'required' => true],
            'product_id' => ['type' => 'INT', 'required' => true],
            'quantity' => ['type' => 'INT', 'required' => true, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'user_id' => 'string|required',
        ];
    }
?>
