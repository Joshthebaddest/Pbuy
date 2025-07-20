<?php 
    require_once __DIR__ .'/../../config/models.php';

    class User extends Model {
        protected static $table = 'users';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'fullname' => ['type' => 'VARCHAR(100)', 'required' => true],
            'username' => ['type' => 'VARCHAR(100)', 'required' => true, 'unique' => true],
            'email' => ['type' => 'VARCHAR(255)', 'required' => true, 'unique' => true],
            'country' => ['type' => 'VARCHAR(100)', 'required' => true],
            'password_hash' => ['type' => 'VARCHAR(100)', 'required' => true],
            'profileImg' => ['type' => 'VARCHAR(255)'],
            'role' => ['type' => 'ENUM("super_admin", "user", "admin", "vendor")', 'default' => '"user"'],
            'email_verified' => ['type' => 'TINYINT(1)', 'default' => 0],
            'email_verification_token' => ['type' => 'VARCHAR(225)'],
            'email_verification_expires' => ['type' => 'DATETIME'],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'username' => 'string|required|unique:users,username',
            'email' => 'string|required|unique:users,email', 
            'date_of_birth' => 'date|required',
            'country' => 'string|required',
            'gender' => 'string|required',
            'password_hash' => 'string|required',
            // 'role' => 'enum:admin,editor,user',
            'profileImg' => 'string',
            'email_verification_token' => 'string',
            'email_verification_expires' => 'date',
        ];
    }


?>