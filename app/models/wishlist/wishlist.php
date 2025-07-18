<?php
    require_once __DIR__ . '/Model.php';

    class Wishlist extends Model {
        protected static $table = 'wishlists';

        protected static $rules = [
            'user_id'    => 'string|required|unique:wishlists:user_id',
            'created_at' => 'date',
            'updated_at' => 'date',
        ];
    }

?>