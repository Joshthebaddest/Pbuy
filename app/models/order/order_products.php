<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class OrderProduct extends Model {
        protected static $table = 'order_products';

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
