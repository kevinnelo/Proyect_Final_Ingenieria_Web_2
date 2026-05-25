<?php
/**
 * BookZone - Configuración de Base de Datos
 * Conexión PDO a MySQL
 */

define('DB_HOST', 'sql301.infinityfree.com');
define('DB_NAME', 'if0_42011269_bookzone');
define('DB_USER', 'if0_42011269');
define('DB_PASS', 'YcqX4yR6mTGC');       // En XAMPP por defecto es vacío
define('DB_CHARSET', 'utf8mb4');

/**
 * Retorna una conexión PDO activa.
 * Se llama desde los modelos cada vez que se necesita.
 */
function getConnection(): PDO {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // En producción nunca mostrar el mensaje real
        die('<p style="color:red;font-family:sans-serif;padding:20px;">
             ⚠️ Error de conexión a la base de datos. Verifica config/database.php<br>
             <small>' . htmlspecialchars($e->getMessage()) . '</small></p>');
    }
}
