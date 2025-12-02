<?php
include "conexion.php";

if ($_POST) {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];

    $stmt = $conn->prepare("INSERT INTO tareas (titulo, descripcion, fecha) 
                            VALUES (:t, :d, :f)");
    $stmt->bindParam(":t", $titulo);
    $stmt->bindParam(":d", $descripcion);
    $stmt->bindParam(":f", $fecha);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Tarea</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Nueva Tarea</h1>

    <form action="" method="POST" class="form-box">

        <input type="text" name="titulo" placeholder="Título" required class="input">

        <textarea name="descripcion" placeholder="Descripción" class="textarea"></textarea>

        <input type="date" name="fecha" required class="input">

        <button type="submit" class="btn btn-save">Guardar</button>
    </form>
</div>

</body>
</html>
