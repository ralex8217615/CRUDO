<?php
include "conexion.php";

// Obtener todas las tareas
$stmt = $conn->prepare("SELECT * FROM tareas ORDER BY id DESC");
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Tareas</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .container {
            max-width: 700px;
            margin: auto;
        }

        .titulo {
            text-align: center;
            font-size: 30px;
            margin-bottom: 20px;
            color: #7B2CBF;
            animation: fadeIn .8s ease;
        }

        .tarea-card {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            border-left: 8px solid #7B2CBF;
            animation: fadeInUp .6s ease;
        }

        .tarea-card h3 {
            margin: 0;
            color: #4F8BF9;
        }

        .tarea-card p {
            margin-top: 8px;
            color: #dcdcdc;
        }

        .btns {
            margin-top: 10px;
        }

        .btn-editar {
            padding: 8px 12px;
            background: #4F8BF9;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn-borrar {
            padding: 8px 12px;
            background: #cc3232;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-nueva {
            display: block;
            width: 200px;
            text-align: center;
            margin: 25px auto;
            background: #7B2CBF;
            padding: 12px;
            border-radius: 12px;
            color: white;
            font-size: 18px;
            text-decoration: none;
            transition: .3s;
        }

        .btn-nueva:hover {
            background: #9d46ff;
            transform: scale(1.05);
        }

        @keyframes fadeInUp {
            from {opacity:0; transform: translateY(20px);}
            to   {opacity:1; transform: translateY(0);}
        }
    </style>
</head>

<body>

<div class="container">
    <h1 class="titulo">Lista de Tareas</h1>

    <a class="btn-nueva" href="crear.php">+ Nueva Tarea</a>

    <?php foreach ($tareas as $t): ?>
        <div class="tarea-card">
            <h3><?= htmlspecialchars($t['titulo']) ?></h3>
            <p><?= nl2br(htmlspecialchars($t['descripcion'])) ?></p>
            <p><small>Fecha: <?= $t['fecha'] ?></small></p>

            <div class="btns">
                <a class="btn-editar" href="editar.php?id=<?= $t['id'] ?>">Editar</a>
                <a class="btn-borrar" href="eliminar.php?id=<?= $t['id'] ?>"
                   onclick="return confirm('¿Eliminar esta tarea?');">
                   Borrar
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
