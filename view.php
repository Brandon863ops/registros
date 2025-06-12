<?php
include("conexion.php");
$id = $_GET['id'];
$sql = "SELECT * FROM estudiantes WHERE id = '$id'";
$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($r);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Usuario</title>

    <!-- Bootstrap y estilos -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Menú</h4>
        <a href="registrar.php"><i class="fas fa-user-plus me-2"></i>Registrar</a>
        <a href="registro.php"><i class="fas fa-list me-2"></i>Registrados</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-danger mb-4 text-center">Detalle del Usuario</h2>
            <div class="card shadow p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="<?= $row['nombre'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="<?= $row['apellido'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha de nacimiento</label>
                        <input type="text" class="form-control" value="<?= $row['fechanaci'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Direccion</label>
                        <input type="text" class="form-control" value="<?= $row['direccion'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="number" class="form-control" value="<?= $row['telefono'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Correo</label>
                        <input type="text" class="form-control" value="<?= $row['correo'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($row['estado']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Grado</label>
                        <input type="text" class="form-control" value="<?= $row['grado'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Carrera</label>
                        <input type="text" class="form-control" value="<?= $row['carrera'] ?>" disabled>
                    </div>
                    
                    

                    <div class="col-12 text-center mt-4">
                        <a href="registro.php" class="btn btn-success">
                            <i class="fas fa-arrow-left me-2"></i>Volver al listado
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <img class="corner-image" src="assets/img/descarga-removebg-preview.png" alt="..." />

</body>

</html>