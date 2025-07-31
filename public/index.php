<?php
// public/index.php

// Mostrar errores de PHP (útil durante el desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar configuración principal
require_once __DIR__ . '/../app/config/config.php';

// Autocargador simple para clases en app/core y app/controllers
spl_autoload_register(function ($className) {
    $corePath = __DIR__ . '/../app/core/' . $className . '.php';
    $controllerPath = __DIR__ . '/../app/controllers/' . $className . '.php';
    $modelPath = __DIR__ . '/../app/models/' . $className . '.php'; // Añadido para modelos

    if (file_exists($corePath)) {
        require_once $corePath;
    } elseif (file_exists($controllerPath)) {
        require_once $controllerPath;
    } elseif (file_exists($modelPath)) { // Añadido para modelos
        require_once $modelPath;
    }
});

// Cargar configuración (si es necesario globalmente antes del router)
// require_once __DIR__ . '/../app/config/config.php'; // Si tienes un archivo de config general
require_once __DIR__ . '/../app/config/bd.php'; // Para la conexión a BD, si los controladores la necesitan directamente

// Iniciar sesión si no está iniciada (muchos controladores la necesitarán)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar el Router
$router = new Router();

// (Las rutas se añaden en el constructor del Router por ahora)

// Despachar la ruta
$router->dispatch();

?>
