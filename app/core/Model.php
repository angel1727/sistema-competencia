<?php
// app/core/Model.php

class Model {
    protected $db; // Instancia de la conexión PDO

    public function __construct() {
        // La clase BD y su archivo app/config/bd.php ya deberían estar cargados
        // por el autoloader o el index.php.
        // Aquí obtenemos la instancia de la conexión.

        // Verificar si la clase BD existe antes de llamarla
        if (!class_exists('BD')) {
            // Esto podría pasar si el autoloader no está configurado para 'config'
            // o si bd.php no se incluyó explícitamente antes.
            // El public/index.php actual ya incluye 'app/config/bd.php'.
            // require_once __DIR__ . '/../config/bd.php'; // Descomentar si es necesario
        }

        $this->db = BD::crearInstancia();

        if (!$this->db) {
            // Manejar el caso en que la conexión falle, aunque BD::crearInstancia() ya usa die().
            // Podrías lanzar una excepción más específica aquí si lo prefieres.
            die("Error crítico: No se pudo establecer la conexión a la base de datos en la clase Model base.");
        }
    }

    // Aquí podrías añadir métodos comunes para todos los modelos,
    // como métodos CRUD básicos genéricos si tu estructura de BD lo permite,
    // o métodos para preparar y ejecutar consultas de forma más sencilla.

    /**
     * Ejemplo: Ejecutar una consulta SQL y obtener todos los resultados.
     * ¡ATENCIÓN! Usar con precaución. Preferir sentencias preparadas para evitar inyección SQL.
     * Este es un ayudante muy genérico.
     *
     * @param string $sql La consulta SQL.
     * @param array $params Parámetros para sentencias preparadas (si se adapta).
     * @param int $fetchMode Modo de obtención de PDO (PDO::FETCH_ASSOC, PDO::FETCH_OBJ, etc.)
     * @return array|false Array de resultados o false en caso de error.
     */
    public function queryAll($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll($fetchMode);
        } catch (PDOException $e) {
            // En un entorno de producción, deberías loggear este error en lugar de mostrarlo.
            // die("Error en consulta: " . $e->getMessage());
            error_log("Error en consulta Model::queryAll: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Ejemplo: Ejecutar una consulta SQL y obtener una sola fila.
     * ¡ATENCIÓN! Usar con precaución. Preferir sentencias preparadas.
     *
     * @param string $sql La consulta SQL.
     * @param array $params Parámetros para sentencias preparadas.
     * @param int $fetchMode Modo de obtención de PDO.
     * @return mixed|false Un solo resultado o false en caso de error/no encontrado.
     */
    public function queryOne($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch($fetchMode);
        } catch (PDOException $e) {
            error_log("Error en consulta Model::queryOne: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Ejemplo: Ejecutar una sentencia (INSERT, UPDATE, DELETE).
     *
     * @param string $sql La consulta SQL.
     * @param array $params Parámetros para sentencias preparadas.
     * @return int|false Número de filas afectadas o false en caso de error.
     */
    public function executeStatement($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Error en consulta Model::executeStatement: " . $e->getMessage());
            return false;
        }
    }
}
?>
