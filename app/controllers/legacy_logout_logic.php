<?php
// filepath: c:\xampp\htdocs\Sistemas_de_competencias\Sistemas_de_competencias\logout.php
session_start();
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión
header("Location: index.php"); // Redirige al login
exit();
?>