<?php
/**
 * BookZone - Router principal
 * Despacha todas las rutas de la aplicación
 */

session_start();

require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/LibroController.php';
require_once __DIR__ . '/app/controllers/UsuarioController.php';
require_once __DIR__ . '/app/controllers/VentaController.php';
require_once __DIR__ . '/app/models/Libro.php';

$ruta  = $_GET['ruta']   ?? 'inicio';
$metodo = $_SERVER['REQUEST_METHOD'];

$auth    = new AuthController();
$libros  = new LibroController();
$usuarios = new UsuarioController();
$ventas  = new VentaController();

// -----------------------------------------------
// Tabla de rutas
// -----------------------------------------------
switch ($ruta) {

    // ---- PÁGINAS PÚBLICAS ----
    case 'inicio':
        require_once __DIR__ . '/app/views/inicio.php';
        break;

    case 'catalogo':
        $todosLibros = Libro::getAll();
        $categorias  = Libro::getCategorias();
        require_once __DIR__ . '/app/views/catalogo.php';
        break;

    // ---- AUTENTICACIÓN ----
    case 'login':
        if ($metodo === 'POST') {
            $auth->loginPost();
        } else {
            $auth->loginForm();
        }
        break;

    case 'logout':
        $auth->logout();
        break;

    // ---- DASHBOARD ----
    case 'dashboard':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /bookzone/public/?ruta=login');
            exit;
        }
        $totalLibros  = Libro::count();
        $totalStock   = Libro::totalStock();
        $ultimosLibros = array_slice(Libro::getAll(), 0, 5);
        require_once __DIR__ . '/app/views/dashboard.php';
        break;

    // ---- CRUD LIBROS ----
    case 'libros':
        $libros->index();
        break;

    case 'libros/crear':
        if ($metodo === 'POST') {
            $libros->guardar();
        } else {
            $libros->crear();
        }
        break;

    case 'libros/editar':
        if ($metodo === 'POST') {
            $libros->actualizar();
        } else {
            $libros->editar();
        }
        break;

    case 'libros/eliminar':
        $libros->eliminar();
        break;

    // ---- CRUD USUARIOS ----
    case 'usuarios':
        $usuarios->index();
        break;

    case 'usuarios/crear':
        if ($metodo === 'POST') {
            $usuarios->guardar();
        } else {
            $usuarios->crear();
        }
        break;

    case 'usuarios/editar':
        if ($metodo === 'POST') {
            $usuarios->actualizar();
        } else {
            $usuarios->editar();
        }
        break;

    case 'usuarios/eliminar':
        $usuarios->eliminar();
        break;

    // ---- CRUD VENTAS ----
    case 'ventas':
        $ventas->index();
        break;

    case 'ventas/crear':
        if ($metodo === 'POST') {
            $ventas->guardar();
        } else {
            $ventas->crear();
        }
        break;

    case 'ventas/guardar':
        if ($metodo === 'POST') {
            $ventas->guardar();
        } else {
            header('Location: /bookzone/public/?ruta=ventas/crear');
            exit;
        }
        break;

    // ---- 404 ----
    default:
        http_response_code(404);
        echo '<h1 style="font-family:sans-serif;text-align:center;margin-top:80px;">404 - Página no encontrada</h1>';
        echo '<p style="text-align:center"><a href="/bookzone/public/">Volver al inicio</a></p>';
        break;
}
