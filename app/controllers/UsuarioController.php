<?php
/**
 * BookZone - UsuarioController
 * Maneja el CRUD completo de usuarios
 */

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {

    /**
     * Solo admins pueden acceder a la gestión de usuarios
     */
    private function requireAdmin(): void {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /bookzone/public/?ruta=login');
            exit;
        }
        if ($_SESSION['usuario_rol'] !== 'admin') {
            header('Location: /bookzone/public/?ruta=dashboard');
            exit;
        }
    }

    /**
     * Listar todos los usuarios
     */
    public function index(): void {
        $this->requireAdmin();
        $usuarios = Usuario::getAll();
        $success  = $_SESSION['usuario_success'] ?? '';
        $error    = $_SESSION['usuario_error']   ?? '';
        unset($_SESSION['usuario_success'], $_SESSION['usuario_error']);
        require_once __DIR__ . '/../views/usuarios/index.php';
    }

    /**
     * Formulario crear usuario
     */
    public function crear(): void {
        $this->requireAdmin();
        $error = $_SESSION['usuario_error'] ?? '';
        unset($_SESSION['usuario_error']);
        require_once __DIR__ . '/../views/usuarios/crear.php';
    }

    /**
     * Guardar nuevo usuario
     */
    public function guardar(): void {
        $this->requireAdmin();

        $nombre   = trim($_POST['nombre']   ?? '');
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');
        $rol      = trim($_POST['rol']      ?? '');

        if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
            $_SESSION['usuario_error'] = 'Todos los campos son obligatorios.';
            header('Location: /bookzone/public/?ruta=usuarios/crear');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['usuario_error'] = 'El correo no tiene un formato válido.';
            header('Location: /bookzone/public/?ruta=usuarios/crear');
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['usuario_error'] = 'La contraseña debe tener al menos 6 caracteres.';
            header('Location: /bookzone/public/?ruta=usuarios/crear');
            exit;
        }

        if (Usuario::emailExists($email)) {
            $_SESSION['usuario_error'] = 'Ese correo ya está registrado.';
            header('Location: /bookzone/public/?ruta=usuarios/crear');
            exit;
        }

        if (!in_array($rol, ['admin', 'empleado'])) {
            $_SESSION['usuario_error'] = 'Rol no válido.';
            header('Location: /bookzone/public/?ruta=usuarios/crear');
            exit;
        }

        if (Usuario::create($nombre, $email, $password, $rol)) {
            $_SESSION['usuario_success'] = 'Usuario creado correctamente.';
        } else {
            $_SESSION['usuario_error'] = 'Error al crear el usuario.';
        }

        header('Location: /bookzone/public/?ruta=usuarios');
        exit;
    }

    /**
     * Formulario editar usuario
     */
    public function editar(): void {
        $this->requireAdmin();
        $id      = (int)($_GET['id'] ?? 0);
        $usuario = Usuario::getById($id);
        if (!$usuario) {
            header('Location: /bookzone/public/?ruta=usuarios');
            exit;
        }
        $error = $_SESSION['usuario_error'] ?? '';
        unset($_SESSION['usuario_error']);
        require_once __DIR__ . '/../views/usuarios/editar.php';
    }

    /**
     * Actualizar usuario
     */
    public function actualizar(): void {
        $this->requireAdmin();

        $id       = (int)($_POST['id']       ?? 0);
        $nombre   = trim($_POST['nombre']    ?? '');
        $email    = trim($_POST['email']     ?? '');
        $password = trim($_POST['password']  ?? '');
        $rol      = trim($_POST['rol']       ?? '');

        if (!$id || empty($nombre) || empty($email) || empty($rol)) {
            $_SESSION['usuario_error'] = 'Nombre, email y rol son obligatorios.';
            header('Location: /bookzone/public/?ruta=usuarios/editar&id=' . $id);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['usuario_error'] = 'Formato de correo inválido.';
            header('Location: /bookzone/public/?ruta=usuarios/editar&id=' . $id);
            exit;
        }

        if (Usuario::emailExists($email, $id)) {
            $_SESSION['usuario_error'] = 'Ese correo ya está registrado por otro usuario.';
            header('Location: /bookzone/public/?ruta=usuarios/editar&id=' . $id);
            exit;
        }

        // Impedir que el admin se cambie su propio rol
        if ($id === (int)$_SESSION['usuario_id'] && $rol !== 'admin') {
            $_SESSION['usuario_error'] = 'No puedes cambiar tu propio rol.';
            header('Location: /bookzone/public/?ruta=usuarios/editar&id=' . $id);
            exit;
        }

        if (Usuario::update($id, $nombre, $email, $rol, $password)) {
            $_SESSION['usuario_success'] = 'Usuario actualizado correctamente.';
        } else {
            $_SESSION['usuario_error'] = 'Error al actualizar el usuario.';
        }

        header('Location: /bookzone/public/?ruta=usuarios');
        exit;
    }

    /**
     * Eliminar usuario
     */
    public function eliminar(): void {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);

        // No puede eliminarse a sí mismo
        if ($id === (int)$_SESSION['usuario_id']) {
            $_SESSION['usuario_error'] = 'No puedes eliminar tu propio usuario.';
            header('Location: /bookzone/public/?ruta=usuarios');
            exit;
        }

        if ($id && Usuario::delete($id)) {
            $_SESSION['usuario_success'] = 'Usuario eliminado correctamente.';
        } else {
            $_SESSION['usuario_error'] = 'No se pudo eliminar el usuario.';
        }
        header('Location: /bookzone/public/?ruta=usuarios');
        exit;
    }
}
