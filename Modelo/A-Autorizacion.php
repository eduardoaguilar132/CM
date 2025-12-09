<?php
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../Controlador/conexion.php");
$conexion = conectar_db();

$IdSol = $_POST["IdSol"];
$NA    = $_POST["nombre"];
$AA = $_POST["area"];
$PA    = $_POST["puesto"];
$PAA  = $_POST["Procede"];
$RazonA   = $_POST["razonm"];
$FirmaS = $_POST["firma"];

// Convertir firma base64 a binario
$firmaBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $FirmaS));

// Insertar en tabla revision
$stmt = $conexion->prepare("INSERT INTO autorizacion (NA, AA, PA, PAA, RazonA, FirmaA, IdSol)
VALUES (?, ?, ?, ?, ?, ?, ?)");

$null = NULL;

$stmt->bind_param("sssssbi", $NA, $AA, $PA, $PAA, $RazonA, $null, $IdSol);

// Cargar la firma (blob)
$stmt->send_long_data(5, $firmaBinaria);

if ($stmt->execute()) {
    // Si se insertó correctamente, actualizar la tabla solicitud
    $update = $conexion->prepare("UPDATE solicitud SET Estatus = ? WHERE IdSol = ?");
    $estatus = 2;
    $update->bind_param("ii", $estatus, $IdSol);

    if ($update->execute()) {
        echo "<script>alert('Solicitud y revisión guardadas correctamente');</script>";
    } else {
        echo "Error al actualizar solicitud: " . $update->error;
    }

    $update->close();
} else {
    echo "Error al guardar revisión: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>

<body>
<script type="text/javascript">
    window.location = "../Vista/C-registros.php";
</script>
</body>