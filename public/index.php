<?php
// chemins importants de l'arbo
define('ROOT_PATH', dirname(__DIR__));
define('LIB_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'library');
define('VIEW_PATH', ROOT_PATH . '/application/Views/');
define('LAYOUT_PATH', ROOT_PATH . '/application/Layouts/');

// Ajoute les chemins nécessaire dans l'include path : library,...
set_include_path('.' . PATH_SEPARATOR 
				  . LIB_PATH . PATH_SEPARATOR 
				  . ROOT_PATH
			 );


defined('ENV') || define('ENV', (getenv('ENV') === 'development')?'development':'production');

if(ENV === "development")
	ini_set('display_errors', '1');

// Mise en place de l'autoloading PSR-0
require_once 'My/Autoloader.php';
spl_autoload_register(array('\My\Autoloader', 'autoload'));

// Code de l'application
 
$request = new \My\Request(); 
$response = new \My\Response();

// routage
$router = new \My\Router($request);
$router->route();

// Dispatching
$dispatcher = new \My\Dispatcher($request, $response);
$dispatcher->dispatch();

// Envoi de la réponse
$response->send();