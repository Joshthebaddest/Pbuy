<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class Order extends Model {
        protected static $table = 'orders';

        protected static $shema = [
            'id'                => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'user_id'           => ['type' => 'INT', 'required' => true],
            'vendor_id'         => ['type' => 'INT', 'required' => true],
            'status'            => ['type' => 'ENUM("pending", "confirmed", "shipped", "delivered", "cancelled")', 'default' => 'pending'],
            'total_amount'      => ['type' => 'INT', 'required' => true, 'default' => 0],
            'payment_status'    => ['type' => 'ENUM("pending", "paid", "failed")', 'default' => 'pending'],
            'payment_reference' => ['type' => 'VARCHAR(255)', 'default' => null], // optional payment reference
            'created_at'        => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'        => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];
        
        protected static $rules = [
            'user_id'           => 'string|required',
            'vendor_id'         => 'string|required',
            'status'            => 'string|enum:pending,confirmed,shipped,delivered,cancelled|required',
            'total_amount'      => 'int|required|min:0',
            'payment_status'    => 'string|enum:pending,paid,failed|required',
            'payment_reference' => 'string',
            'created_at'        => 'date',
            'updated_at'        => 'date',
        ];
    }
?>
