<?php
require_once __DIR__ . '/Model.php';

    class Notification extends Model {
        protected static $table = 'notifications';

        protected static $rules = [
            'user_id'    => 'string|required',
            'type'       => 'string|required|enum:order_update,promo,message',
            'message'    => 'string|required',
            'link'       => 'string',
            'read'       => 'int|required', // boolean as int 0/1
            'created_at' => 'date|required',
        ];
    }
?>