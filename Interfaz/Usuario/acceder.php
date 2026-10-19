<?php
require_once __DIR__ . '/../../carga.php';
?>

<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Iniciar Sesión</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- font: Open Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- font: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- Frameworck: Bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <!-- Archivo CSS -->
        <link rel = "stylesheet" href = "<?php echo URL_BASE; ?>/Interfaz/Activos/curstyles.css">
    </head>
    <body>
        <div class="vh-100">
            <div class="row h-100 g-0">
                <!-- Columna Izquierda-->
                <div class="col-lg-6 d-none d-lg-flex mi-bg-grisazulado flex-column justify-content-start align-items-center">
                    <!-- Logo -->
                    <div class="mt-5 mb-4 justify-content-center align-items-center">
                        <a href="<?php echo URL_BASE; ?>/index.php" class="navbar-brand">
                            <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                            <span class="text-white fw-bold ms-2 fs-5">Cursolandia</span>
                        </a>
                    </div>
                    <!-- Titulo -->
                    <div class="w-75 mt-3">
                        <h1 class="text-white fw-bold">¡Bienvenido de nuevo a Cursolandia!</h1>
                        <p class="text-white-50 fs-5 mt-3">Aprende y crea sin límites, en cualquier lugar y/o momento</p>
                    </div>
                    <!-- Img -->
                    <div class="text-center w-100">
                        <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/img inicio sesion.png" alt="" class="img-fluid" style="max-height: 250px;">
                    </div>
                </div>
                <!-- Columna Derecha: Formulario -->
                <div class="col-12 col-lg-6 mi-bg-grisclaro d-flex align-items-center justify-content-center position-relative">
                    <!-- header para celular -->
                    <div class="d-lg-none position-absolute top-0 start-0 w-100 p-3 mi-bg-grisazulado shadow-sm d-flex align-items-center">
                        <a href="<?php echo URL_BASE;?>/index.php" class="navbar-brand">
                            <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/logo cursolandia.png" alt="Logo" style="max-height: 40px;">
                            <span class="text-white fw-bold ms-2 fs-5">Cursolandia</span>
                        </a>
                    </div>
                    <!-- Formulario -->
                    <div class="w-100 px-3" style="max-width: 400px;">
                        <h3 class="fw-bold text-center mi-color-text">Iniciar Sesión</h3>
                        <p class="text-center mb-4 small">Ingresa tus datos para acceder</p>
                        <form action="" method="POST" name="finiciodesesion">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="emailinicio" name ="emailinicio" placeholder="">
                                <label for="emailinicio" class="text-dark">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="contraseñainicio" name="contraseñainicio" placeholder="">
                                <label for="contraseñainicio">Contraseña</label>
                            </div>
                            <div class="text-end">
                                <a href="" class="mi-color-text small">¿Olvidaste tu contraseña?</a>
                            </div>
                            <button class="btn mis-bgs-btns my-3 w-100 h-50 text-light">INICIAR SESION<i class="bi bi-arrow-right-short"></i></button>
                        </form>
                        <p class="text-center small">¿No tienes cuenta?<a href="<?php echo URL_BASE;?>/Interfaz/Usuario/registrarse.php" class="text-decoration-none fw-bold"style="color: #AB978C;"> Registrate gratis</a></p>
                    </div>                    
                </div>
            </div>
        </div>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
