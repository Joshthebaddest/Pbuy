<?php 
    require_once __DIR__ .'/../../config/models.php';

    class Cart extends Model {
        protected static $table = 'carts';

        protected static $schema = [
            'id'         => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'user_id'    => ['type' => 'INT', 'required' => true],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];


        protected static $rules = [
            'user_id'    => 'string|required|unique:carts:user_id',
            'updated_at' => 'date',
        ];
    }

?>
