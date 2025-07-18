<?php 
    require_once __DIR__ .'/../../config/models.php';

    class ProductTag extends Model {
        protected static $table = 'product_tags';

        protected static $schema = [
            'product_id' => ['type' => 'INT', 'required' => true], // ID of the associated product
            'tag'        => ['type' => 'VARCHAR(100)', 'required' => true], // Tag name or label
        ];


        protected static $rules = [
            'product_id' => 'int|required|min:1',
            'tag'        => 'string|required',
        ];
    }
?>
