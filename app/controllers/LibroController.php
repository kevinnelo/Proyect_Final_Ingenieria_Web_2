<?php
/**
 * BookZone - LibroController
 * Maneja el CRUD completo de libros
 */

require_once __DIR__ . '/../models/Libro.php';

class LibroController {

    /**
     * Verifica que el usuario esté autenticado
     */
    private function requireAuth(): void {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /bookzone/public/?ruta=login');
            exit;
        }
    }

    /**
     * Listar todos los libros (privado)
     */
    public function index(): void {
        $this->requireAuth();
        $libros  = Libro::getAll();
        $success = $_SESSION['libro_success'] ?? '';
        $error   = $_SESSION['libro_error']   ?? '';
        unset($_SESSION['libro_success'], $_SESSION['libro_error']);
        require_once __DIR__ . '/../views/libros/index.php';
    }

    /**
     * Formulario crear libro
     */
    public function crear(): void {
        $this->requireAuth();
        $error = $_SESSION['libro_error'] ?? '';
        unset($_SESSION['libro_error']);
        require_once __DIR__ . '/../views/libros/crear.php';
    }

    /**
     * Guardar nuevo libro
     */
    public function guardar(): void {
        $this->requireAuth();

        $titulo      = trim($_POST['titulo']      ?? '');
        $autor       = trim($_POST['autor']       ?? '');
        $categoria   = trim($_POST['categoria']   ?? '');
        $precio      = $_POST['precio']           ?? '';
        $stock       = $_POST['stock']            ?? '';
        $descripcion = trim($_POST['descripcion'] ?? '');

        // Validaciones básicas
        if (empty($titulo) || empty($autor) || empty($categoria) || $precio === '' || $stock === '') {
            $_SESSION['libro_error'] = 'Todos los campos marcados son obligatorios.';
            header('Location: /bookzone/public/?ruta=libros/crear');
            exit;
        }

        $precio = (float) $precio;
        $stock  = (int)   $stock;

        if ($precio < 0 || $stock < 0) {
            $_SESSION['libro_error'] = 'El precio y el stock no pueden ser negativos.';
            header('Location: /bookzone/public/?ruta=libros/crear');
            exit;
        }

        if (Libro::create($titulo, $autor, $categoria, $precio, $stock, $descripcion)) {
            $_SESSION['libro_success'] = 'Libro creado correctamente.';
        } else {
            $_SESSION['libro_error'] = 'Error al crear el libro. Intenta de nuevo.';
        }

        header('Location: /bookzone/public/?ruta=libros');
        exit;
    }

    /**
     * Formulario editar libro
     */
    public function editar(): void {
        $this->requireAuth();
        $id    = (int)($_GET['id'] ?? 0);
        $libro = Libro::getById($id);
        if (!$libro) {
            header('Location: /bookzone/public/?ruta=libros');
            exit;
        }
        $error = $_SESSION['libro_error'] ?? '';
        unset($_SESSION['libro_error']);
        require_once __DIR__ . '/../views/libros/editar.php';
    }

    /**
     * Actualizar libro
     */
    public function actualizar(): void {
        $this->requireAuth();

        $id          = (int)($_POST['id']          ?? 0);
        $titulo      = trim($_POST['titulo']       ?? '');
        $autor       = trim($_POST['autor']        ?? '');
        $categoria   = trim($_POST['categoria']    ?? '');
        $precio      = $_POST['precio']            ?? '';
        $stock       = $_POST['stock']             ?? '';
        $descripcion = trim($_POST['descripcion']  ?? '');

        if (!$id || empty($titulo) || empty($autor) || empty($categoria) || $precio === '' || $stock === '') {
            $_SESSION['libro_error'] = 'Todos los campos son obligatorios.';
            header('Location: /bookzone/public/?ruta=libros/editar&id=' . $id);
            exit;
        }

        if (Libro::update($id, $titulo, $autor, $categoria, (float)$precio, (int)$stock, $descripcion)) {
            $_SESSION['libro_success'] = 'Libro actualizado correctamente.';
        } else {
            $_SESSION['libro_error'] = 'Error al actualizar el libro.';
        }

        header('Location: /bookzone/public/?ruta=libros');
        exit;
    }

    /**
     * Eliminar libro
     */
    public function eliminar(): void {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id && Libro::delete($id)) {
            $_SESSION['libro_success'] = 'Libro eliminado correctamente.';
        } else {
            $_SESSION['libro_error'] = 'No se pudo eliminar el libro.';
        }
        header('Location: /bookzone/public/?ruta=libros');
        exit;
    }
}
