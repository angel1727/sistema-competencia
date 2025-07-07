<?php
// app/models/UsuarioModel.php

class UsuarioModel extends Model {

    // El constructor de la clase base Model ya establece $this->db

    /**
     * Obtiene todos los usuarios de la base de datos.
     * @return array Arreglo de usuarios o array vacío si no hay.
     */
    public function getAllUsuarios() {
        // Columnas según legacy_usuarios_crud.php: idusuario, nombre, apellido, usuario, password, correo, cargo, rol
        $sql = "SELECT idusuario, nombre, apellido, usuario, correo, cargo, rol FROM usuario ORDER BY nombre ASC";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel::getAllUsuarios: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene un usuario específico por su ID.
     * @param int $idusuario El ID del usuario.
     * @return mixed Objeto o array asociativo del usuario, o false si no se encuentra.
     */
    public function getUsuarioById($idusuario) {
        $sql = "SELECT idusuario, nombre, apellido, usuario, correo, cargo, rol FROM usuario WHERE idusuario = :idusuario";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel::getUsuarioById: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Crea un nuevo usuario.
     * @param array $data Datos del usuario. Debe incluir 'password_hash' para la contraseña hasheada.
     * @return string|false El ID del nuevo usuario insertado (lastInsertId), o false en caso de error.
     */
    public function crearUsuario($data) {
        // Columnas: nombre, apellido, usuario, password, correo, cargo, rol
        // $data debe contener: nombre, apellido, usuario, password_hash, correo, cargo, rol
        $sql = "INSERT INTO usuario (nombre, apellido, usuario, password, correo, cargo, rol)
                VALUES (:nombre, :apellido, :usuario, :password_hash, :correo, :cargo, :rol)";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':usuario', $data['usuario']);
            $stmt->bindParam(':password_hash', $data['password_hash']); // Contraseña ya hasheada
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':cargo', $data['cargo']);
            $stmt->bindParam(':rol', $data['rol']);

            if ($stmt->execute()) {
                return $this->db->lastInsertId();
            } else {
                error_log("Error en UsuarioModel::crearUsuario - Execute failed: " . implode(":", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel::crearUsuario - PDOException: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza un usuario existente.
     * @param int $idusuario El ID del usuario a actualizar.
     * @param array $data Datos a actualizar. Si incluye 'password_hash', se actualiza la contraseña.
     * @return bool True si la actualización fue exitosa, false en caso contrario.
     */
    public function actualizarUsuario($idusuario, $data) {
        // Campos a actualizar: nombre, apellido, usuario, correo, cargo, rol
        // La contraseña se actualiza si se proporciona 'password_hash' en $data

        $sqlSetParts = [];
        if (isset($data['nombre'])) $sqlSetParts[] = "nombre = :nombre";
        if (isset($data['apellido'])) $sqlSetParts[] = "apellido = :apellido";
        if (isset($data['usuario'])) $sqlSetParts[] = "usuario = :usuario";
        if (isset($data['correo'])) $sqlSetParts[] = "correo = :correo";
        if (isset($data['cargo'])) $sqlSetParts[] = "cargo = :cargo";
        if (isset($data['rol'])) $sqlSetParts[] = "rol = :rol";
        if (isset($data['password_hash'])) $sqlSetParts[] = "password = :password_hash"; // Actualiza la contraseña hasheada

        if (empty($sqlSetParts)) {
            return false; // No hay nada que actualizar
        }

        $sql = "UPDATE usuario SET " . implode(", ", $sqlSetParts) . " WHERE idusuario = :idusuario";

        try {
            $stmt = $this->db->prepare($sql);

            if (isset($data['nombre'])) $stmt->bindParam(':nombre', $data['nombre']);
            if (isset($data['apellido'])) $stmt->bindParam(':apellido', $data['apellido']);
            if (isset($data['usuario'])) $stmt->bindParam(':usuario', $data['usuario']);
            if (isset($data['password_hash'])) $stmt->bindParam(':password_hash', $data['password_hash']);
            if (isset($data['correo'])) $stmt->bindParam(':correo', $data['correo']);
            if (isset($data['cargo'])) $stmt->bindParam(':cargo', $data['cargo']);
            if (isset($data['rol'])) $stmt->bindParam(':rol', $data['rol']);
            $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel::actualizarUsuario: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un usuario por su ID.
     * @param int $idusuario El ID del usuario a eliminar.
     * @return bool True si la eliminación fue exitosa, false en caso contrario.
     */
    public function eliminarUsuario($idusuario) {
        $sql = "DELETE FROM usuario WHERE idusuario = :idusuario";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en UsuarioModel::eliminarUsuario: " . $e->getMessage());
            return false;
        }
    }

    // Podrías añadir un método para encontrar usuario por username (útil para login si no lo hace AuthController)
    // public function findByUsername($username) { ... }
}
?>
