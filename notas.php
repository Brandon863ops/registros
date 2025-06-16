<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
    <a href="notas.php"><i class="fas fa-list me-2"></i>Notas</a>
</div>

<div class="main-content">
    <div class="form-container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <center><h3 class="mb-4 text-primary">Selecciona Grado y Carrera</h3></center>

                <form method="POST" action="mostrar.php" class="row g-3">
                    <!-- Select Grado -->
                    <div class="col-md-6">
                        <label class="form-label">Grado</label>
                        <select class="form-select" name="grado" required>
                            <option value="" disabled selected>Seleccione un grado</option>
                            <option value="1ro Básico">1ro Básico</option>
                            <option value="2do Básico">2do Básico</option>
                            <option value="3ro Básico">3ro Básico</option>
                            <option value="4to Diversificado">4to Diversificado</option>
                            <option value="5to Diversificado">5to Diversificado</option>
                        </select>
                    </div>

                    <!-- Select Carrera -->
                    <div class="col-md-6">
                        <label class="form-label">Carrera</label>
                        <select class="form-select" name="carrera" required>
                            <option value="" disabled selected>Seleccione una carrera</option>
                            <option value="Ciencias y Letras">Ciencias y Letras</option>
                            <option value="Computación">Computación</option>
                            <option value="Perito Contador">Perito Contador</option>
                            <option value="Bachillerato en Diseño">Dibujo Tecnico</option>
                        </select>
                    </div>

                    <!-- Botón -->
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Mostrar Cursos</button>
                    </div>
                </form>
            </div>

            <div class="col-md-5 text-center image-column">
                <img class="masthead-avatar mt-4" src="assets/img/images-removebg-preview.png" alt="Preu"
                     style="width: 300px; height: auto;" />
            </div>
        </div>
    </div>
</div>

</body>
</html>
