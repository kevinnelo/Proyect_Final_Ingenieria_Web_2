<?php
/**
 * BookZone - AuthController
 * Maneja el login y cierre de sesión
 */

require_once __DIR__ . '/../models/Usuario.php';

class AuthController {

    /**
     * Muestra el formulario de login o redirige si ya hay sesión
     */
    public function loginForm(): void {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /bookzone/public/?ruta=dashboard');
            exit;
        }
        $error = $_SESSION['login_error'] ?? '';
        unset($_SESSION['login_error']);
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Procesa el formulario de login
     */
    public function loginPost(): void {
        // Validar que vengan los campos
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['login_error'] = 'Por favor completa todos los campos.';
            header('Location: /bookzone/public/?ruta=login');
            exit;
        }

        // Sanitizar email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['login_error'] = 'El correo no tiene un formato válido.';
            header('Location: /bookzone/public/?ruta=login');
            exit;
        }

        // Buscar usuario en BD
        $usuario = Usuario::getByEmail($email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            // Regenerar ID de sesión (seguridad contra session fixation)
            session_regenerate_id(true);
            $_SESSION['usuario_id']     = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_rol']    = $usuario['rol'];
            header('Location: /bookzone/public/?ruta=dashboard');
            exit;
        }

        $_SESSION['login_error'] = 'Correo o contraseña incorrectos.';
        header('Location: /bookzone/public/?ruta=login');
        exit;
    }

    /**
     * Cierra la sesión
     */
    public function logout(): void {
        session_unset();
        session_destroy();
        header('Location: /bookzone/public/');
        exit;
    }
}
