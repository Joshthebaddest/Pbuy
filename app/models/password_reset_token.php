<?php 
    require_once __DIR__ .'/../../config/models.php';

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