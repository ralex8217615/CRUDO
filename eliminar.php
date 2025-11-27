<?php
include "conexion.php";

// Obtener el ID de la tarea
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID no válido");
}

// Ejecutar eliminación
$stmt = $conn->prepare("DELETE FROM tareas WHERE id = :id");
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    echo "<script>
            alert('Tarea eliminada correctamente');
            window.location = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Error al eliminar tarea');
            window.location = 'index.php';
          </script>";
}
?>
