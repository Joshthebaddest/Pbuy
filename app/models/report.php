<?php
    require_once __DIR__ . '/Model.php';

    class Report extends Model {
        protected static $table = 'reports';

        protected static $schema = [
            'user_id'    => ['type' => 'VARCHAR(100)', 'required' => true], // ID of the reporter
            'type'       => ['type' => 'ENUM("product", "vendor")', 'required' => true], // Type of report
            'subject_id' => ['type' => 'INT', 'required' => true], // ID of product or vendor being reported
            'message'    => ['type' => 'TEXT', 'required' => true], // Report message
            'resolved'   => ['type' => 'TINYINT(1)', 'default' => 0], // 0 = unresolved, 1 = resolved
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'], // Timestamp of report creation
        ];


        protected static $rules = [
            'user_id'    => 'string|required',
            'type'       => 'string|required|enum:product,vendor',
            'subject_id' => 'int|required',
            'message'    => 'string|required',
            'resolved'   => 'int|required', // boolean stored as int 0/1
        ];
    }
?>