<?php
// app/core/Controller.php

class Controller {

    /**
     * Carga una vista.
     * Los datos se pasan a la vista a través del array $data, que se extrae
     * para que sus claves estén disponibles como variables en el archivo de la vista.
     *
     * @param string $view Nombre de la vista (ej. 'pages/about' buscará en app/views/pages/about.php)
     * @param array $data Datos para pasar a la vista
     */
    public function view($viewName, $data = []) {
        $viewFile = __DIR__ . '/../views/' . $viewName . '.php'; // Ruta ajustada

        if (file_exists($viewFile)) {
            extract($data); // Hace que $data['title'] esté disponible como $title en la vista

            // Iniciar buffering de salida para poder incluir cabeceras/pies si es necesario
            ob_start();
            require $viewFile;
            $content = ob_get_clean(); // Obtener el contenido de la vista principal

            // Aquí podrías tener una lógica para incluir un layout/plantilla principal
            // que envuelva $content, si todas tus vistas usan la misma estructura.
            // Por ejemplo:
            // require __DIR__ . '/../views/layouts/main.php';
            // donde main.php usaría la variable $content.
            // Por ahora, simplemente imprimimos el contenido.
            echo $content;

        } else {
            // Si la vista no existe, podrías lanzar una excepción o mostrar un error 404
            die('Error: Vista no encontrada en ' . $viewFile);
        }
    }

    /**
     * Carga e instancia un modelo.
     *
     * @param string $modelName Nombre del modelo (ej. 'User' buscará User.php o UserModel.php)
     * @return object|null Instancia del modelo o null si no se encuentra.
     */
    public function model($modelName) {
        // Construir el nombre del archivo del modelo. Podría ser solo ModelName.php o ModelNameModel.php
        $modelFileSimple = __DIR__ . '/../models/' . ucfirst($modelName) . '.php';
        $modelFileWithSuffix = __DIR__ . '/../models/' . ucfirst($modelName) . 'Model.php';

        $modelFileToLoad = null;
        $classNameToInstantiate = null;

        if (file_exists($modelFileWithSuffix)) {
            $modelFileToLoad = $modelFileWithSuffix;
            $classNameToInstantiate = ucfirst($modelName) . 'Model';
        } elseif (file_exists($modelFileSimple)) {
            $modelFileToLoad = $modelFileSimple;
            $classNameToInstantiate = ucfirst($modelName);
        }

        if ($modelFileToLoad) {
            require_once $modelFileToLoad; // El autoloader ya debería manejar esto si está configurado para models
            if (class_exists($classNameToInstantiate)) {
                return new $classNameToInstantiate();
            }
        }

        // Si el modelo no se encuentra o la clase no existe
        // die('Error: Modelo no encontrado: ' . $modelName);
        return null; // O lanzar una excepción
    }

    /**
     * Redirige a otra URL.
     * @param string $location La ruta a la que redirigir (ej. 'users/login')
     */
    protected function redirect($location) {
        // Asegurarse de que la URL base está bien gestionada si es necesario
        // Por ahora, asumimos que $location es una ruta relativa a la raíz del sitio.
        // Si $location no empieza con '/', se la añadimos.
        if (strpos($location, '/') !== 0) {
            $location = '/' . $location;
        }
        header('Location: ' . $location);
        exit;
    }
}
?>
