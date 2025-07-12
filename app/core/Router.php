<?php
// app/core/Router.php

class Router {
    protected $routes = [];
    protected $params = [];

    public function __construct() {
        // Rutas para la autenticación
        $this->addRoute('login', 'AuthController@showLoginForm', 'GET'); // Mostrar formulario de login
        $this->addRoute('login', 'AuthController@login', 'POST');    // Procesar datos de login
        $this->addRoute('logout', 'AuthController@logout', 'GET');   // Cerrar sesión

        // Ejemplo de otras rutas que podrías añadir:
        // $this->addRoute('', 'PagesController@index'); // Ruta raíz

        // Rutas del panel de Administración
        $this->addRoute('admin/dashboard', 'AdminController@dashboard', 'GET');

        // Usuarios
        $this->addRoute('admin/usuarios', 'AdminController@listUsuarios', 'GET');
        // Como el formulario de crear/editar es un modal en la misma página de listUsuarios,
        // no necesitamos rutas GET separadas para mostrar los formularios.
        // Solo necesitamos las rutas POST para procesar los datos.
        $this->addRoute('admin/usuarios/store', 'AdminController@storeUsuario', 'POST');    // Procesar creación
        $this->addRoute('admin/usuarios/update', 'AdminController@updateUsuario', 'POST'); // Procesar actualización (ID vendrá en POST)
        $this->addRoute('admin/usuarios/delete', 'AdminController@deleteUsuario', 'POST'); // Procesar eliminación (ID vendrá en POST)

        // Postulantes (Placeholder)
        $this->addRoute('admin/postulantes', 'AdminController@listPostulantes', 'GET');
        // Evaluadores (Placeholder)
        $this->addRoute('admin/evaluadores', 'AdminController@listEvaluadores', 'GET');
        // Expertos (Placeholder)
        $this->addRoute('admin/expertos', 'AdminController@listExpertos', 'GET');
    }

    /**
     * Añade una ruta a la tabla de enrutamiento.
     * @param string $route La expresión regular de la ruta
     * @param string $controllerAction El controlador y método (ej. "PagesController@index")
     * @param string $method El método HTTP (GET, POST, etc.)
     */
    public function addRoute($route, $controllerAction, $method = 'GET') {
        // Convertir la ruta simple (ej. 'posts/show/{id}') a una expresión regular
        // Este es un ejemplo muy básico
        $routeRegex = preg_replace('/\//', '\\/', $route); // Escapar slashes
        $routeRegex = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z0-9-]+)', $routeRegex); // Convertir {param} a named capture group
        $routeRegex = '/^' . $routeRegex . '$/i'; // Delimitadores y case-insensitive

        $this->routes[$method][$routeRegex] = $controllerAction;
    }

    /**
     * Analiza la URL actual y la compara con las rutas definidas.
     * @param string $url La URL a procesar (generalmente de $_SERVER['REQUEST_URI'])
     * @param string $method El método HTTP actual (generalmente de $_SERVER['REQUEST_METHOD'])
     * @return bool True si se encontró una ruta, False en caso contrario.
     */
    public function match($url, $method = 'GET') {
        if (!isset($this->routes[$method])) {
            return false; // No hay rutas para este método HTTP
        }

        foreach ($this->routes[$method] as $routeRegex => $controllerAction) {
            if (preg_match($routeRegex, $url, $matches)) {
                // Extraer parámetros de la URL (named capture groups)
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $this->params[$key] = $match;
                    }
                }

                // Separar controlador y acción
                list($controller, $action) = explode('@', $controllerAction);
                $this->params['controller'] = $controller;
                $this->params['action'] = $action;
                return true;
            }
        }
        return false;
    }

    /**
     * Despacha la ruta: crea el controlador y ejecuta la acción.
     */
    public function dispatch() {
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if ($this->match($url, $method)) {
            $controllerName = $this->params['controller'];
            $actionName = $this->params['action'];

            // Asegurarse de que el nombre del controlador termina en 'Controller'
            if (strpos($controllerName, 'Controller') === false) {
                $controllerName .= 'Controller';
            }

            $controllerFile = '../app/controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controllerName)) {
                    $controllerInstance = new $controllerName($this->params); // Pasar parámetros al constructor
                    if (method_exists($controllerInstance, $actionName)) {
                        call_user_func_array([$controllerInstance, $actionName], []); // Llamar a la acción
                    } else {
                        echo "Error: Método {$actionName} no encontrado en el controlador {$controllerName}.";
                        // Aquí podrías lanzar una excepción o mostrar una página 404
                    }
                } else {
                    echo "Error: Clase controladora {$controllerName} no encontrada en {$controllerFile}.";
                    // Aquí podrías lanzar una excepción o mostrar una página 404
                }
            } else {
                echo "Error: Archivo de controlador {$controllerFile} no encontrado.";
                // Aquí podrías lanzar una excepción o mostrar una página 404
            }
        } else {
            echo "Error: No se encontró la ruta para la URL {$url} con el método {$method}.";
            // Aquí podrías mostrar una página 404
        }
    }

    public function getParams() {
        return $this->params;
    }
}
?>
