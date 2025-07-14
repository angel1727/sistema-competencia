<?php
session_start();

include_once '../configuraciones/bd.php';
$conexion = BD::crearInstancia();

$accion = $_POST['accion'] ?? '';
$idusuario = $_POST['idusuario'] ?? '';
$nombre = $_POST['modal_nombre'] ?? '';
$apellido = $_POST['modal_apellido'] ?? '';
$usuario = $_POST['modal_usuario'] ?? '';
$password = $_POST['modal_password'] ?? '';
$correo = $_POST['modal_correo'] ?? '';
$cargo = $_POST['modal_cargo'] ?? '';
$rol= $_POST['rol'] ?? '' ;

// Guardar nuevo usuario
if ($accion === 'guardar_modal') {
    // Hashear la contraseña antes de guardar
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `usuario` (nombre, apellido, usuario, password, correo, cargo, rol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $apellido, $usuario, $password_hashed, $correo, $cargo, $rol]);
    $_SESSION['mensaje'] = 'Usuario guardado correctamente';
    $_SESSION['tipo'] = 'success';
    header('Location: vista_usuario.php');
    exit();
}

// Actualizar usuario existente
if ($accion === 'editar_modal') {
    $sql = "UPDATE `usuario` SET nombre=?, apellido=?, usuario=?, password=?, correo=?, cargo=?, rol=? WHERE idusuario=?";
    $idusuario = $_POST['idusuario'] ?? '';
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $apellido, $usuario, $password_hashed, $correo, $cargo, $rol, $idusuario]);
    $_SESSION['mensaje'] = 'Usuario actualizado correctamente';
    $_SESSION['tipo'] = 'success';
    header('Location: vista_usuario.php');
    exit();
}

// Eliminar usuario
if ($accion === 'eliminar') {
    $sql = "DELETE FROM `usuario` WHERE `usuario`.`idusuario` = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idusuario]);
    $_SESSION['mensaje'] = 'Usuario eliminado correctamente';
    $_SESSION['tipo'] = 'warning';
    header('Location: vista_usuario.php');
    exit();
}

// Cargar usuarios para la tabla
$listaUsuarios = $conexion->query("SELECT * FROM `usuario`")->fetchAll(PDO::FETCH_ASSOC);
?>