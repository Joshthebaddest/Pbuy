<?php
    require_once __DIR__ . '/Model.php';

    class Wishlist extends Model {
        protected static $table = 'wishlists';

        protected static $schema = [
            'user_id'    => ['type' => 'VARCHAR(100)', 'required' => true], // User ID who owns the wishlist
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'], // When wishlist was created
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'], // Last update time
        ];


        protected static $rules = [
            'user_id'    => 'string|required|unique:wishlists:user_id',
            'created_at' => 'date',
            'updated_at' => 'date',
        ];
    }

?>