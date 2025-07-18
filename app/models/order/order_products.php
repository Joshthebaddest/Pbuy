<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class OrderProduct extends Model {
        protected static $table = 'order_products';

        protected static $shema = [
            'id'         => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'order_id'   => ['type' => 'INT', 'required' => true],
            'product_id' => ['type' => 'INT', 'required' => true],
            'name'       => ['type' => 'VARCHAR(255)', 'required' => true],
            'price'      => ['type' => 'INT', 'required' => true, 'default' => 0],
            'quantity'   => ['type' => 'INT', 'required' => true, 'default' => 1],
            'variant'    => ['type' => 'VARCHAR(255)', 'default' => null], // optional variant field
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];
        
        protected static $rules = [
            'order_id'   => 'int|required|min:1',
            'product_id' => 'int|required|min:1',
            'name'       => 'string|required',
            'price'      => 'int|required|min:0',
            'quantity'   => 'int|required|min:1',
            'variant'    => 'string', // optional
        ];
    }
?>
