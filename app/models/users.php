<?php 
    require_once __DIR__ .'/../../config/models.php';

    class User extends Model {
        protected static $table = 'users';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'firstname' => ['type' => 'VARCHAR(100)', 'required' => true],
            'lastname' => ['type' => 'VARCHAR(100)', 'required' => true],
            'username' => ['type' => 'VARCHAR(100)', 'required' => true, 'unique' => true],
            'email' => ['type' => 'VARCHAR(255)', 'required' => true, 'unique' => true],
            'date_of_birth' => ['type' => 'DATE', 'required' => true],
            'country' => ['type' => 'VARCHAR(100)', 'required' => true],
            'gender' => ['type' => 'VARCHAR(100)', 'required' => true],
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

    class PasswordResetTokens extends Model {
        protected static $table = 'password_reset_tokens';

        protected static $schema = [
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary' => true],
            'user_email' => ['type' => 'VARCHAR(255)', 'required' => true],
            'token_hash' => ['type' => 'VARCHAR(255)', 'required' => true, 'unique' => true],
            'expires_at' => ['type' => 'DATETIME', 'required' => true],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ];

        protected static $rules = [
            'user_email' => 'string|required',
            'token_hash' => 'string|required|unique:password_reset_tokens,token_hash',
            'expires_at' => 'date|required',
        ];
    }
?>