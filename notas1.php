<?php
include("conexion.php");

// Recibimos parámetros por GET
$curso = $_GET['curso'] ?? '';
$carrera = $_GET['carrera'] ?? '';
$grado = $_GET['grado'] ?? '';

if (!$curso || !$carrera || !$grado) {
    // Si falta algún parámetro, volvemos a notas.php o a otra página
    header("Location: notas.php");
    exit();
}

// Consulta para obtener alumnos filtrados por grado y carrera
$sql = "SELECT * FROM estudiantes WHERE carrera = ? AND grado = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $carrera, $grado);
$stmt->execute();
$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrar Notas - <?= htmlspecialchars($curso) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h3>Registrar Notas para el curso: <strong><?= htmlspecialchars($curso) ?></strong></h3>
    <p>Grado: <strong><?= htmlspecialchars($grado) ?></strong> | Carrera: <strong><?= htmlspecialchars($carrera) ?></strong></p>

    <?php if ($resultado->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 1;
                while ($alumno = $resultado->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $contador++ ?></td>
                    <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                    <td><?= htmlspecialchars($alumno['apellido']) ?></td>
                    <td>
                        <a href="registrar_notas.php?id=<?= $alumno['id'] ?>&curso=<?= urlencode($curso) ?>" class="btn btn-primary btn-sm">
                            Registrar Nota
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay alumnos registrados para este grado y carrera.</p>
    <?php endif; ?>

    <a href="notas.php" class="btn btn-secondary mt-3">Volver</a>
</div>
</body>
</html>
