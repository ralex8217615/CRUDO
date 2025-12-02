<?php
include "conexion.php";

// Obtener ID
$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID no válido");
}

// Obtener datos actuales
$stmt = $conn->prepare("SELECT * FROM tareas WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$tarea = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarea) {
    die("Tarea no encontrada");
}

// Si se envió el formulario
if ($_POST) {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $completado = isset($_POST["completado"]) ? true : false;

    $stmt = $conn->prepare("
        UPDATE tareas 
        SET titulo = :t, descripcion = :d, fecha = :f, completado = :c
        WHERE id = :id
    ");

    $stmt->bindParam(":t", $titulo);
    $stmt->bindParam(":d", $descripcion);
    $stmt->bindParam(":f", $fecha);
    $stmt->bindParam(":c", $completado, PDO::PARAM_BOOL);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
</head>
<body>

<h1>Editar Tarea</h1>

<form method="POST">
    <input type="text" name="titulo" value="<?= $tarea['titulo'] ?>" required><br><br>
    <textarea name="descripcion"><?= $tarea['descripcion'] ?></textarea><br><br>
    <input type="date" name="fecha" value="<?= $tarea['fecha'] ?>" required><br><br>

    <label>
        <input type="checkbox" name="completado" <?= $tarea['completado'] ? 'checked' : '' ?>>
        Completado
    </label><br><br>

    <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
