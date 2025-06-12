<?php
include("conexion.php");
$sql = "SELECT * FROM estudiantes";
$respuesta = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
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

    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>

<body>
    <div class="sidebar">
        <h4>Menú</h4>
        <a href="registrar.php"><i class="fas fa-user-plus me-2"></i>Registrar</a>
        <a href="registro.php"><i class="fas fa-list me-2"></i>Registrados</a>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4">Usuarios Registrados</h2>
        <div class="table-responsive shadow rounded">
            <table id="datatablesSimple" class="table table-striped table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Grado</th>
                        <th scope="col">Carrera</th>
                        <th scope="col" style="width: 160px;">Acciones</th>
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
    </div>

    <!-- Simple DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {
    searchable: false, // Esto quita el cuadro de búsqueda general
    labels: {
        perPage: "Entradas por página",
        noRows: "No se encontraron resultados",
        info: "Mostrando {start} a {end} de {rows} entradas",
        loading: "Cargando...",
        pagination: {
            previous: "Anterior",
            next: "Siguiente",
            navigate: "Ir a la página",
            page: "Página",
            showing: "Mostrando",
            of: "de"
        }
    }
});
        }
    });
    </script>
</body>
</html>
