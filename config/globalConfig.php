<?php
    $host = $_SERVER['HTTP_HOST'];
    define('BASE_PATH', ($host === 'localhost' || $host === 'localhost:8080' ) ? '/apps/public/' : '/');
