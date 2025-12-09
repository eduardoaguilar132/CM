<?php
include("../Controlador/conexion.php");
$conexion = conectar_db();
$null     = NULL;

$Ns     = $_POST['nombre'];
$Uslog  = $_POST['usuariolog'];
$Area   = $_POST["area"];
$Ps     = $_POST['puesto'];
$pass   = $_POST['pass'];     // ESTA ES LA CONTRASEÑA EN TEXTO
$ND     = $_POST["re"];       // NIVEL DEL USUARIO
$FirmaS = $_POST["firma"];

// Convertir firma base64 a binario
$firmaBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $FirmaS));

// 🔐 Convertimos la contraseña a HASH SEGURO
$passHash = password_hash($pass, PASSWORD_DEFAULT);

// Preparamos la consulta
$stmt = $conexion->prepare(
    "INSERT INTO usuario (NombreUs, Usuariolog, AreaUs, PuestoUs, NivelUser, pass, Firma)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);

// ORDEN EXACTO SEGÚN LA TABLA:
$stmt->bind_param(
    "ssssssb",
    $Ns,        // NombreUs
    $Uslog,     // Usuariolog
    $Area,      // AreaUs
    $Ps,        // PuestoUs
    $ND,        // NivelUser
    $passHash,  // contraseña HASH
    $null       // Firma temporal para blob
);

// Firma en blob (índice 6)
$stmt->send_long_data(6, $firmaBinaria);

if ($stmt->execute()) {
    echo "<script>alert('Usuario registrado correctamente');</script>";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
?>

<body>
<script type="text/javascript">
    window.location = "../index.html";
</script>
</body>
