-- Crear la base de datos y, por comodida para las pruebas, que se borre si ya fue creada cada vez que se carga en phpmyadmin.--
DROP DATABASE IF EXISTS Cursolandia;
CREATE DATABASE Cursolandia CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE Cursolandia;

-- Tabla de Usuarios -- 
CREATE TABLE Usuarios (
    U_ID INT AUTO_INCREMENT NOT NULL,
    U_DNI VARCHAR(8) NOT NULL,
    U_Nom VARCHAR(40) NOT NULL,
    U_Ape VARCHAR(40) NOT NULL,
    U_FDN DATE NOT NULL,
    U_Ant TEXT DEFAULT NULL,
    U_Email VARCHAR(255) NOT NULL,
    U_Contrasena VARCHAR(255) NOT NULL,
    U_Plan ENUM('gratuito','pro') NOT NULL DEFAULT 'gratuito',
    U_Rol ENUM('usuario','admin') NOT NULL DEFAULT 'usuario',
    U_FotoDePerfil VARCHAR(255) NOT NULL DEFAULT 'avatar_pordefecto.avif',
    PRIMARY KEY (U_ID),
    UNIQUE (U_DNI),
    UNIQUE (U_Email),
    CONSTRAINT chk_U_Email CHECK (U_Email LIKE '%_@__%.__%')
);
-- Definimos los Indices para facilitar la busqueda de email y plan --
CREATE INDEX idx_U_Email ON Usuarios(U_Email);
CREATE INDEX idx_U_Plan ON Usuarios(U_Plan);

-- Tabla de Solicitudes Pros --
CREATE TABLE Solicitudes_Pros (
    SP_ID INT AUTO_INCREMENT NOT NULL,
    U_ID_Solicita INT NOT NULL,
    U_ID_Administra INT DEFAULT NULL,
    SP_Texto VARCHAR(255) NOT NULL,
    SP_Comprobante VARCHAR(255) NOT NULL,
    SP_FDEmision DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    SP_FDVencimiento DATE DEFAULT NULL,
    SP_Estado ENUM('pendiente','aprobada','rechazada') NOT NULL DEFAULT 'pendiente',
    PRIMARY KEY (SP_ID),
    CONSTRAINT FK_U_ID_Solicita FOREIGN KEY (U_ID_Solicita) REFERENCES Usuarios(U_ID) ON DELETE CASCADE,
    CONSTRAINT FK_U_ID_Administra FOREIGN KEY (U_ID_Administra) REFERENCES Usuarios(U_ID) ON DELETE SET NULL
);

-- Tabla de Cursos -- 
CREATE TABLE Cursos (
    C_ID INT AUTO_INCREMENT NOT NULL,
    U_ID_Crea INT NOT NULL,
    C_Titulo VARCHAR (150) NOT NULL,
    C_Descripcion TEXT NOT NULL,
    C_Costo DECIMAL(10, 2) DEFAULT NULL,
    C_Cupos INT DEFAULT NULL,
    C_FDInicio DATE NOT NULL,
    C_FDFin DATE NOT NULL,
    C_Img VARCHAR(255) DEFAULT 'imgcurso_pordefecto.png',
    C_Acceso ENUM('publico','privado') NOT NULL DEFAULT 'publico',
    PRIMARY KEY (C_ID),
    CONSTRAINT FK_U_ID_Crea FOREIGN KEY (U_ID_Crea) REFERENCES Usuarios(U_ID) ON DELETE CASCADE,
    CONSTRAINT chk_C_Costo CHECK (C_Costo IS NULL OR C_Costo >= 0),
    CONSTRAINT chk_C_Cupos CHECK (C_Cupos IS NULL OR C_Cupos >= 0),
    CONSTRAINT chk_C_Fechas CHECK (C_FDInicio <= C_FDFin)
);

-- Indices para encontrar los cursos creados por sus titulos y/o buscar por fechas --
CREATE INDEX idx_C_Titulo ON Cursos(C_Titulo);
CREATE INDEX idx_C_Fechas ON Cursos(C_FDInicio,C_FDFin);

-- Tabla Tomo (Relacion N:M entre usuarios y cursos) --
CREATE TABLE Tomo (
    U_ID_Tomo INT NOT NULL,
    C_ID_Tomo INT NOT NULL,
    Estado_Tomo ENUM('pendiente','confirmada','rechazada') NOT NULL DEFAULT 'pendiente',
    Fecha_Tomo DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (U_ID_Tomo,C_ID_Tomo),
    CONSTRAINT FK_U_ID_Tomo FOREIGN KEY (U_ID_Tomo) REFERENCES Usuarios(U_ID) ON DELETE CASCADE,
    CONSTRAINT FK_C_ID_Tomo FOREIGN KEY (C_ID_Tomo) REFERENCES Cursos(C_ID) ON DELETE CASCADE
);

-- Tabla de Etiquetas --
CREATE TABLE Etiquetas (
    E_ID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    E_Nombre VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla Tiene (Relacion N:M entre Curso y Etiquetas) --
CREATE TABLE Tiene (
    C_ID_Tiene INT NOT NULL,
    E_ID_Tiene INT NOT NULL,
    PRIMARY KEY (C_ID_Tiene,E_ID_Tiene),
    CONSTRAINT FK_C_ID_Tiene FOREIGN KEY (C_ID_Tiene) REFERENCES Cursos(C_ID) ON DELETE CASCADE,
    CONSTRAINT FK_E_ID_Tiene FOREIGN KEY (E_ID_Tiene) REFERENCES Etiquetas(E_ID) ON DELETE CASCADE
);

-- Tabla de Intereses (Relacion entre Usuario y Etiquetas) -- 
CREATE TABLE Intereses (
    U_ID_Intereses INT NOT NULL,
    E_ID_Intereses INT NOT NULL,
    PRIMARY KEY (U_ID_Intereses,E_ID_Intereses),
    CONSTRAINT FK_U_ID_Intereses FOREIGN KEY (U_ID_Intereses) REFERENCES Usuarios(U_ID) ON DELETE CASCADE,
    CONSTRAINT FK_E_ID_Intereses FOREIGN KEY (E_ID_Intereses) REFERENCES Etiquetas(E_ID) ON DELETE CASCADE
);

-- Tabla de Materiales -- 
CREATE TABLE Materiales (
    M_ID INT AUTO_INCREMENT NOT NULL,
    C_ID_Adjunta INT NOT NULL,
    M_Nombre VARCHAR(255) NOT NULL,
    M_Ruta VARCHAR(255) NOT NULL,
    M_Tipo VARCHAR(100) NOT NULL,
    M_Tamano INT NOT NULL,
    M_FDSubida DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (M_ID),
    CONSTRAINT FK_C_ID_Adjunta FOREIGN KEY (C_ID_Adjunta) REFERENCES Cursos(C_ID) ON DELETE CASCADE,
    CONSTRAINT chk_M_Tamano CHECK (M_Tamano > 0)
);

-- Tabla de Preguntas --
CREATE TABLE Preguntas (
    P_ID INT AUTO_INCREMENT NOT NULL,
    C_ID_Contiene INT NOT NULL,
    U_ID_Inicia INT NOT NULL,
    P_Titulo VARCHAR(150) NOT NULL,
    P_Texto TEXT NOT NULL,
    P_Destacada TINYINT(1) NOT NULL DEFAULT 0,
    P_Cerrada TINYINT(1) NOT NULL DEFAULT 0,
    P_FDCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (P_ID),
    CONSTRAINT FK_C_ID_Contiene FOREIGN KEY (C_ID_Contiene) REFERENCES Cursos(C_ID) ON DELETE CASCADE,
    CONSTRAINT FK_U_ID_Inicia FOREIGN KEY (U_ID_Inicia) REFERENCES Usuarios(U_ID) ON DELETE CASCADE
);

-- Tabla de Respuestas --
CREATE TABLE Respuestas (
    R_ID INT AUTO_INCREMENT NOT NULL,
    U_ID_Realiza INT NOT NULL,
    P_ID_Pertenece INT NOT NULL,
    R_Texto TEXT NOT NULL,
    R_Aceptada TINYINT(1) NOT NULL DEFAULT 0,
    R_FDCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    R_FDEdicion DATETIME DEFAULT NULL,
    PRIMARY KEY (R_ID),
    CONSTRAINT FK_U_ID_Realiza FOREIGN KEY (U_ID_Realiza) REFERENCES Usuarios(U_ID) ON DELETE CASCADE,
    CONSTRAINT FK_P_ID_Pertenece FOREIGN KEY (P_ID_Pertenece) REFERENCES Preguntas(P_ID) ON DELETE CASCADE
);

-- Tabla de Notificaciones --
CREATE TABLE Notificaciones (
    N_ID INT AUTO_INCREMENT NOT NULL,
    P_ID_Crea INT DEFAULT NULL,
    R_ID_Crea INT DEFAULT NULL,
    N_Texto TEXT NOT NULL,
    N_Fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (N_ID),
    CONSTRAINT FK_P_ID_Notifica FOREIGN KEY (P_ID_Crea) REFERENCES Preguntas(P_ID) ON DELETE SET NULL,
    CONSTRAINT FK_R_ID_Notifica FOREIGN KEY (R_ID_Crea) REFERENCES Respuestas(R_ID) ON DELETE SET NULL
);

-- Tabla de Notifica (Relacion entre Usuario y Notificacion) --
CREATE TABLE Notifica (
    N_ID_Notifica INT NOT NULL,
    U_ID_Notifica INT NOT NULL,
    Leida_Notifica TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (N_ID_Notifica,U_ID_Notifica),
    CONSTRAINT FK_N_ID_Notifica FOREIGN KEY (N_ID_Notifica) REFERENCES Notificaciones (N_ID) ON DELETE CASCADE,
    CONSTRAINT FK_U_ID_Notifica FOREIGN KEY (U_ID_Notifica) REFERENCES Usuarios (U_ID) ON DELETE CASCADE
);

-- Inserts de prueba -- 

-- Etiquetas --
INSERT INTO Etiquetas (E_Nombre) VALUES ("Programacion"), ("Base de Datos");

-- Usuarios --
INSERT INTO Usuarios (U_Nom,U_Ape,U_DNI,U_FDN,U_Email,U_Contrasena,U_Ant,U_Plan,U_Rol) 
VALUES ("Facundo","Donaire","44985728","2003-04-01","f@gmail.com","123456789","Estudiante","pro","admin"),
("Gerardo","Ismael","12345678","2003-05-01","gi@gmail.com.ar","123456789","Licenciado en Geologia","gratuito","usuario"),
("Lucas","Geron","88882222","2004-05-20","ll@gmail.com","123456789","Ferroviario","pro","usuario");