<?php

include_once '../configuraciones/bd.php';
$conexion = BD::crearInstancia();

$accion = $_POST['accion'] ?? '';
$idusuario = $_POST['idusuario'] ?? '';
$nombre = $_POST['modal_nombre'] ?? '';
$apellidos = $_POST['modal_apellido'] ?? '';
$usuario = $_POST['modal_usuario'] ?? '';
$password = $_POST['modal_password'] ?? '';
$correo = $_POST['modal_correo'] ?? '';
$cargo = $_POST['modal_cargo'] ?? '';
$rol= $_POST['rol'] ?? '' ;

// Guardar nuevo usuario
if ($accion === 'guardar_modal') {
    $sql = "INSERT INTO `usuario` (nombre, apellido, usuario, password, correo, cargo, rol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $apellido, $usuario, $password, $correo, $cargo, $rol]);
}

// Actualizar usuario existente
if ($accion === 'editar_modal') {
    $sql = "UPDATE `usuario` SET nombre=?, apellido=?, usuario=?, password=?, correo=?, cargo=?, rol=? WHERE idusuario=?";
    $idusuario = $_POST['idusuario'] ?? '';
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $apellido, $usuario, $password, $correo, $cargo, $rol, $idusuario]);
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