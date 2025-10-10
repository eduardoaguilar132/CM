<?php
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
$stmt = $conexion->prepare("INSERT INTO Autorizacion (NA, AA, PA, PAA, RazonA, FirmaA) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssb", $NA, $AA, $PA, $PAA, $RazonA, $null);

$stmt->send_long_data(5, $firmaBinaria); // índice del parámetro firma

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