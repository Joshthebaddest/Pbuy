<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class Order extends Model {
        protected static $table = 'orders';

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
