-- =============================================
-- BookZone - Script SQL
-- Base de datos para la aplicación de librería
-- =============================================

-- -------------------------
-- Tabla: usuarios
-- -------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'empleado') NOT NULL DEFAULT 'empleado',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------
-- Tabla: libros
-- -------------------------
CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    descripcion TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------
-- Tabla: ventas
-- -------------------------
CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libro_id INT NOT NULL,
    comprador_nombre VARCHAR(150) NOT NULL,
    comprador_telefono VARCHAR(30) NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    usuario_id INT NULL,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- Datos de prueba
-- =============================================

-- Usuario administrador (password: admin123)
INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@bookzone.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('María López', 'maria@bookzone.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'empleado');

-- Nota: el hash anterior corresponde a "password" en bcrypt.
-- Para usar "admin123", ejecuta en PHP: echo password_hash('admin123', PASSWORD_DEFAULT);
-- y reemplaza el hash. O usa el siguiente par de credenciales directo:
-- email: admin@bookzone.com | password: admin123

-- Libros de prueba
INSERT INTO libros (titulo, autor, categoria, precio, stock, descripcion) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 'Literatura', 35000.00, 15, 'Obra maestra del realismo mágico latinoamericano. La historia de la familia Buendía a lo largo de siete generaciones en el pueblo ficticio de Macondo.'),
('El principito', 'Antoine de Saint-Exupéry', 'Infantil', 22000.00, 30, 'Un clásico de la literatura universal que narra el viaje de un pequeño príncipe por diferentes planetas hasta llegar a la Tierra.'),
('Harry Potter y la piedra filosofal', 'J.K. Rowling', 'Fantasía', 42000.00, 20, 'El inicio de la saga del joven mago Harry Potter y sus aventuras en el colegio Hogwarts de magia y hechicería.'),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 'Clásicos', 55000.00, 8, 'Considerada la primera novela moderna. Las aventuras del ingenioso hidalgo Don Quijote y su fiel escudero Sancho Panza.'),
('El alquimista', 'Paulo Coelho', 'Autoayuda', 28000.00, 25, 'La historia de Santiago, un joven pastor andaluz que sueña con encontrar un tesoro y emprende un viaje por el desierto de Sahara.'),
('1984', 'George Orwell', 'Ciencia Ficción', 31000.00, 12, 'Una distopía ambientada en un régimen totalitario donde el Gran Hermano vigila a todos los ciudadanos del estado de Oceanía.'),
('Sapiens: De animales a dioses', 'Yuval Noah Harari', 'Historia', 48000.00, 18, 'Un recorrido por la historia de la humanidad desde los primeros humanos hasta la era moderna y los desafíos del futuro.'),
('La sombra del viento', 'Carlos Ruiz Zafón', 'Misterio', 38000.00, 10, 'Un joven descubre un misterioso libro en el Cementerio de los Libros Olvidados de Barcelona que cambiará su vida para siempre.');
