<?php
/**
 * BookZone - setup_password.php
 * Ejecuta este archivo UNA VEZ en XAMPP para insertar el usuario admin
 * con la contraseña correctamente hasheada.
 *
 * URL: http://localhost/bookzone/setup_password.php
 * ELIMINA ESTE ARCHIVO después de ejecutarlo.
 */

require_once __DIR__ . '/config/database.php';

$pdo = getConnection();

// Limpiar usuarios previos si los hay
$pdo->exec('DELETE FROM usuarios WHERE email IN ("admin@bookzone.com", "maria@bookzone.com")');

$usuarios = [
    ['Administrador', 'admin@bookzone.com', 'admin123', 'admin'],
    ['María López',   'maria@bookzone.com', 'admin123', 'empleado'],
];

$stmt = $pdo->prepare('INSERT INTO usuarios (nombre, email, password, rol) VALUES (?,?,?,?)');

foreach ($usuarios as $u) {
    $hash = password_hash($u[2], PASSWORD_DEFAULT);
    $stmt->execute([$u[0], $u[1], $hash, $u[3]]);
    echo "✅ Usuario creado: {$u[1]} (contraseña: {$u[2]})<br>";
}

echo '<br><strong style="color:green">¡Listo! Ya puedes hacer login.</strong>';
echo '<br><a href="/bookzone/public/?ruta=login">Ir al login →</a>';
echo '<br><br><em style="color:red">⚠️ Recuerda eliminar este archivo (setup_password.php) por seguridad.</em>';
