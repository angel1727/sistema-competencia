<?php
// app/config/config.php

// Define el protocolo (http o https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

// Define el nombre del host
$host = $_SERVER['HTTP_HOST'];

// Define la ruta base del proyecto.
// dirname($_SERVER['SCRIPT_NAME']) te da el directorio del script de entrada (index.php).
// Si el proyecto está en la raíz, esto será '/'.
// Si está en un subdirectorio (ej. /mi_proyecto), esto será '/mi_proyecto'.
// Usamos str_replace para asegurarnos de que las barras invertidas de Windows se manejen correctamente.
$base_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// Si la ruta base es solo '/', la hacemos una cadena vacía para evitar dobles slashes en la URL.
if ($base_path === '/') {
    $base_path = '';
}

// Construye la URL base completa
$base_url = $protocol . "://" . $host . $base_path;

// Define la constante BASE_URL para ser usada en toda la aplicación
define('BASE_URL', $base_url);

?>
