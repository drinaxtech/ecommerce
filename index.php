<?php
    use Core\Session;
    use Core\Cookie;
    use Core\Router;
    use App\Models\Users;

    
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(__FILE__));

  // Autoload classes
  function autoload($className){
    $classAry = explode('\\',$className);
    $class = array_pop($classAry);
    $subPath = strtolower(implode(DS,$classAry));
    $path = ROOT . DS . $subPath . DS . $class . '.php';
    if(file_exists($path)){
      require_once($path);
    }
  }

  if(file_exists(ROOT . DS . 'config/config.php')){
    require_once(ROOT . DS . 'config/config.php');
  }
  
  spl_autoload_register('autoload');

  session_start();

  $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

  // Route the request
  Router::route($url);