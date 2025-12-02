<?php 
include "conexion.php";

// Obtener todas las tareas
$stmt = $conn->query("SELECT * FROM tareas ORDER BY fecha ASC");
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD con PostgreSQL</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Lista de Tareas</h1>

<a href="crear.php" class="btn">Nueva Tarea</a>

<table>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Completado</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($tareas as $t) { ?>
    <tr>
        <td><?= $t['id'] ?></td>
        <td><?= $t['titulo'] ?></td>
        <td><?= $t['descripcion'] ?></td>
        <td><?= $t['fecha'] ?></td>
        <td><?= $t['completado'] ? 'Sí' : 'No' ?></td>
        <td>
            <a href="editar.php?id=<?= $t['id'] ?>" class="btn-edit">Editar</a>
            <a href="eliminar.php?id=<?= $t['id'] ?>" class="btn-delete">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
