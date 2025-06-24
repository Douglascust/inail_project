<?php
/**
 * Router.class.php
 * @package ZaitTinyFrameworkPHP
 * @author  Msc Cleber Silva de Oliveira, Yossef Zait
 * @version 0.0.0.1
 * @see     https://cleberoliveira.info
 *
 * Classe Router
 *
 * Classe responsável por lidar com o roteamento de requisições HTTP na aplicação.
 * Ela define as rotas com base em um arquivo JSON e direciona a requisição para o arquivo físico correspondente.
 * Além disso, utiliza a classe Sanitize para garantir a segurança das requisições.
 *
 * O arquivo routes.json utilizado para configurar as rotas deve ser um JSON válido onde:
 *
 * - As chaves são os nomes das rotas. Exemplos: "home", "about", "contact", "404".
 *   Quando alguém acessar a URL da sua aplicação seguida por uma dessas rotas,
 *   a aplicação irá carregar o arquivo correspondente no campo "path".
 *
 * - Os valores são objetos com três campos:
 *   "path": Caminho para o arquivo PHP que deverá ser carregado quando a rota for acessada.
 *      Por exemplo, se você tem uma rota "home" e o campo "path" for "app/views/home.php",
 *      quando alguém acessar a URL da sua aplicação seguida por /home,
 *      a aplicação irá carregar o arquivo app/views/home.php.
 *
 *   "sanitize": Objeto contendo três campos booleanos ("requestVars", "code", "sql")
 *      que indicam se variáveis de requisição, códigos e SQL devem ser sanitizados.
 *      Se algum desses campos estiver setado como true,
 *      a aplicação irá utilizar a classe Sanitize para limpar as requisições HTTP, o código ou o SQL.
 *
 *   "sessionKey": Array contendo os critérios de acesso à página.
 *      Cada elemento do array pode ser:
 *      - Um valor booleano: Será verificado se a sessão existe e se o valor é diferente de false ou 0.
 *      - Um valor numérico ou string: Será verificado se a sessão existe e se o valor é igual.
 *      - Um array: Será verificado se a sessão existe e se o valor está em um dos elementos true do array.
 *
 * @package core
 */

namespace core\utils;

class Router {
    
    /**
     * @var array Array contendo todas as rotas configuradas
     */
    private $routes = [];
    
    /**
     * Construtor da classe
     *
     * Carrega as rotas a partir de um arquivo JSON.
     *
     * @param string $routersJSonFileName Caminho para o arquivo JSON com as rotas normalmente app/etc/routes.json
     */
    public function __construct($routersJSonFileName) {
        
        global $rootPath;
        
        $json = file_get_contents($routersJSonFileName);
        $routes = json_decode($json, true);
        
        foreach ($routes as $path => $route) {
            $this->addRoute($path, $rootPath . "/" . $route['path'], $route['sanitize'], $route['sessionKey'] ?? null);
        }
    }
    
    /**
     * Adiciona uma rota
     *
     * @param string $requiredPath Caminho requisitado
     * @param string $physicalPath Caminho físico para o arquivo
     * @param array $sanitizeConfig Configurações de sanitização
     * @param array|null $sessionKey Critérios de acesso à página
     */
    public function addRoute($requiredPath, $physicalPath, $sanitizeConfig, $sessionKey) {
        $this->routes[$requiredPath] = [
            'path' => $physicalPath,
            'sanitize' => $sanitizeConfig,
            'sessionKey' => $sessionKey,
        ];
    }
    
    /**
     * Executa o roteamento
     *
     * Busca a rota requisitada e direciona para o arquivo correspondente, sanitizando as requisições HTTP
     *
     * @param string $module Módulo a ser acessado (opcional)
     * @param array $params Parâmetros da requisição (opcional)
     */
    public function dispatch($module = null, $params = null) {
        
        // var_dump( $module );
        if (isset($this->routes[$module]) && file_exists($this->routes[$module]['path'])){
            $route = $this->routes[$module];
            
           echo (($route['sessionKey']==true)?$route['sessionKey'] . "<br>":"");
           if ($route['sessionKey'] !== null) {
               $sessionKeys = $route['sessionKey'];
               $accessGranted = true;
               foreach ($sessionKeys as $sessionKey) {
                   foreach ($sessionKey as $key => $value) {
                       if ($value == true) {
                           if (!isset($_SESSION[$key]) || $_SESSION[$key] == false ) {
                               $accessGranted = false;
                           }
                       } elseif (is_array($value)) {
                           if (!isset($_SESSION[$key]) || !in_array($_SESSION[$key], $value)) {
                               $accessGranted = false;
                           }
                       } else {
                           if (!isset($_SESSION[$key]) || $_SESSION[$key] !== $value) {
                               $accessGranted = false;
                           }
                       }
                   }
               }
                
               if (!$accessGranted) {
                   echo (isset($route['errorPath'])?$route['errorPath'] . "<br>":"");

                   if (isset($route['errorPath']) && $route['errorPath'] !== null) {
                       require $route['errorPath'];
                   }else{
                       $this->notFound();
                   }
                   return;
               }
            }
            
            $sanitize = new Sanitize(
                $route['sanitize']['requestVars'],
                $route['sanitize']['code'],
                $route['sanitize']['sql']
                );
            $sanitize->clearRequestHttp();
            
            require $route['path'];
        } else {
            if ($route['errorPath'] !== null) {
                require $route['errorPath'];
            }else{
                $this->notFound();
            }
            
        }
    }
    
    /**
     * Método para verificar os critérios de acesso à página
     *
     * @param array $sessionKey Critérios de acesso à página
     * @return bool True se o acesso for permitido, False caso contrário
     */
    private function checkSessionKey($sessionKey) {
        foreach ($sessionKey as $criteria) {
            foreach ($criteria as $key => $value) {
                if ($value === true) {
                    if (!isset($_SESSION[$key]) || $_SESSION[$key] === false || $_SESSION[$key] === 0) {
                        return false;
                    }
                } elseif (is_array($value)) {
                    if (!isset($_SESSION[$key]) || !in_array($_SESSION[$key], $value)) {
                        return false;
                    }
                } else {
                    if (!isset($_SESSION[$key]) || $_SESSION[$key] !== $value) {
                        return false;
                    }
                }
            }
        }
        
        return true;
    }
    
    /**
     * Método para lidar com rotas não encontradas
     *
     * Redireciona para uma página 404 personalizada quando uma rota não é encontrada.
     */
    public function notFound() {
        if (isset($this->routes['404']) && file_exists($this->routes['404']['path'])) {
            require $this->routes['404']['path'];
        } else {
            print_r($_GET);
            print_r($_POST);
            header('HTTP/1.0 404 Not Found');
            echo "404 - Page not found.";
        }
    }
}
?>
