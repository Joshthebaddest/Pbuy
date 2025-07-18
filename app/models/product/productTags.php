<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductTag extends Model {
        protected static $table = 'product_tags';

        protected static $rules = [
            'product_id' => 'int|required|min:1',
            'tag'        => 'string|required',
        ];
    }
?>
