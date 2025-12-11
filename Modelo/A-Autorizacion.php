<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../Controlador/conexion.php");
$conexion = conectar_db();

// Función para limpiar campos y evitar NULL
function limpiar($campo) {
    return isset($_POST[$campo]) && $_POST[$campo] !== null ? $_POST[$campo] : "";
}

$IdSol   = limpiar("IdSol");
$NA      = limpiar("nombre");
$AA      = limpiar("area");
$PA      = limpiar("puesto");
$PAA     = limpiar("Procede");
$RazonA  = limpiar("razonm");
$FirmaS  = limpiar("firma");

// Convertir firma base64 a binario
$firmaBinaria = $FirmaS !== "" 
    ? base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $FirmaS))
    : "";

// Insertar en tabla autorizacion
$stmt = $conexion->prepare("
    INSERT INTO autorizacion (NA, AA, PA, PAA, RazonA, FirmaA, IdSol)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$null = NULL;

// FirmaA usa bind_param tipo "b" (blob)
$stmt->bind_param("sssssbi", $NA, $AA, $PA, $PAA, $RazonA, $null, $IdSol);

// Enviar firma binaria (aunque esté vacía)
$stmt->send_long_data(5, $firmaBinaria);

if ($stmt->execute()) {

    // Actualizar estatus de solicitud
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
