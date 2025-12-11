<?php
include("../Controlador/conexion.php");
$conexion = conectar_db();

// Función que convierte NULL o inexistente en cadena vacía
function limpiar($campo) {
    return isset($_POST[$campo]) && $_POST[$campo] !== null ? $_POST[$campo] : "";
}

$IdSol  = limpiar('IdSol');
$NR     = limpiar('nombre');
$AreaR  = limpiar('area');
$PR     = limpiar('puesto');
$PRev   = limpiar('pr');
$Nci    = limpiar('nci');
$FirmaS = limpiar('firma');

// Convertir firma base64 a binario (si viene vacía no truena)
$firmaBinaria = $FirmaS !== "" 
    ? base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $FirmaS))
    : "";

// Insertar en tabla revision
$stmt = $conexion->prepare("INSERT INTO revision (Nrev, ARev, Pr, Prev, Nci, IdSol, FirmaRev) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssb", $NR, $AreaR, $PR, $PRev, $Nci, $IdSol, $null);

// Firma — si está vacía manda cadena vacía como binario
$stmt->send_long_data(6, $firmaBinaria);

if ($stmt->execute()) {

    // Actualizar la solicitud
    $update = $conexion->prepare("UPDATE solicitud SET Estatus = ?, NC = ? WHERE IdSol = ?");
    $estatus = 1;

    // Si NC viene vacío mandamos cadena vacía también
    $Nci = $Nci === "" ? "" : $Nci;

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
