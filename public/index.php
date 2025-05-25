<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/config/database.php';

// Autoload de clases
spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    $file = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Router simple
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Mapeo de controladores con namespaces completos
$controllers = [
    'home' => 'App\\Controllers\\HomeController',
    'auth' => 'App\\Controllers\\AuthController',
    'image' => 'App\\Controllers\\ImageController'
];

// Ejecutar controlador
if (isset($controllers[$controller])) {
    $controllerName = $controllers[$controller];
    
    if (class_exists($controllerName)) {
        $controllerInstance = new $controllerName();
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Acción no encontrada";
        }
    } else {
        header('HTTP/1.0 404 Not Found');
        echo "Controlador no encontrado";
    }
} else {
    header('HTTP/1.0 404 Not Found');
    echo "Ruta no encontrada";
}
// Agregar al inicio del archivo, después de session_start()
//define('BASE_PATH', dirname(__DIR__));
?>
