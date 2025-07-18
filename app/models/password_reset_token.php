<?php 
    require_once __DIR__ .'/../../config/models.php';

    class PasswordResetTokens extends Model {
        protected static $table = 'password_reset_tokens';

        protected static $schema = [
            'user_email' => ['type' => 'VARCHAR(255)', 'required' => true], // Email of the user
            'token_hash' => ['type' => 'VARCHAR(255)', 'required' => true], // Hashed token for security
            'expires_at' => ['type' => 'DATETIME', 'required' => true], // Expiration date and time of the token
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'], // Optional: Track request creation
        ];


        protected static $rules = [
            'user_email' => 'string|required',
            'token_hash' => 'string|required',
            'expires_at' => 'date|required',
        ];
    }
?>