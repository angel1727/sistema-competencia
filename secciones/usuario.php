<?php

include_once '../configuraciones/bd.php';
$conexion = BD::crearInstancia();

$accion = $_POST['accion'] ?? '';
$id = $_POST['id'] ?? '';
$nombre = $_POST['modal_nombre'] ?? '';
$apellidos = $_POST['modal_apellidos'] ?? '';
$usuario = $_POST['modal_usuario'] ?? '';
$password = $_POST['modal_password'] ?? '';
$correo = $_POST['modal_correo'] ?? '';
$cargo = $_POST['modal_cargo'] ?? '';

// Guardar nuevo usuario
if ($accion === 'guardar_modal') {
    $sql = "INSERT INTO `usuario` (nombre, apellidos, usuario, password, correo, cargo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $usuario, $password, $correo, $cargo]);
}

// Actualizar usuario existente
if ($accion === 'editar_modal') {
    $sql = "UPDATE `usuario` SET nombre=?, apellidos=?, usuario=?, password=?, correo=?, cargo=? WHERE idusuario=?";
    $idusuario = $_POST['idusuario'] ?? '';
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idusuario, $nombre, $apellidos, $usuario, $password, $correo, $cargo]);
}

// Eliminar usuario
if ($accion === 'eliminar') {
    $sql = "DELETE FROM `usuario` WHERE `usuario`.`idusuario` = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idusuario]);
}

// Cargar usuarios para la tabla
$listaUsuarios = $conexion->query("SELECT * FROM `usuario`")->fetchAll(PDO::FETCH_ASSOC);
?>