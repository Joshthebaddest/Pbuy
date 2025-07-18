<?php
    $host = $_SERVER['HTTP_HOST'];
    define('BASE_PATH', ($host === 'localhost') ? '/pbuy/public/' : '/');
