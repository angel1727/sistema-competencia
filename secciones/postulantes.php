<?php
include_once '../configuraciones/bd.php';

// Obtener la instancia de la conexión
$pdo = BD::crearInstancia();

// Crear postulante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'crear') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $nit = $_POST['nit'];
    $sigep = $_POST['sigep'];
    $matricula = $_POST['matricula'];
    $seguro = $_POST['seguro'];
    $sriesgo = $_POST['sriesgos'];
    $fecha_registro = $_POST['fecha_registro'];

    $sql = "INSERT INTO postulante (nombre, apellido, ci, ciudad, direccion, celular, telefono, nit, sigep, matricula, seguro, sriesgos, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellido, $ci, $ciudad, $direccion, $celular, $telefono, $nit, $sigep, $matricula, $seguro, $sriesgos, $fecha_registro]);
}

// Leer postulantes
$sql = "SELECT * FROM postulante";
$stmt = $pdo->query($sql);
$postulantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Actualizar postulante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'actualizar') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $nit = $_POST['nit'];
    $sigep = $_POST['sigep'];
    $matricula = $_POST['matricula'];
    $seguro = $_POST['seguros'];
    $sriesgo = $_POST['sriesgos'];
    $fecha_registro = $_POST['fecha_registro'];

    $sql = "UPDATE postulante SET nombre = ?, apellido = ?, $ci = ?, $ciudad = ?, $direccion = ?, $celular = ?, $telefono = ?, $nit = ?, $sigep = ?, $matricula = ?, $seguro = ?, $sriesgos = ?, $fecha_registro = ? WHERE idPostulante = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellido, $ci, $ciudad, $direccion, $celular, $telefono, $nit, $sigep, $matricula, $seguro, $sriesgos, $fecha_registro]);
}
?>