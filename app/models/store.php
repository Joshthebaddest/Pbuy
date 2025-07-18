<?php

   require_once __DIR__ .'/../../config/models.php';

    class Store extends Model {
        protected static $table = 'stores';

        protected static $schema = [
            'vendor_id'     => ['type' => 'VARCHAR(100)', 'required' => true, 'unique' => true], // Assuming it's a unique identifier
            'store_name'    => ['type' => 'VARCHAR(255)', 'required' => true],
            'logo'          => ['type' => 'VARCHAR(255)'], // Optional, assuming not required
            'banner'        => ['type' => 'VARCHAR(255)'], // Optional
            'about'         => ['type' => 'TEXT'], // Longer text content
            'contact_email' => ['type' => 'VARCHAR(255)', 'required' => true],
            'phone_number'  => ['type' => 'VARCHAR(50)'], // Assuming phone numbers are optional
            'address'       => ['type' => 'VARCHAR(255)'], // Assuming optional
            'created_at'    => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'    => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ];


        protected static $rules = [
            'vendor_id'     => 'string|required|unique:stores,vendor_id',
            'store_name'    => 'string|required',
            'logo'          => 'string',
            'banner'        => 'string',
            'about'         => 'string',
            'contact_email' => 'string|required|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/',
            'phone_number'  => 'string',
            'address'       => 'string'
        ];
    }
