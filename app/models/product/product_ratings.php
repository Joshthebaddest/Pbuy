<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductRating extends Model {
        protected static $table = 'product_ratings';

        protected static $rules = [
            'product_id'     => 'int|required|min:1',
            'rating_count'   => 'int|min:0',
            'rating_average' => 'int|min:0|max:5',
        ];
    }

?>
