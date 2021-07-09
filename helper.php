<?php
//PSR-4
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'App\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

function view($page,$params=array())
{
    if($page != 'login' && $page != 'register') require  __DIR__ . '/Views/Static/header.php';
    require  __DIR__ . '/Views/' . strtolower($page) . '.php';
    if($page != 'login'  && $page != 'register') require  __DIR__ . '/Views/Static/footer.php';
}


define("URL", $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].str_ireplace("/index.php","",$_SERVER["SCRIPT_NAME"]));
function url($page = ""){
    return URL."/".$page;
}

if (!isset($_GET['url'])) {
    $_GET['url']='/';
}

function response($message){
    if (is_array($message)) {
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
    }else {
      if(is_object($message)){
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
      }
      else echo '{"message":"'.$message.'"}';
    }
}