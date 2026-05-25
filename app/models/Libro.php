<?php
/**
 * BookZone - Modelo Libro
 * Maneja todas las operaciones de base de datos para libros
 */

require_once __DIR__ . '/../../config/database.php';

class Libro {

    /**
     * Obtener todos los libros
     */
    public static function getAll(): array {
        $pdo = getConnection();
        $stmt = $pdo->query('SELECT * FROM libros ORDER BY fecha_creacion DESC');
        return $stmt->fetchAll();
    }

    /**
     * Obtener un libro por su ID
     */
    public static function getById(int $id): array|false {
        $pdo = getConnection();
        $stmt = $pdo->prepare('SELECT * FROM libros WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Obtener libros por categoría (para catálogo público)
     */
    public static function getByCategoria(string $categoria): array {
        $pdo = getConnection();
        $stmt = $pdo->prepare('SELECT * FROM libros WHERE categoria = ? ORDER BY titulo');
        $stmt->execute([$categoria]);
        return $stmt->fetchAll();
    }

    /**
     * Buscar libros por título o autor
     */
    public static function search(string $q): array {
        $pdo = getConnection();
        $like = '%' . $q . '%';
        $stmt = $pdo->prepare('SELECT * FROM libros WHERE titulo LIKE ? OR autor LIKE ? ORDER BY titulo');
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll();
    }

    /**
     * Obtener todas las categorías únicas
     */
    public static function getCategorias(): array {
        $pdo = getConnection();
        $stmt = $pdo->query('SELECT DISTINCT categoria FROM libros ORDER BY categoria');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Crear un nuevo libro
     */
    public static function create(string $titulo, string $autor, string $categoria, float $precio, int $stock, string $descripcion): bool {
        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'INSERT INTO libros (titulo, autor, categoria, precio, stock, descripcion) VALUES (?,?,?,?,?,?)'
        );
        return $stmt->execute([$titulo, $autor, $categoria, $precio, $stock, $descripcion]);
    }

    /**
     * Actualizar un libro existente
     */
    public static function update(int $id, string $titulo, string $autor, string $categoria, float $precio, int $stock, string $descripcion): bool {
        $pdo = getConnection();
        $stmt = $pdo->prepare(
            'UPDATE libros SET titulo=?, autor=?, categoria=?, precio=?, stock=?, descripcion=? WHERE id=?'
        );
        return $stmt->execute([$titulo, $autor, $categoria, $precio, $stock, $descripcion, $id]);
    }

    /**
     * Eliminar un libro
     */
    public static function delete(int $id): bool {
        $pdo = getConnection();
        $stmt = $pdo->prepare('DELETE FROM libros WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /**
     * Contar total de libros
     */
    public static function count(): int {
        $pdo = getConnection();
        return (int)$pdo->query('SELECT COUNT(*) FROM libros')->fetchColumn();
    }

    /**
     * Sumar stock total
     */
    public static function totalStock(): int {
        $pdo = getConnection();
        return (int)$pdo->query('SELECT SUM(stock) FROM libros')->fetchColumn();
    }
}
