<?php

require_once 'app/core/database/DBConnection.php';

/**
 * index.php
 * @package ZaitTinyFrameworkPHP
 * @author  Msc Cleber Silva de Oliveira, Yossef Zait
 * @version 0.0.0.1
 * @see     https://cleberoliveira.info
 */

use core\utils\Router;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Diretório raiz da aplicação
$rootPath = __DIR__; // Diretório Raiz  
// Arquivo de Configuraões 
$config = array();  // é necessário global pra usar $config em '/app/etc/config.php'
require_once $rootPath . '/app/etc/config.php';
require_once $rootPath . '/autoload.php'; // Arquivo do Autoloader de classes
 
$router = new Router();
// se uri estiver vazia considera chamar a rota de home
$module = ( !empty($_GET["uri"] ) ? $_GET["uri"]: "index");
$router->dispatch( $module );
/**
* Este é o script principal de inicialização para a aplicação.
 * Ele define algumas variáveis úteis, lida com a configuração,
 * realiza o autoload de classes e inicia a roteamento da aplicação.
 *
 * As seguintes operações são realizadas, em ordem:
 *
 * 1. Importa a classe Router do namespace core.
 * 2. Define $rootPath como o diretório atual, que será usado posteriormente para resolver caminhos na aplicação.
 * 3. Define $folderBase como o caminho relativo entre o diretório raiz do servidor e o diretório atual.
 * 4. Inclui o arquivo de configuração principal, o autoloader de classes, e a classe Router.
 * 5. Se a sessão PHP ainda não foi iniciada, inicia uma.
 * 6. Define $routersFile como o caminho para o arquivo json que contém as rotas da aplicação.
 * 7. Cria uma nova instância da classe Router, passando o arquivo de rotas como argumento.
 * 8. Chama o método dispatch() na instância do Router para iniciar a roteamento da aplicação.
 *
 * Requisitos:
 * - PHP 7.4 ou superior e Mysql 8.1 ou superior; 
 * - A extensão json do PHP deve estar habilitada.
 * - O arquivo app/etc/config.php deve existir e ser válido.
 * - O autoloader em autoload.php deve estar funcionando corretamente.
 * - A classe Router deve estar definida em core/Router.class.php e ser carregável pelo autoloader.
 * - O arquivo de rotas em app/etc/routes.json deve existir e ser um JSON válido.
 * 
 */
?>