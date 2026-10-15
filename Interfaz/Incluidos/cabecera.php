<?php
require_once __DIR__ . '/../../carga.php';
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
                    <a class="navbar-brand" href="#">Cursolandia</a>
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
                        <!-- Apartado para los botones ingresar/Registrarse -->
                        <div class="mi-bg-ir d-lg-none p-3 mt-3 mb-2 text-light rounded">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-person-circle px-2 fs-3"></i>
                                <h5>¡Bienvenido a Cursolandia!</h5>
                            </div>
                            <p class="small">Inicie Sesion o Cree una cuenta para ingresar.</p>
                            <div class="d-flex gap-2">
                                <!-- Botones de Inicion de Sesion y Registro -->
                                <a href="" class="btn mi-btn-i w-50">Iniciar Sesion</a>
                                <a href="" class="btn mi-btn-r w-50">Registrarse</a>
                            </div>
                        </div>
                        <!-- Opciones Varias -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house me-2"></i>Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="bi bi-book me-2"></i>Cursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="bi bi-patch-plus me-2"></i></i>Crear Curso</a>
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
                        <!-- Btnes de Inicio y Registro para Pantallas >= lg -->
                        <div class="d-none d-lg-flex ms-auto gap-2">
                            <a href="" class="btn mi-btn-i">Iniciar Sesion</a>
                            <a href="" class="btn mi-btn-r">Registrarse</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>