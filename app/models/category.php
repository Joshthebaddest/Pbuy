<?php 
    require_once __DIR__ .'/../../config/models.php';

    class Category extends Model {
        protected static $table = 'categories';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'name' => ['type' => 'VARCHAR(100)', 'required' => true, 'unique' => true],
            'url' => ['type' => 'VARCHAR(100)', 'required' => true],
            'slug' => ['type' => 'VARCHAR(100)', 'required' => true],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'name' => 'string|required|unique:categories,name',
            'url' => 'string|required',
            'slug' => 'string|required',
        ];
    }
?>