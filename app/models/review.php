<?php
   require_once __DIR__ .'/../../config/models.php';

    class Review extends Model {
        protected static $table = 'reviews';

        protected static $schema = [
            'user_id'    => ['type' => 'VARCHAR(100)', 'required' => true], // Assuming it's a foreign key reference to a user
            'product_id' => ['type' => 'INT', 'required' => true], // Assuming it refers to a product's ID
            'rating'     => ['type' => 'TINYINT', 'required' => true], // Ratings usually range from 1 to 5
            'comment'    => ['type' => 'TEXT'], // Optional comment field
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'], // More precise than just DATE
        ];


        protected static $rules = [
            'user_id'    => 'string|required',
            'product_id' => 'int|required',
            'rating'     => 'int|required|min:1|max:5',
            'comment'    => 'string',
            'created_at' => 'date'
        ];
    }
?>
