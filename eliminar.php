<?php
include "conexion.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID no válido");
}

$stmt = $conn->prepare("DELETE FROM tareas WHERE id = :id");
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error al eliminar";
}
?>
