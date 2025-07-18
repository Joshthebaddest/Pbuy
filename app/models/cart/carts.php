<?php 
    require_once __DIR__ .'/../../config/models.php';

    class Cart extends Model {
        protected static $table = 'carts';

        protected static $rules = [
            'user_id'    => 'string|required|unique:carts:user_id',
            'updated_at' => 'date',
        ];
    }

?>
