<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductRating extends Model {
        protected static $table = 'product_ratings';

        protected static $schema = [
            'product_id'     => ['type' => 'INT', 'required' => true], // ID of the product
            'rating_count'   => ['type' => 'INT', 'default' => 0], // Total number of ratings
            'rating_average' => ['type' => 'FLOAT', 'default' => 0], // Average rating (0.0 to 5.0)
        ];


        protected static $rules = [
            'product_id'     => 'int|required|min:1',
            'rating_count'   => 'int|min:0',
            'rating_average' => 'float|min:0|max:5',
        ];
    }

?>
