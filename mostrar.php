


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>PREU - Sistema de Notas</title>

    <title>PREU - Notas</title>


    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">



</head>
<body>
    


<div class="sidebar">
    <h4>Menú</h4>
    <a href="registrar.php"><i class="fas fa-user-plus me-2"></i>Registrar</a>
    <a href="registro.php"><i class="fas fa-list me-2"></i>Registrados</a>
    <a href="notas.php"><i class="fas fa-list me-2"></i>notas</a>
                                                
</div>

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
        <center><h3 class="text-primary">Cursos para la carrera: <?= htmlspecialchars($carrera) ?></h3></center>
        <p><strong>Grado seleccionado:</strong> <?= htmlspecialchars($grado) ?></p>

        <?php if (count($cursos) > 0): ?>
            <div class="row">
                <?php foreach ($cursos as $curso): ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($curso) ?></h5>
                                <div class="mt-auto">
                                    <a href="notas1.php?curso=<?= urlencode($curso) ?>&carrera=<?= urlencode($carrera) ?>&grado=<?= urlencode($grado) ?>" 
                                       class="btn btn-primary w-100">
                                        <?= htmlspecialchars($curso) ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron cursos para esta carrera.</p>
        <?php endif; ?>

        <a href="notas.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</div>

</body>
</html>


    <img class="corner-image" src="assets/img/descarga-removebg-preview.png" alt="..." />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>

