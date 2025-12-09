<?php
session_start();
require "../Controlador/conexion.php"; 

$conexion = conectar_db();   // 👈 Tu conexión real

$NombreUs = $_POST['NombreUs'];
$password = $_POST['password'];

// Consulta segura
$sql = "SELECT * FROM usuario WHERE Usuariolog = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $NombreUs);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    // Verifica contraseña HASH
    if (password_verify($password, $user['pass'])) {

        // Guardar sesión

        $_SESSION['id'] = $user['IdUser'];
        $_SESSION['nombre'] = $user['NombreUs'];
        $_SESSION['usu'] = $user['Usuariolog'];
        $_SESSION['area']    = $user['AreaUs'];
    
        $_SESSION['puesto'] = $user['PuestoUs'];
        $_SESSION['niv'] = $user['NivelUser'];
        $_SESSION['firma'] = $user['Firma'];

        header("Location:../Vista/C-registros.php");
        exit;

    } else {
       echo "<script>alert('Contraseña incorrecta'); window.location='../Vista/login.php';</script>";
    }

} else {
    echo "<script>alert('Usuario no encontrado'); window.location='../Vista/index.php';</script>";
}
?>  