<?php
include("conexion.php");
$sql = "SELECT * FROM usuarios";
$respuesta = mysqli_query($conn , $sql); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PREU - Registro de Usuarios</title>

    <!-- FontAwesome y Bootstrap -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
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
        <!-- Formulario de Registro -->
        <div class="form-container">
            <div class="row align-items-center">
                <!-- Formulario -->
                <div class="col-md-7">
                    <h3 class="mb-4 text-primary">Registro de Usuario</h3>
                    <form class="row g-3" method="POST" action="create.php">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellido" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="number" class="form-control" name="telefono" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipo</label>
                            <select class="form-select" name="tipo" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Alumno">Alumno</option>
                                <option value="Docente">Docente</option>
                                <option value="Dependente">Dependente</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado" required>
                                
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Código de Barra</label>
                            <input type="text" class="form-control" name="codigobarra" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nickname</label>
                            <input type="text" class="form-control" name="nickname" required>
                        </div>
                        <div class="col-md-6 password-wrapper">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="contraseña" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                            <br><br>
                        </div>
                        
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">Registrar</button>
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

    
    <img class="corner-image" src="assets/img/descarga-removebg-preview.png" alt="..." />

    <script>
    function togglePassword() {
        const passInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (passInput.type === "password") {
            passInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {    
            passInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>
</body>

</html>
