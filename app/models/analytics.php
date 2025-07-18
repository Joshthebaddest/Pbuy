<?php
    require_once __DIR__ . '/Model.php';

    class ProductAnalytics extends Model {
        protected static $table = 'product_analytics';

        protected static $schema = [
            'product_id' => ['type' => 'INT', 'required' => true], // ID of the product being analyzed
            'views'      => ['type' => 'INT', 'default' => 0], // Number of views
            'clicks'     => ['type' => 'INT', 'default' => 0], // Number of clicks
            'purchases'  => ['type' => 'INT', 'default' => 0], // Number of purchases
            'date'       => ['type' => 'DATE', 'required' => true], // Date of the analytics record
        ];


        protected static $rules = [
            'product_id' => 'int|required',
            'views'      => 'int|required',
            'clicks'     => 'int|required',
            'purchases'  => 'int|required',
            'date'       => 'date|required',
        ];
    }
?>