<?php

namespace core\utils;

class Router {
    
    private $routes = [];

    public function __construct() {
        global $rootPath;
        global $config;
        $json = file_get_contents($config['path']['routes']);
        $routes = json_decode($json, true);
        foreach ($routes as $path => $route) {
            $this->addRoute($path, $rootPath . "/" . $route['path'], $route['sanitize']?? null, $route['sessionKey']?? null, $route['errorPath'] ?? null);
        }
        print_r(json_decode($config['path']['routes']));
    }
    
    public function addRoute($requiredPath, $physicalPath, $sanitizeConfig, $sessionKey, $errorPath) {
        $this->routes[$requiredPath] = [
            'path' => $physicalPath,
            'sanitize' => $sanitizeConfig,
            'sessionKey' => $sessionKey,
            'sessionKey' => $sessionKey,
            'errorPath' => $errorPath
        ];
    }
    
    public function dispatch($module = null) {
       
        $accessGranted = false;     

        if (str_starts_with($module ,"public/" )) {
            if (str_ends_with($module ,".css" )) {
                header("Content-type: text/css");
            }
            echo file_get_contents($module);
        } else {
            if (isset($this->routes[$module]) && file_exists($this->routes[$module]['path'])){
                $route = $this->routes[$module];
                if (isset($route['sessionKey'])) {
                    if (isset($route['sessionKey']['idUsuario'])){
                        if( isset($_SESSION['login']['idUsuario']) && ( $route['sessionKey']['idUsuario'] == $_SESSION['login']['idUsuario'])){
                            if (isset($route['sessionKey']['idNivelUsuario'])){
                                if ( in_array( $_SESSION['login']['idNivel'],($route['sessionKey']['idNivelUsuario']))){
                                    $accessGranted = true;
                                } else{
                                    // se for solicitado um idUsuario é igual ao da sessão mas o nível do usuário logado não corresponde ao solicitado 
                                    $accessGranted = false;
                                }
                            } else{
                                // se for solicitado um idUsuario é igual ao da sessão mas não foi solicitado um nível do usuário logado
                                $accessGranted = true;
                            }
                        }else{
                            // se for solicitado um idUsuario e não é igual ao da  sessão
                            $accessGranted = false;
                        }
                    } else{
                        // se não for solicitado um idUsuario de sessão é publico
                        $accessGranted = true;
                    }
                }else{
                    // se não houver qualquer expecificação de restrição de sessão é publico
                    $accessGranted = true;
                }
                         
                if ( $accessGranted ){
                    $sanitize = new Sanitize(
                        $route['sanitize']['requestVars'],
                        $route['sanitize']['code'],
                        $route['sanitize']['sql']
                        );
                    $sanitize->clearRequestHttp();
                    
                    require $route['path'];
                }else{
                    if ($route['errorPath'] !== null) {
                        require $route['errorPath'];
                    }else{
                        $this->notFound();
                    }
                }
            }else{
                $this->notFound();
            }
        }   
    }
    
    
    public function notFound() {

        if (isset($this->routes['404']) && file_exists($this->routes['404']['path'])) {
            require $this->routes['404']['path'];
        } else {
            echo "<hr>".'$_GET:'."<br>";
            print_r($_GET);
            echo "<hr>".'$_POST:'."<br>";
            print_r($_POST);
            echo "<hr>".'$_REQUEST:'."<br>";
            print_r($_REQUEST);
            header('HTTP/1.0 404 Not Found');
            echo "404 - Page not found.";
        }
    }
}

?>
