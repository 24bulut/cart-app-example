<?php

class Route
{

    public static function get($url, $actions)
    {
        self::fetch($url, $actions,__FUNCTION__);
    }

    public static function post($url, $actions)
    {
        self::fetch($url, $actions,__FUNCTION__);
    }

    public static function delete($url, $actions)
    {
        self::fetch($url, $actions,__FUNCTION__);
    }
    
    public static function put($url, $actions)
    {
        self::fetch($url, $actions,__FUNCTION__);
    }

    private static function fetch($url,$actions,$method)
    {
        $patterns = [
            '{id}' => '([0-9]+)'
        ];
        $url = str_replace(array_keys($patterns), array_values($patterns), $url);
        preg_match('@^' .  $url. '$@', $_GET['url'], $matched);

        if ($_SERVER['REQUEST_METHOD']==strtoupper($method) && count($matched)>0) {
            unset($matched[0]);
            $parameters = array_values($matched);
            
            $actions = explode('@',$actions);
            $actionMethod = !isset($actions[1]) || $actions[1] ==="" ? 'index': $actions[1];
            $controller =$actions[0];
            $controllerFile = __DIR__ . '/Controllers/' . strtolower($controller) . '.php';
            $controllerClass = "App\Controllers\\".$actions[0];
            if (file_exists($controllerFile)) {
                require $controllerFile;
                call_user_func_array([new $controllerClass, $actionMethod], $parameters);
            }

            exit;
        }
    }

    
}


