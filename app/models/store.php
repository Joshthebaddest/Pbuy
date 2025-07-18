<?php

   require_once __DIR__ .'/../../config/models.php';

    class Store extends Model {
        protected static $table = 'stores';

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
