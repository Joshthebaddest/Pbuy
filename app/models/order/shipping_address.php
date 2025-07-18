<?php 
    require_once __DIR__ .'/../../../config/models.php';

    class ShippingAddress extends Model {
        protected static $table = 'shipping_addresses';

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
