<?php
    require_once __DIR__ .'/../../config/models.php';

    class CartItem extends Model {
        protected static $table = 'cart_items';

        protected static $rules = [
            'cart_id'    => 'int|required',
            'product_id' => 'int|required',
            'quantity'   => 'int|required',
            'variant'    => 'string', // optional
        ];
    }
?>
