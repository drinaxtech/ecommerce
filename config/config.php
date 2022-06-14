<?php

    define('DEBUG', true);

    define('DEFAULT_CONTROLLER', 'Product'); // default controller
    define('DEFAULT_LAYOUT', 'default'); // default layout

    define('SITE_TITLE', 'Ecommerce PHP MVC'); // default site title

    $project_path = 'ecommerce';

    switch (strtolower($_SERVER['HTTP_HOST']))
    {
        case 'domain.com':
            $BASE_URL  = "https://".$_SERVER['HTTP_HOST'] . DS . $project_path .DS;
            break;
        case '127.0.0.1':
        case 'localhost':
            $BASE_URL  = "http://".$_SERVER['HTTP_HOST'] . DS . $project_path . DS;
            break;
        default:
            $BASE_URL  = "http://".$_SERVER['HTTP_HOST'] . DS . $project_path. DS;
            break;
    }

    define('BASE_URL', str_replace('\\', '/', $BASE_URL));