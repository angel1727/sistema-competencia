<?php
// app/models/ExpertoModel.php

class ExpertoModel extends Model {

    /**
     * Obtiene todos los expertos de la base de datos.
     * TODO: Definir la estructura real de la tabla y consulta.
     * @return array Arreglo de expertos o array vacío si no hay.
     */
    public function getAllExpertos() {
        // Ejemplo de consulta, necesitarás adaptarla a tu tabla real 'expertos'
        // $sql = "SELECT id_experto, nombre_completo, area_experticia, norma_iso, email FROM expertos ORDER BY nombre_completo ASC";
        $sql = "SELECT * FROM expertos ORDER BY nombre ASC"; // Asumiendo tabla 'expertos' y columna 'nombre'

        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ExpertoModel::getAllExpertos: " . $e->getMessage());
            return [];
        }
    }

    // Aquí irán más métodos para CRUD de expertos si son necesarios.
}
?>
