<?php
// app/models/EvaluadorModel.php

class EvaluadorModel extends Model {

    /**
     * Obtiene todos los evaluadores de la base de datos.
     * TODO: Definir la estructura real de la tabla y consulta.
     * @return array Arreglo de evaluadores o array vacío si no hay.
     */
    public function getAllEvaluadores() {
        // Ejemplo de consulta, necesitarás adaptarla a tu tabla real 'evaluadores'
        // $sql = "SELECT id_evaluador, nombre_completo, especialidad, norma_asignada, email FROM evaluadores ORDER BY nombre_completo ASC";
        $sql = "SELECT * FROM evaluadores ORDER BY nombre ASC"; // Asumiendo tabla 'evaluadores' y columna 'nombre'

        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en EvaluadorModel::getAllEvaluadores: " . $e->getMessage());
            // Para la prueba inicial, si la tabla no existe, devolvemos un array vacío.
            // En un caso real, esto podría indicar un problema más serio.
            return [];
        }
    }

    // Aquí irán más métodos para CRUD de evaluadores si son necesarios.
}
?>
