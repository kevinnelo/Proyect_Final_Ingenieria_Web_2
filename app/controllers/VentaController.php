<?php
/**
 * BookZone - VentaController
 * Maneja las operaciones de venta
 */

require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Libro.php';

class VentaController {

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
     * Formulario para crear una nueva venta (para empleados)
     */
    public function crear(): void {
        $this->requireAuth();
        
        // Solo empleados pueden crear ventas
        if ($_SESSION['usuario_rol'] !== 'empleado' && $_SESSION['usuario_rol'] !== 'admin') {
            header('Location: /bookzone/public/?ruta=dashboard');
            exit;
        }
        
        $libros = Libro::getAll();
        $error = $_SESSION['venta_error'] ?? '';
        $success = $_SESSION['venta_success'] ?? '';
        unset($_SESSION['venta_error'], $_SESSION['venta_success']);
        require_once __DIR__ . '/../views/ventas/crear.php';
    }

    /**
     * Guardar una nueva venta
     */
    public function guardar(): void {
        $this->requireAuth();

        // Solo empleados pueden registrar ventas
        if ($_SESSION['usuario_rol'] !== 'empleado' && $_SESSION['usuario_rol'] !== 'admin') {
            $_SESSION['venta_error'] = 'No tienes permiso para registrar ventas.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        $libro_id = (int)($_POST['libro_id'] ?? 0);
        $comprador_nombre = trim($_POST['comprador_nombre'] ?? '');
        $comprador_telefono = trim($_POST['comprador_telefono'] ?? '');
        $valor_total = $_POST['valor_total'] ?? '';

        // Validaciones
        if ($libro_id <= 0) {
            $_SESSION['venta_error'] = 'Debes seleccionar un libro válido.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        if (empty($comprador_nombre)) {
            $_SESSION['venta_error'] = 'El nombre del comprador es obligatorio.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        if (empty($comprador_telefono)) {
            $_SESSION['venta_error'] = 'El teléfono del comprador es obligatorio.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        if ($valor_total === '' || !is_numeric($valor_total) || $valor_total <= 0) {
            $_SESSION['venta_error'] = 'El valor total debe ser un número mayor a 0.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        // Verificar que el libro existe
        $libro = Libro::getById($libro_id);
        if (!$libro) {
            $_SESSION['venta_error'] = 'El libro seleccionado no existe.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        // Verificar que hay stock
        if ($libro['stock'] <= 0) {
            $_SESSION['venta_error'] = 'No hay stock disponible de este libro.';
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }

        // Crear la venta
        $valor_total = (float)$valor_total;
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $venta_id = Venta::create($libro_id, $comprador_nombre, $comprador_telefono, $valor_total, $usuario_id);

        if ($venta_id) {
            // Descontar el stock del libro
            $nuevo_stock = $libro['stock'] - 1;
            if (Libro::update($libro_id, $libro['titulo'], $libro['autor'], $libro['categoria'], $libro['precio'], $nuevo_stock, $libro['descripcion'])) {
                $_SESSION['venta_success'] = 'Venta registrada correctamente. Stock actualizado.';
            } else {
                $_SESSION['venta_error'] = 'Venta registrada pero hubo error al actualizar el stock.';
            }
        } else {
            $_SESSION['venta_error'] = 'Error al registrar la venta. Intenta de nuevo.';
        }

        header('Location: /bookzone/public/?ruta=ventas/crear');
        exit;
    }

    /**
     * Listar todas las ventas (solo para admin)
     */
    public function index(): void {
        $this->requireAuth();

        // Solo administradores pueden ver el listado completo
        if ($_SESSION['usuario_rol'] !== 'admin') {
            header('Location: /bookzone/public/?ruta=dashboard');
            exit;
        }

        $ventas = Venta::getAll();
        $error = $_SESSION['venta_error'] ?? '';
        $success = $_SESSION['venta_success'] ?? '';
        unset($_SESSION['venta_error'], $_SESSION['venta_success']);
        require_once __DIR__ . '/../views/ventas/index.php';
    }
}
