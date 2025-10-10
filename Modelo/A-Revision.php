<?php
include("../Controlador/conexion.php");
$conexion = conectar_db();

$IdSol = $_POST['IdSol'];
$NR    = $_POST['nombre'];
$AreaR = $_POST['area'];
$PR    = $_POST['puesto'];
$PRev  = $_POST['pr'];
$Nci   = $_POST['nci'];
$FirmaS = $_POST['firma'];

// Convertir firma base64 a binario
$firmaBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $FirmaS));

// Insertar en tabla revision
$stmt = $conexion->prepare("INSERT INTO revision (Nrev, ARev, Pr, Prev, Nci, IdSol, FirmaRev) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssb", $NR, $AreaR, $PR, $PRev, $Nci, $IdSol, $null);

$stmt->send_long_data(6, $firmaBinaria); // índice del parámetro firma

if ($stmt->execute()) {
    // Si se insertó correctamente, actualizar la tabla solicitud
    $update = $conexion->prepare("UPDATE solicitud SET Estatus = ?, NC = ? WHERE IdSol = ?");
    $estatus = 1;
    $update->bind_param("isi", $estatus, $Nci, $IdSol);

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