<?php
    require_once __DIR__ . '/../../carga.php';
    session_start();
    //Creamos una ruta dependiendo de la foto de perfil del usuario.
    if (isset($_SESSION["id_usuario"])) {
        if ($_SESSION["fp_usuario"] == "avatar_pordefecto.avif") {
            $rutafp = URL_BASE . "/Interfaz/Activos/" . $_SESSION["fp_usuario"];
        } else {
            $rutafp = URL_BASE . "/Subidos/" . $_SESSION["fp_usuario"];
        }
    }
?>

<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Cursolandia</title>
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
    <body class="d-flex flex-column min-vh-100">
        <header>
            <!--navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark mi-bg-grisazulado">
                <div class="container-fluid">
                    <!-- Logo/Nombre -->
                    <a class="navbar-brand" href="<?php echo URL_BASE;?>/index.php">
                        <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                        <span class="text-white fw-bold ms-2 fs-5">Cursolandia</span>
                    </a>
                    <!-- Pantalla para celular -->
                    <!-- Buscador -->
                    <form class="d-lg-none d-flex flex-grow-1 mx-2" role="search">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Buscar por título o etiqueta..." aria-label="Buscar"/>
                            <button class="btn btn-light me-2" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <!--Boton Hamburgesa-->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Menu Colapsable -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Apartado para los usuario logeados Celular -->
                        <?php if (isset($_SESSION["id_usuario"])): ?>
                            <div class="mi-bg-ir d-lg-none p-3 mt-3 mb-2 text-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="<?php echo $rutafp; ?>" alt="Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0 fw-bold">¡Hola, <?php echo $_SESSION["nombre_usuario"]; ?>!</h6>
                                        <span class="badge mi-bg-bronce text-light text-uppercase"><?php echo $_SESSION["rol_usuario"];?></span>
                                    </div>
                                    <!-- Boton de notificaciones -->
                                    <a href="#" class="text-light ms-auto fs-4"><i class="bi bi-bell"></i></a>
                                </div>
                                <div class="d-flex gap-2">
                                    <!-- Botones de Mi perfil y Salir -->
                                    <a href="<?php echo URL_BASE;?>/Interfaz/Usuario/perfil.php" class="btn mi-btn-i w-50">Mi Perfil</a>
                                    <a href="<?php echo URL_BASE;?>/Logica/cerrar_s.php" class="btn mi-btn-r w-50">Cerrar Sesion</a>
                                </div>
                            </div>
                        <!-- Apartado para los usuarios visitantes Celular -->
                        <?php else: ?>
                            <div class="mi-bg-ir d-lg-none p-3 mt-3 mb-2 text-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-person-circle px-2 fs-3"></i>
                                    <h5>¡Bienvenido a Cursolandia!</h5>
                                </div>
                                <p class="small">Inicie Sesion o Cree una cuenta para ingresar.</p>
                                <div class="d-flex gap-2">
                                    <!-- Botones de Inicion de Sesion y Registro -->
                                    <a href="<?php echo URL_BASE;?>/Interfaz/Usuario/acceder.php" class="btn mi-btn-i w-50">Iniciar Sesion</a>
                                    <a href="<?php echo URL_BASE;?>/Interfaz/Usuario/registrarse.php" class="btn mi-btn-r w-50">Registrarse</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Opciones Varias -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo URL_BASE;?>/index.php"><i class="bi bi-house me-2"></i>Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL_BASE;?>/Interfaz/Cursos/catalogo.php"><i class="bi bi-book me-2"></i>Cursos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categorías
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Programación</a></li>
                                    <li><a class="dropdown-item" href="#">Diseño Grafico</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Barra de busqueda para Pantallas >= lg -->
                        <form class="d-none d-lg-flex flex-grow-1 mx-3" role="search">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Buscar por título o etiqueta..." aria-label="Buscar"/>
                                <button class="btn btn-light me-2" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                        <!-- Apartado para los usuario logeados lg + -->
                        <?php if (isset($_SESSION["id_usuario"])): ?>
                            <div class="d-none d-lg-flex ms-auto align-items-center gap-3">
                                <!-- Boton ponel de administracion solo para lo que son administradores -->
                                <?php if ($_SESSION["rol_usuario"] == "administrador"): ?>
                                    <a href="" class="btn btn-sm btn-outline-light">Panel de Administracion</a>
                                <?php endif; ?>
                                <!-- Boton de notificaciones -->
                                <a href="#" class="text-light fs-5 position-relative">
                                    <i class="bi bi-bell"></i>
                                </a>
                                <!-- Dropdwon del perfil del usuario con su nombre y foto -->
                                <div class="dropdown me-2">
                                    <a class="d-flex align-items-center text-light text-decoration-none dropdown-toggle me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span><?php echo $_SESSION["nombre_usuario"]?></span>
                                        <img src="<?php echo $rutafp?>" alt="Avatar" class="rounded-circle ms-2" style="width: 35px; height: 35px; object-fit: cover;">
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end me-1">
                                        <li><a class="dropdown-item" href="<?php echo URL_BASE; ?>/Interfaz/Usuario/perfil.php">Mi Perfil</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="<?php echo URL_BASE; ?>/Logica/cerrar_s.php">Cerrar Sesión</a></li>
                                    </ul>
                                </div>
                            </div>
                        <!-- Btnes de Inicio y Registro para Pantallas >= lg -->
                        <?php else: ?>
                            <div class="d-none d-lg-flex ms-auto gap-2">
                                <a href="<?php echo URL_BASE;?>/Interfaz/Usuario/acceder.php" class="btn mi-btn-i">Iniciar Sesion</a>
                                <a href="<?php echo URL_BASE;?>/Interfaz/Usuario/registrarse.php" class="btn mi-btn-r">Registrarse</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>