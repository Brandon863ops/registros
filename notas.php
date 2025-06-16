<?php
include("conexion.php");

// Obtener datos para los selects
$sql_carreras = "SELECT DISTINCT carrera FROM estudiantes WHERE carrera IS NOT NULL AND carrera != ''";
$carreras = mysqli_query($conn, $sql_carreras);

$sql_grados = "SELECT DISTINCT grado FROM estudiantes WHERE grado IS NOT NULL AND grado != '' ORDER BY grado";
$grados = mysqli_query($conn, $sql_grados);

// Variables para mostrar resultados
$cursos = [];
$estudiantes = [];
$curso_seleccionado = null;

// Procesar búsqueda de cursos
if (isset($_POST['buscar_cursos']) && !empty($_POST['carrera']) && !empty($_POST['grado'])) {
    $carrera = mysqli_real_escape_string($conn, $_POST['carrera']);
    $grado = mysqli_real_escape_string($conn, $_POST['grado']);
    
    // Aquí puedes definir los cursos por carrera y grado
    $cursos_disponibles = [
        'Ingeniería en Sistemas' => [
            '1' => ['Programación I', 'Matemática I', 'Inglés Técnico'],
            '2' => ['Programación II', 'Base de Datos', 'Estructuras de Datos'],
            '3' => ['Desarrollo Web', 'Redes', 'Ingeniería de Software']
        ],
        'Administración' => [
            '1' => ['Contabilidad General', 'Matemática Financiera', 'Administración General'],
            '2' => ['Finanzas', 'Marketing', 'Recursos Humanos'],
            '3' => ['Gestión de Proyectos', 'Auditoría', 'Emprendimiento']
        ],
        'Medicina' => [
            '1' => ['Anatomía', 'Biología', 'Química'],
            '2' => ['Fisiología', 'Farmacología', 'Patología'],
            '3' => ['Medicina Interna', 'Cirugía', 'Pediatría']
        ]
    ];
    
    if (isset($cursos_disponibles[$carrera][$grado])) {
        $cursos = $cursos_disponibles[$carrera][$grado];
    }
}

// Procesar selección de curso
if (isset($_POST['ver_estudiantes']) && !empty($_POST['curso']) && !empty($_POST['carrera']) && !empty($_POST['grado'])) {
    $curso = mysqli_real_escape_string($conn, $_POST['curso']);
    $carrera = mysqli_real_escape_string($conn, $_POST['carrera']);
    $grado = mysqli_real_escape_string($conn, $_POST['grado']);
    
    $curso_seleccionado = $curso;
    
    // Buscar estudiantes de esa carrera y grado
    $sql = "SELECT e.*, 
                   COALESCE(n.nota1, '') as nota1,
                   COALESCE(n.nota2, '') as nota2, 
                   COALESCE(n.nota3, '') as nota3,
                   COALESCE(n.promedio, '') as promedio,
                   COALESCE(n.observaciones, '') as observaciones
            FROM estudiantes e 
            LEFT JOIN notas n ON e.id = n.estudiante_id AND n.curso = '$curso'
            WHERE e.carrera = '$carrera' AND e.grado = '$grado'
            ORDER BY e.apellidos, e.nombres";
    
    $result = mysqli_query($conn, $sql);
    $estudiantes = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Procesar guardado de notas
if (isset($_POST['guardar_notas'])) {
    $curso = mysqli_real_escape_string($conn, $_POST['curso']);
    $success = true;
    
    foreach ($_POST['estudiantes'] as $estudiante_id => $notas) {
        $nota1 = !empty($notas['nota1']) ? floatval($notas['nota1']) : 0;
        $nota2 = !empty($notas['nota2']) ? floatval($notas['nota2']) : 0;
        $nota3 = !empty($notas['nota3']) ? floatval($notas['nota3']) : 0;
        $promedio = ($nota1 + $nota2 + $nota3) / 3;
        $observaciones = mysqli_real_escape_string($conn, $notas['observaciones']);
        
        // Verificar si ya existe el registro
        $check_sql = "SELECT id FROM notas WHERE estudiante_id = $estudiante_id AND curso = '$curso'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Actualizar
            $update_sql = "UPDATE notas SET 
                          nota1 = $nota1, 
                          nota2 = $nota2, 
                          nota3 = $nota3, 
                          promedio = $promedio, 
                          observaciones = '$observaciones' 
                          WHERE estudiante_id = $estudiante_id AND curso = '$curso'";
            if (!mysqli_query($conn, $update_sql)) {
                $success = false;
            }
        } else {
            // Insertar nuevo
            $insert_sql = "INSERT INTO notas (estudiante_id, curso, nota1, nota2, nota3, promedio, observaciones) 
                          VALUES ($estudiante_id, '$curso', $nota1, $nota2, $nota3, $promedio, '$observaciones')";
            if (!mysqli_query($conn, $insert_sql)) {
                $success = false;
            }
        }
    }
    
    if ($success) {
        $mensaje = "Notas guardadas exitosamente";
        // Recargar estudiantes
        $carrera = mysqli_real_escape_string($conn, $_POST['carrera']);
        $grado = mysqli_real_escape_string($conn, $_POST['grado']);
        $curso_seleccionado = $curso;
        
        $sql = "SELECT e.*, 
                       COALESCE(n.nota1, '') as nota1,
                       COALESCE(n.nota2, '') as nota2, 
                       COALESCE(n.nota3, '') as nota3,
                       COALESCE(n.promedio, '') as promedio,
                       COALESCE(n.observaciones, '') as observaciones
                FROM estudiantes e 
                LEFT JOIN notas n ON e.id = n.estudiante_id AND n.curso = '$curso'
                WHERE e.carrera = '$carrera' AND e.grado = '$grado'
                ORDER BY e.apellidos, e.nombres";
        
        $result = mysqli_query($conn, $sql);
        $estudiantes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = "Error al guardar las notas";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PREU - Sistema de Notas</title>

    <!-- FontAwesome y Bootstrap -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        .nota-input {
            width: 80px;
            text-align: center;
        }
        .promedio-cell {
            font-weight: bold;
            color: #28a745;
        }
        .course-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .search-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .students-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Menú</h4>
        <a href="registrar.php"><i class="fas fa-user-plus me-2"></i>Registrar</a>
        <a href="registro.php"><i class="fas fa-list me-2"></i>Registrados</a>
        <a href="notas.php"><i class="fas fa-sticky-note me-2"></i>Notas</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-container">
            <div class="row">
                <div class="col-md-8">
                    <center><h3 class="mb-4 text-primary">SISTEMA DE NOTAS</h3></center>
                    
                    <?php if (isset($mensaje)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $mensaje; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Sección de búsqueda -->
                    <div class="search-section">
                        <h5><i class="fas fa-search me-2"></i>Buscar Estudiantes</h5>
                        <form method="POST" class="row g-3">
                            <div class="col-md-6">
                                <label for="carrera" class="form-label">Carrera:</label>
                                <select name="carrera" id="carrera" class="form-select" required>
                                    <option value="">Seleccione una carrera</option>
                                    <?php 
                                    mysqli_data_seek($carreras, 0);
                                    while ($carrera = mysqli_fetch_assoc($carreras)): ?>
                                        <option value="<?php echo htmlspecialchars($carrera['carrera']); ?>" 
                                                <?php echo (isset($_POST['carrera']) && $_POST['carrera'] == $carrera['carrera']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($carrera['carrera']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="grado" class="form-label">Grado:</label>
                                <select name="grado" id="grado" class="form-select" required>
                                    <option value="">Seleccione un grado</option>
                                    <?php 
                                    mysqli_data_seek($grados, 0);
                                    while ($grado = mysqli_fetch_assoc($grados)): ?>
                                        <option value="<?php echo htmlspecialchars($grado['grado']); ?>"
                                                <?php echo (isset($_POST['grado']) && $_POST['grado'] == $grado['grado']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($grado['grado']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" name="buscar_cursos" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Buscar Cursos
                                </button>
                            </div>
                        </form>
                    </div>
|
                    <!-- Mostrar cursos -->
                    <?php if (!empty($cursos)): ?>
                        <div class="mb-4">
                            <h5><i class="fas fa-book me-2"></i>Cursos Disponibles</h5>
                            <div class="row">
                                <?php foreach ($cursos as $curso): ?>
                                    <div class="col-md-4">
                                        <div class="course-card">
                                            <h6><?php echo htmlspecialchars($curso); ?></h6>
                                            <form method="POST" style="display: inline;">
                                                <input type="hidden" name="curso" value="<?php echo htmlspecialchars($curso); ?>">
                                                <input type="hidden" name="carrera" value="<?php echo htmlspecialchars($_POST['carrera']); ?>">
                                                <input type="hidden" name="grado" value="<?php echo htmlspecialchars($_POST['grado']); ?>">
                                                <button type="submit" name="ver_estudiantes" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-users me-1"></i>Ver Estudiantes
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Mostrar estudiantes y notas -->
                    <?php if (!empty($estudiantes)): ?>
                        <div class="students-section">
                            <h5><i class="fas fa-users me-2"></i>Estudiantes - <?php echo htmlspecialchars($curso_seleccionado); ?></h5>
                            <form method="POST">
                                <input type="hidden" name="curso" value="<?php echo htmlspecialchars($curso_seleccionado); ?>">
                                <input type="hidden" name="carrera" value="<?php echo htmlspecialchars($_POST['carrera'] ?? ''); ?>">
                                <input type="hidden" name="grado" value="<?php echo htmlspecialchars($_POST['grado'] ?? ''); ?>">
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Carrera</th>
                                                <th>Grado</th>
                                                <th>Nota 1</th>
                                                <th>Nota 2</th>
                                                <th>Nota 3</th>
                                                <th>Promedio</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($estudiantes as $estudiante): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($estudiante['codigo_estudiante'] ?? $estudiante['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($estudiante['nombres']); ?></td>
                                                    <td><?php echo htmlspecialchars($estudiante['apellidos']); ?></td>
                                                    <td><?php echo htmlspecialchars($estudiante['carrera']); ?></td>
                                                    <td><?php echo htmlspecialchars($estudiante['grado']); ?></td>
                                                    <td>
                                                        <input type="number" 
                                                               name="estudiantes[<?php echo $estudiante['id']; ?>][nota1]" 
                                                               value="<?php echo $estudiante['nota1']; ?>"
                                                               min="0" max="100" step="0.01" 
                                                               class="form-control nota-input">
                                                    </td>
                                                    <td>
                                                        <input type="number" 
                                                               name="estudiantes[<?php echo $estudiante['id']; ?>][nota2]" 
                                                               value="<?php echo $estudiante['nota2']; ?>"
                                                               min="0" max="100" step="0.01" 
                                                               class="form-control nota-input">
                                                    </td>
                                                    <td>
                                                        <input type="number" 
                                                               name="estudiantes[<?php echo $estudiante['id']; ?>][nota3]" 
                                                               value="<?php echo $estudiante['nota3']; ?>"
                                                               min="0" max="100" step="0.01" 
                                                               class="form-control nota-input">
                                                    </td>
                                                    <td class="promedio-cell">
                                                        <?php echo $estudiante['promedio'] ? number_format($estudiante['promedio'], 2) : '-'; ?>
                                                    </td>
                                                    <td>
                                                        <textarea name="estudiantes[<?php echo $estudiante['id']; ?>][observaciones]" 
                                                                  class="form-control" 
                                                                  rows="2"
                                                                  placeholder="Observaciones..."><?php echo htmlspecialchars($estudiante['observaciones']); ?></textarea>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <button type="submit" name="guardar_notas" class="btn btn-success btn-lg">
                                        <i class="fas fa-save me-2"></i>Guardar Notas
                                    </button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Imagen lateral -->
                <div class="col-md-4 text-center image-column">
                    <img class="masthead-avatar mt-4" src="assets/img/images-removebg-preview.png" alt="Preu"
                        style="width: 300px; height: auto;" />
                </div>
            </div>
        </div>
    </div>

    <img class="corner-image" src="assets/img/descarga-removebg-preview.png" alt="..." />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>