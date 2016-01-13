<?php
// coger el parámetro que nos permitirá identificar el registro

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Registro no encontrado.');

// Consulta de borrado
$query = "DELETE FROM clientes WHERE id = ?";

$stmt = $conexion->prepare($query);

$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    // después de borrar ir a index.php de nuevo e
    // informar que el archivo fue borrado
    header('Location: index.php?action=deleted');
} else {
    die('Imposible borrar el registro.');
}
?>

