<?php
   require_once __DIR__ .'/../../config/models.php';

    class Review extends Model {
        protected static $table = 'reviews';

        protected static $rules = [
            'user_id'    => 'string|required',
            'product_id' => 'int|required',
            'rating'     => 'int|required|min:1|max:5',
            'comment'    => 'string',
            'created_at' => 'date'
        ];
    }
?>
