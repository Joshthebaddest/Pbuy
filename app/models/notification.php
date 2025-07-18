<?php
require_once __DIR__ . '/Model.php';

    class Notification extends Model {
        protected static $table = 'notifications';

        protected static $schema = [
            'user_id'    => ['type' => 'VARCHAR(100)', 'required' => true], // ID of the user who receives the notification
            'type'       => ['type' => 'ENUM("order_update", "promo", "message")', 'required' => true], // Type of notification
            'message'    => ['type' => 'TEXT', 'required' => true], // Notification content
            'link'       => ['type' => 'VARCHAR(255)'], // Optional link (e.g., to order or promotion)
            'read'       => ['type' => 'TINYINT(1)', 'default' => 0], // 0 = unread, 1 = read
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'], // Timestamp of creation
        ];


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