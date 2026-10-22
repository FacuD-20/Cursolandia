<?php
require_once __DIR__ . '/../../carga.php';
?>
<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Crear Cuenta</title>
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
        <link rel = "stylesheet" href = "<?php echo URL_BASE;?>/Interfaz/Activos/curstyles.css">
    </head>
    <body>
        <div class="vh-100">
            <div class="row h-100 g-0">
                <!-- Imagen PC-->
                <div class="col-lg-6 d-none d-lg-flex mi-bg-grisazulado flex-column justify-content-start align-items-center">
                    <!-- Logo -->
                    <div class="w-100 px-5 mt-4 mb-5 text-start">
                        <a href="<?php echo URL_BASE;?>/index.php" class="navbar-brand">
                            <img src="<?php echo URL_BASE;?>/Interfaz/Activos/Logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                            <span class="text-white fw-bold ms-2 fs-4 align-middle">Cursolandia</span>
                        </a>
                    </div>
                    <!-- Titulo -->
                    <div class="w-75 mt-3 text-center">
                        <h1 class="text-white fw-bold">¡Unite a Cursolandia!</h1>
                        <p class="text-white-50 fs-5 mt-3">Empeza a aprender y crear hoy</p>
                    </div>
                    <!-- Img -->
                    <div class="text-center w-100 mt-4">
                        <img src="<?php echo URL_BASE;?>/Interfaz/Activos/img registrarse.png" alt="" class="img-fluid" style="max-height: 250px;">
                    </div>
                </div>
                <!-- Formulario -->
                <div class="col-12 col-lg-6 mi-bg-grisclaro d-flex align-items-center justify-content-center position-relative">
                    <!-- header para celular -->
                    <div class="d-lg-none position-absolute top-0 start-0 w-100 p-3 mi-bg-grisazulado shadow-sm d-flex align-items-center">
                        <a href="<?php echo URL_BASE;?>/index.php" class="navbar-brand">
                            <img src="<?php echo URL_BASE;?>/Interfaz/Activos/Logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                            <span class="text-white fw-bold ms-2 fs-5">Cursolandia</span>
                        </a>
                    </div>                    
                    <div class="w-100 px-3" style="max-width: 400px;">
                        <h3 class="fw-bold text-center mi-color-text">Crear Cuenta</h3>
                        <p class="text-center mb-4 small">Completa tus datos para empezar</p>
                        <form action="" method="POST" name="finiciodesesion" class="needs-validation" novalidate>
                            <!-- Nombre Completo y Apellido -->
                            <div class="row g-2">
                                <!-- Nombre Completo -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nombrecompleto" name ="nombrecompleto" placeholder="" required>
                                        <label for="nombrecompleto" class="text-dark">Nombre Completo</label>
                                        <div class="invalid-feedback">
                                            Ingrese su nombre.
                                        </div>
                                    </div>
                                </div>
                                <!-- Apellido -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="apellido" name ="apellido" placeholder="" required>
                                        <label for="apellido" class="text-dark">Apellido</label>
                                        <div class="invalid-feedback">
                                            Ingrese su apellido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fecha de Nacimiento y Documento -->
                            <div class="row g-2">
                                <!-- Fecha de Nacimiento -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="fdn" name ="fdn" placeholder="" required>
                                        <label for="fdn" class="text-dark">Fecha de Nacimiento</label>
                                        <div class="invalid-feedback">
                                            Ingrese su fecha de nacimiento.
                                        </div>
                                    </div>
                                </div>
                                <!-- Documento -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="documento" name ="documento" placeholder="" required>
                                        <label for="documento" class="text-dark">N°Documento</label>
                                        <div class="invalid-feedback">
                                            Ingrese su numero de documento.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="emailr" name="emailr" placeholder="" required>
                                <label for="emailr">Email</label>
                                <div class="invalid-feedback">
                                    Ingrese un mail valido.
                                </div>
                            </div>
                            <!-- Contraseña -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="contraseñaregistrarse" name="contraseñaregistrarse" placeholder="" required minlength="8"> 
                                <label for="contraseñainicio">Contraseña</label>
                                <div class="invalid-feedback">
                                    Minimo 8 caracteres.
                                </div>
                            </div>
                            <!-- Terminos y Condiciones -->
                            <div class="form-check text-start">
                                <input type="checkbox" class="form-check-input" value="aceptartyc" id="tyc" name="tyc" required>
                                <label for="tyc" class="form-check-label text-muted small">Terminos y Condiciones</label>
                                <div class="invalid-feedback">
                                    Acepte los terminos y condiciones.
                                </div>
                            </div>
                            <a href="<?php echo URL_BASE;?>/Interfaz/Usuario/intereses.php" class="btn mis-bgs-btns my-3 w-100 h-50 text-light">REGISTRARSE<i class="bi bi-arrow-right-short"></i></a>
                        </form>
                        <p class="text-center small">¿Ya tenés una cuenta?<a href="<?php echo URL_BASE;?>/Interfaz/Usuario/acceder.php" class="text-decoration-none fw-bold"style="color: #AB978C;"> Inicia Sesión</a></p>
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
        <script src="<?php echo URL_BASE; ?>/Interfaz/Activos/validaciones.js"></script>
    </body>
</html>