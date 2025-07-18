<?php
    require_once __DIR__ . '/Model.php';

    class ProductAnalytics extends Model {
        protected static $table = 'product_analytics';

        protected static $rules = [
            'product_id' => 'int|required',
            'views'      => 'int|required',
            'clicks'     => 'int|required',
            'purchases'  => 'int|required',
            'date'       => 'date|required',
        ];
    }
?>