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


    // DATABASE CONFIGURATION
    define('DB_NAME', 'ecommerce');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', '127.0.0.1');

    define('CURRENT_USER_SESSION_NAME', 'kwXeusqldkiIKjehsLQZJFKJ'); //session name for logged in user
    define('REMEMBER_ME_COOKIE_NAME', 'JAJEI6382LSJVlkdjfh3801jvD'); // cookie name for logged in user remember me
    define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live (30 days)
    define('ACCESS_RESTRICTED', 'Restricted');