<?php
/**
 * BookZone - Layout principal
 * Incluye <head>, header/nav y footer
 * Variables esperadas: $pageTitle (string)
 */
$pageTitle = $pageTitle ?? 'BookZone';
$ruta      = $_GET['ruta'] ?? 'inicio';
$isLoggedIn = isset($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BookZone - Tu librería de confianza con los mejores títulos">
    <title><?= htmlspecialchars($pageTitle) ?> | BookZone</title>
    <link rel="stylesheet" href="/bookzone/public/css/style.css">
    <!-- Favicon SVG inline -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📚</text></svg>">
</head>
<body>

<!-- ===================== HEADER ===================== -->
<header class="site-header">
    <div class="container header-inner">
        <a href="/bookzone/public/" class="logo">
            <span class="logo-icon">📚</span>
            <span class="logo-text">BookZone</span>
        </a>
        <!-- Botón hamburguesa para móvil -->
        <button class="nav-toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
        <nav class="main-nav" id="mainNav" aria-label="Navegación principal">
            <ul>
                <li><a href="/bookzone/public/?ruta=inicio"   class="<?= $ruta === 'inicio'   ? 'active' : '' ?>">Inicio</a></li>
                <li><a href="/bookzone/public/?ruta=catalogo" class="<?= $ruta === 'catalogo' ? 'active' : '' ?>">Catálogo</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="/bookzone/public/?ruta=dashboard" class="<?= str_starts_with($ruta, 'dashboard') ? 'active' : '' ?>">Dashboard</a></li>
                    <li><a href="/bookzone/public/?ruta=logout" class="btn-nav">Salir</a></li>
                <?php else: ?>
                    <li><a href="/bookzone/public/?ruta=login" class="btn-nav <?= $ruta === 'login' ? 'active' : '' ?>">Ingresar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<!-- ===================== MAIN ===================== -->
<main id="main-content">
<?php
// El contenido de la página se incluye después de este archivo
// El cierre de </main>, <footer> y </body> está en layout_footer.php
