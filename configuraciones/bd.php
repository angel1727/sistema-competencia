<?php
class BD {
    public static $instancia = null;
    public static function crearInstancia() {
        if (!isset(self::$instancia)) {
            $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try {
                self::$instancia = new PDO('mysql:host=localhost;dbname=prueba1', 'root', '', $opciones);
                // echo "conectado........"; // No imprimir en producción
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>