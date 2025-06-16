<?php
// Aseguramos que viene del formulario
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: notas.php");
    exit();
}

$grado = $_POST['grado'] ?? '';
$carrera = $_POST['carrera'] ?? '';

// Cursos por carrera (puedes modificar las listas según tus cursos reales)
$cursosPorCarrera = [
    "Ciencias y Letras" => [
        "Matemática", "Lenguaje y Comunicación", "Historia", "Educación Cívica", "Biología"
    ],
    "Computación" => [
        "Programación Estructurada", "Estructura de Datos", "Estadística", "Inglés Técnico", "Física"
    ],
    "Perito Contador" => [
        "Contabilidad", "Matemática", "Estadística", "Educación Cívica", "Inglés Técnico"
    ],
    "Bachillerato en Diseño" => [
        "Dibujo Técnico", "Diseño Gráfico", "Historia del Arte", "Educación Cívica", "Comunicación Visual"
    ]
];

// Obtener cursos según carrera seleccionada o un arreglo vacío si no coincide
$cursos = $cursosPorCarrera[$carrera] ?? [];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PREU - Cursos para <?= htmlspecialchars($carrera) ?></title>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>



<div class="main-content">
    <div class="container mt-4">
        <h3 class="text-primary">Cursos para la carrera: <?= htmlspecialchars($carrera) ?></h3>
        <p><strong>Grado seleccionado:</strong> <?= htmlspecialchars($grado) ?></p>

        <?php if (count($cursos) > 0): ?>
            <ul class="list-group">
                <?php foreach ($cursos as $curso): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($curso) ?>
                        <a href="notas1.php?curso=<?= urlencode($curso) ?>&carrera=<?= urlencode($carrera) ?>&grado=<?= urlencode($grado) ?>" class="btn btn-primary btn-sm">
                            Registrar Notas
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron cursos para esta carrera.</p>
        <?php endif; ?>

        <a href="notas.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</div>

</body>
</html>
