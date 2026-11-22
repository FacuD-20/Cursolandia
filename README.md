Cursolandia - Sistema de Gestión de Cursos y Aprendizaje

    Cursolandia es una plataforma web colaborativa desarrollada en PHP y MySQL (MariaDB), que esta diseñada para la gestión integral de cursos en línea, catálogos con filtros avanzados, foros de preguntas y respuestas con respuestas anidadas, y control de perfiles de usuario y planes (Gratuito / Pro).

Requisitos del Sistema

    Para ejecutar y probar este proyecto localmente, asegurese de contar con:
    _XAMPP (o entorno equivalente con PHP 8.x y Apache).
    _MySQL / MariaDB.
    _Un navegador web moderno (Chrome, Firefox, Edge).

Instalación y Configuración

    1_Clonar o copiar el proyecto:
        Coloque la carpeta 'Cursolandia' dentro del directorio raíz de su servidor local (por ejemplo, C:\xampp\htdocs\Cursolandia).
    2_Configure la Base de Datos:
        Abra phpMyAdmin (http://localhost/phpmyadmin/).
        Importe el archivo SQL ubicado en la raíz (cursolandia.sql). Esto creará automáticamente la base de datos Cursolandia con todas sus tablas, relaciones e índices y datos de prueba.
        Verifique las credenciales de acceso a su base de datos en `Persistencia/conexion.php`.
    3_Verificar las Rutas Base:
        El archivo `carga.php` detecta automáticamente si el sistema corre en entorno local (`/Cursolandia`) o en servidor de producción, utilizando `__DIR__` para `RUTA_BASE`. Si en su equipo usa otro nombre de carpeta, ajuste la constante `URL_BASE` en `carga.php`.
    4_Iniciar el servidor:
        Encienda los servicios de Apache y MySQL desde el panel de control de XAMPP.
        Ingrese a su navegador en: http://localhost/Cursolandia/index.php.

Usuarios de Prueba

    Para probar los roles de Administrador, usuarios con Plan Pro y usuarios con Plan Gratuito, puede utilizar las siguientes credenciales precargadas en el sistema:

    1_Administrador (Plan Pro)
        Email: ms@gmail.com
        Contraseña: 123456789
        Nombre: Mateo Sosa
        Permisos: Panel de administración de solicitudes Pro, creación e inscripción de cursos ilimitados.
    2_Usuario Común (Plan Gratuito)
        Email: gi@gmail.com.ar
        Contraseña: 123456789
        Nombre: Gerardo Ismael
        Permisos: Límite de 3 cursos creados y 3 inscripciones, subida de hasta 5 archivos (máx. 5 MB por archivo y 10 MB en total).
    3_Usuario Pro (Plan Pro)
        Email: ll@gmail.com
        Contraseña: 123456789
        Nombre: Lucas Geron
        Permisos: Cursos ilimitados y sin restricciones de cantidad o tamaño en materiales.