-- CREAR BASE DE DATOS
CREATE DATABASE IF NOT EXISTS clinica_db;
USE clinica_db;
-- Tabla de Usuarios (Para Login)
CREATE TABLE usuarios ( id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, rol ENUM('admin', 'recepcionista') NOT NULL DEFAULT 'recepcionista', creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Tabla de Pacientes
CREATE TABLE pacientes ( id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, telefono VARCHAR(20), email VARCHAR(100) UNIQUE, fecha_nacimiento DATE, historial TEXT
);
-- Tabla de Citas
CREATE TABLE citas ( id INT AUTO_INCREMENT PRIMARY KEY, paciente_id INT NOT NULL, fecha DATETIME NOT NULL, motivo VARCHAR(255), estado ENUM('pendiente', 'confirmada', 'cancelada') NOT NULL DEFAULT 'pendiente', FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
);
-- INSERTAR USUARIO INICIAL (Email: admin@clinica.com, Contraseña: 123456)
INSERT INTO usuarios (nombre, email, password_hash, rol) VALUES
('Admin General', 'admin@clinica.com', '123456', 'admin');