-- =============================================
-- BookZone - Script de Actualización
-- Agregar tabla de Ventas
-- Ejecutar este script en una BD existente
-- =============================================

USE bookzone;

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

-- Crear índices para mejor rendimiento
CREATE INDEX idx_libro_id ON ventas(libro_id);
CREATE INDEX idx_usuario_id ON ventas(usuario_id);
CREATE INDEX idx_fecha_venta ON ventas(fecha_venta);

-- Confirmación
SELECT 'Tabla de ventas creada correctamente' AS status;
