<?php
// app/models/PostulanteModel.php

class PostulanteModel extends Model {

    /**
     * Obtiene todos los postulantes de la base de datos.
     * @return array Arreglo de postulantes o array vacío si no hay.
     */
    public function getAllPostulantes() {
        // Tomado de legacy_postulantes_crud.php
        $sql = "SELECT * FROM postulante ORDER BY apellido ASC, nombre ASC";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en PostulanteModel::getAllPostulantes: " . $e->getMessage());
            return [];
        }
    }

    // Aquí irán más métodos para CRUD de postulantes:
    // getPostulanteById($id)
    // crearPostulante($data) // Este será complejo, involucrando múltiples tablas y transacciones
    // actualizarPostulante($id, $data) // Igualmente complejo
    // eliminarPostulante($id)
    //
    // Y métodos para obtener datos relacionados (educación, experiencia, etc.) por idpostulante.
}
?>
