<?php 
    require_once __DIR__ .'/../../config/models.php';

    class Tag extends Model {
        protected static $table = 'tags';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true], // ID of the associated product
            'name'  => ['type' => 'VARCHAR(100)', 'required' => true], // Tag name
            'status' => ['type' => 'ENUM("approved", "pending")', 'default' => '"pending"'],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'id' => 'int|required|min:1',
            'name' => 'string|required|max:100',
            'status' => 'enum|required|in:approved,pending',
        ];
    }
?>
