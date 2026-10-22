-- Crear la base de datos y, por comodida para las pruebas, que se borre cada vez que se carga en phpmyadmin.--
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
    U_Contraseña VARCHAR(255) NOT NULL,
    U_Plan ENUM('gratuito','pro') NOT NULL DEFAULT 'gratuito',
    U_Rol ENUM('usuario','admin') NOT NULL DEFAULT 'usuario',
    U_FotoDePerfil VARCHAR(255) NOT NULL DEFAULT 'avatar_pordefecto.png',
    PRIMARY KEY (U_ID),
    UNIQUE (U_DNI),
    UNIQUE (U_Email),
    CONSTRAINT chk_U_Email CHECK (U_Email LIKE '%_@__%.__%')
);
-- Definimos los Indices para facilitar la busqueda de email y plan --
CREATE INDEX idx_U_Email ON Usuarios(U_Email);
CREATE INDEX idx_U_Plan ON Usuario(U_Plan);

-- Tabla de Solicitudes Pros --
CREATE TABLE Solicitudes_Pros (
    SP_ID INT AUTO_INCREMENT NOT NULL,
    SP_U_ID_Solicita INT NOT NULL,
    SP_U_ID_Administra INT DEFAULT NULL,
    SP_Texto VARCHAR(255) NOT NULL,
    SP_Comprobante VARCHAR(255) NOT NULL,
    SP_FDEmision DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    SP_FDVencimiento DATE DEFAULT NULL,
    SP_Estado ENUM('pendiente','aprobada','rechazada') NOT NULL DEFAULT 'pendiente',
    PRIMARY KEY (SP_ID),
    CONSTRAINT FK_SP_U_ID_Solicita FOREIGN KEY (SP_U_ID_Solicita) REFERENCES Usuarios(U_ID) ON DELETE CASCADE,
    CONSTRAINT FK_SP_U_ID_Administra FOREIGN KEY (SP_U_ID_Administra) REFERENCES Usuarios(U_ID) ON DELETE SET NULL
);

-- Tabla de Inscripciones -- 
CREATE TABLE Inscripciones (
    I_ID INT AUTO_INCREMENT NOT NULL,
    I_Estado ENUM('pendiente','confirmada','rechazada'),
    I_FDInscripcion DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (I_ID)
);

-- Tabla de Cursos -- 
CREATE TABLE Cursos (
    C_ID INT AUTO_INCREMENT NOT NULL,
    C_U_ID_Crea INT NOT NULL,
    C_Titulo VARCHAR (150) NOT NULL,
    C_Descripcion TEXT NOT NULL,
    C_Costo DECIMAL(10, 2) DEFAULT NULL,
    C_Cupos INT DEFAULT NULL,
    C_FDInicio DATE NOT NULL,
    C_FDFin DATE NOT NULL,
    C_Img VARCHAR(255) DEFAULT 'imgcurso_pordefecto.png',
    PRIMARY KEY (C_ID),
    CONSTRAINT FK_C_U_ID_Crea FOREIGN KEY C_U_ID_Crea REFERENCES Usuario(U_ID)
    CONSTRAINT chk_C_Costo CHECK (C_Costo IS NULL OR C_Costo >= 0),
    CONSTRAINT chk_C_Cupos CHECK (C_Cupos IS NULL OR C_Cupos >= 0),
    CONSTRAINT chk_C_Fechas CHECK (C_FDInicio <= C_FDFin)
);

-- Indices para encontrar los cursos creados por sus titulos y/o buscar por fechas --
CREATE INDEX idx_C_Titulo ON Cursos(C_Titulo);
CREATE INDEX idx_C_Fechas ON Cursos(C_FDInicio,C_FDFin);