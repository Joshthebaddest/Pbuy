<?php 
    require_once __DIR__ .'/../../config/models.php';

    class Cart extends Model {
        protected static $table = 'carts';

        protected static $rules = [
            'cart_id' => 'string|required',
            'product_id' => 'string|required',
            'quantity' => 'int|required',
        ];

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'cart_id' => ['type' => 'VARCHAR(255)', 'required' => true, 'unique' => true],
            'product_id' => ['type' => 'VARCHAR(255)', 'required' => true],
            'quantity' => ['type' => 'INT', 'required' => true, 'default' => 1],
            'status' => ['type' => 'ENUM("pending", "confirmed", "cancelled")', 'default' => '"pending"'],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];
    }

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
