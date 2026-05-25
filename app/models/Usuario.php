<?php
/**
 * BookZone - Modelo Usuario
 * Maneja todas las operaciones de base de datos para usuarios
 */

require_once __DIR__ . '/../../config/database.php';

class Usuario {

    /**
     * Obtener todos los usuarios
     */
    public static function getAll(): array {
        $pdo = getConnection();
        $stmt = $pdo->query('SELECT id, nombre, email, rol, fecha_creacion FROM usuarios ORDER BY fecha_creacion DESC');
        return $stmt->fetchAll();
    }

    /**
     * Obtener un usuario por su ID
     */
    public static function getById(int $id): array|false {
        $pdo = getConnection();
        $stmt = $pdo->prepare('SELECT id, nombre, email, rol, fecha_creacion FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Obtener un usuario por email (para login)
     */
    public static function getByEmail(string $email): array|false {
        $pdo = getConnection();
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Crear un nuevo usuario
     */
    public static function create(string $nombre, string $email, string $password, string $rol): bool {
        $pdo = getConnection();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            'INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$nombre, $email, $hash, $rol]);
    }

    /**
     * Actualizar un usuario existente
     */
    public static function update(int $id, string $nombre, string $email, string $rol, string $password = ''): bool {
        $pdo = getConnection();
        if (!empty($password)) {
            // Si se envió nueva contraseña, actualizarla también
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                'UPDATE usuarios SET nombre=?, email=?, password=?, rol=? WHERE id=?'
            );
            return $stmt->execute([$nombre, $email, $hash, $rol, $id]);
        } else {
            $stmt = $pdo->prepare(
                'UPDATE usuarios SET nombre=?, email=?, rol=? WHERE id=?'
            );
            return $stmt->execute([$nombre, $email, $rol, $id]);
        }
    }

    /**
     * Eliminar un usuario
     */
    public static function delete(int $id): bool {
        $pdo = getConnection();
        $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /**
     * Verificar si un email ya está registrado
     */
    public static function emailExists(string $email, int $excludeId = 0): bool {
        $pdo = getConnection();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE email = ? AND id != ?');
        $stmt->execute([$email, $excludeId]);
        return (int)$stmt->fetchColumn() > 0;
    }
}
