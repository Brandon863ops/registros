<?php
include("conexion.php");
$sql = "SELECT * FROM estudiantes";
$respuesta = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Listado de Usuarios - PREU</title>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
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

    <div class="container my-4">
        <h2 class="text-center mb-4">Usuarios Registrados</h2>
        <div class="table-responsive shadow rounded">
         <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Carrera</th>
                        <th scope="col" style="width: 200px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_array($respuesta)):
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['grado']; ?></td>
                        <td><?php echo $row['carrera']; ?></td>
                        <td class="text-center">
                            <a href="delete.php?id=<?php echo $row['id']; ?>" title="Borrar Registro">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" title="Editar Registro">
                                <button type="button" class="btn btn-outline-warning btn-xs">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            <a href="view.php?id=<?php echo $row['id']; ?>" title="Ver Registro">
                                <button type="button" class="btn btn-outline-success btn-xs">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                            <a href="notas.php?id=<?php echo $row['id']; ?>" title="Ver notas">
                                <button type="button" class="btn btn-outline-success btn-xs">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if (mysqli_num_rows($respuesta) === 0) : ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay usuarios registrados.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        
    </div>
        <img class="corner-image" src="assets/img/descarga-removebg-preview.png" alt="..." />
</body>
</html>
