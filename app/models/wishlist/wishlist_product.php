<?php
    require_once __DIR__ . '/Model.php';

    class WishlistProduct extends Model {
        protected static $table = 'wishlist_products';

        protected static $rules = [
            'wishlist_id' => 'int|required',
            'product_id'  => 'int|required',
        ];
    }
?>