<?php
    require_once __DIR__ . '/Model.php';

    class Report extends Model {
        protected static $table = 'reports';

        protected static $rules = [
            'user_id'    => 'string|required',
            'type'       => 'string|required|enum:product,vendor',
            'subject_id' => 'int|required',
            'message'    => 'string|required',
            'resolved'   => 'int|required', // boolean stored as int 0/1
            'created_at' => 'date|required',
        ];
    }
?>