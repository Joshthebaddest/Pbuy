<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class ShippingAddress extends Model {
        protected static $table = 'shipping_addresses';

        protected static $shema = [
            'id'         => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'order_id'   => ['type' => 'INT', 'required' => true],
            'full_name'  => ['type' => 'VARCHAR(255)', 'required' => true],
            'phone'      => ['type' => 'VARCHAR(20)', 'required' => true], // phone number with international format
            'address'    => ['type' => 'TEXT', 'required' => true],
            'city'       => ['type' => 'VARCHAR(100)', 'required' => true],
            'state'      => ['type' => 'VARCHAR(100)', 'default' => null], // optional state field
            'country'    => ['type' => 'VARCHAR(100)', 'required' => true],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];
        

        protected static $rules = [
            'order_id'  => 'int|required|min:1',
            'full_name' => 'string|required',
            'phone'     => 'string|required|regex:/^\+?[0-9\- ]+$/',
            'address'   => 'string|required',
            'city'      => 'string|required',
            'state'     => 'string',
            'country'   => 'string|required',
        ];
    }
?>
