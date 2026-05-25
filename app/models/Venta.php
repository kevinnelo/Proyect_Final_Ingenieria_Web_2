<?php
/**
 * BookZone - Modelo Venta
 * Maneja todas las operaciones de base de datos para ventas
 */

require_once __DIR__ . '/../../config/database.php';

class Venta {

    /**
     * Obtener todas las ventas (ordenadas por fecha descendente)
     */
    public static function getAll(): array {
        $pdo = getConnection();
        $stmt = $pdo->query(
            'SELECT v.*, l.titulo as libro_titulo, u.nombre as usuario_nombre 
             FROM ventas v
             JOIN libros l ON v.libro_id = l.id
             LEFT JOIN usuarios u ON v.usuario_id = u.id
             ORDER BY v.fecha_venta DESC'
        );
        return $stmt->fetchAll();
    }

    /**
     * Obtener una venta por su ID
     */
    public static function getById(int $id): array|false {
        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'SELECT v.*, l.titulo as libro_titulo, u.nombre as usuario_nombre 
             FROM ventas v
             JOIN libros l ON v.libro_id = l.id
             LEFT JOIN usuarios u ON v.usuario_id = u.id
             WHERE v.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Obtener ventas por usuario (empleado)
     */
    public static function getByUsuario(int $usuario_id): array {
        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'SELECT v.*, l.titulo as libro_titulo, u.nombre as usuario_nombre 
             FROM ventas v
             JOIN libros l ON v.libro_id = l.id
             LEFT JOIN usuarios u ON v.usuario_id = u.id
             WHERE v.usuario_id = ?
             ORDER BY v.fecha_venta DESC'
        );
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    /**
     * Crear una nueva venta
     * Retorna el ID de la venta creada, o false si falla
     */
    public static function create(int $libro_id, string $comprador_nombre, string $comprador_telefono, float $valor_total, int $usuario_id = null): int|bool {
        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'INSERT INTO ventas (libro_id, comprador_nombre, comprador_telefono, valor_total, usuario_id) 
             VALUES (?,?,?,?,?)'
        );
        if ($stmt->execute([$libro_id, $comprador_nombre, $comprador_telefono, $valor_total, $usuario_id])) {
            return (int)$pdo->lastInsertId();
        }
        return false;
    }

    /**
     * Contar total de ventas
     */
    public static function count(): int {
        $pdo = getConnection();
        return (int)$pdo->query('SELECT COUNT(*) FROM ventas')->fetchColumn();
    }

    /**
     * Obtener ventas totales (suma)
     */
    public static function totalVentas(): float {
        $pdo = getConnection();
        return (float)$pdo->query('SELECT SUM(valor_total) FROM ventas')->fetchColumn();
    }

    /**
     * Obtener últimas 5 ventas (para dashboard)
     */
    public static function getRecentes(int $limit = 5): array {
        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'SELECT v.*, l.titulo as libro_titulo, u.nombre as usuario_nombre 
             FROM ventas v
             JOIN libros l ON v.libro_id = l.id
             LEFT JOIN usuarios u ON v.usuario_id = u.id
             ORDER BY v.fecha_venta DESC
             LIMIT ?'
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
