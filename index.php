<?php
include "conexion.php";

// Obtener ID
$id = $_GET['id'] ?? null;
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .card {
            max-width: 500px;
            margin: auto;
            animation: fadeIn .5s ease;
        }
        h2 {
            text-align: center;
            color: #4F8BF9;
        }
    </style>
</head>

<body>

<div class="card">
    <h2>Editar Tarea</h2>

    <form action="" method="POST">
        <input type="text" name="titulo" value="<?= htmlspecialchars($tarea['titulo']) ?>" required>
        <textarea name="descripcion" rows="4"><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
        <button type="submit">Actualizar</button>
    </form>
</div>

</body>
</html>

<?php
// Si el usuario envía el formulario
if ($_POST) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $update = $conn->prepare("
        UPDATE tareas 
        SET titulo = :t, descripcion = :d 
        WHERE id = :id
    ");

    $update->bindParam(":t", $titulo);
    $update->bindParam(":d", $descripcion);
    $update->bindParam(":id", $id);

    if ($update->execute()) {
        echo "<script>alert('Tarea actualizada'); window.location='index.php';</script>";
    }
}
?>
