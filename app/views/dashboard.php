<?php
$pageTitle = 'Dashboard';
require_once __DIR__ . '/layout.php';
?>

<section class="dashboard-section">
    <div class="container">

        <!-- Bienvenida -->
        <div class="dashboard-header">
            <div>
                <h1>👋 Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></h1>
                <p>Panel de administración · Rol: <strong><?= htmlspecialchars($_SESSION['usuario_rol']) ?></strong></p>
            </div>
            <a href="/bookzone/public/?ruta=logout" class="btn btn-outline-danger">Cerrar sesión</a>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="stats-grid">
            <article class="stat-widget">
                <div class="stat-widget-icon">📚</div>
                <div class="stat-widget-info">
                    <span class="stat-widget-num"><?= $totalLibros ?></span>
                    <span class="stat-widget-label">Libros registrados</span>
                </div>
            </article>
            <article class="stat-widget">
                <div class="stat-widget-icon">📦</div>
                <div class="stat-widget-info">
                    <span class="stat-widget-num"><?= number_format($totalStock) ?></span>
                    <span class="stat-widget-label">Unidades en stock</span>
                </div>
            </article>
            <article class="stat-widget">
                <div class="stat-widget-icon">🗂️</div>
                <div class="stat-widget-info">
                    <span class="stat-widget-num"><?= count(array_unique(array_column($ultimosLibros, 'categoria'))) ?>+</span>
                    <span class="stat-widget-label">Categorías activas</span>
                </div>
            </article>
        </div>

        <!-- Accesos rápidos -->
        <div class="dashboard-shortcuts">
            <h2>Accesos rápidos</h2>
            <div class="shortcuts-grid">
                <a href="/bookzone/public/?ruta=libros" class="shortcut-card">
                    <span>📋</span>
                    <strong>Gestionar libros</strong>
                    <small>Ver, crear, editar y eliminar</small>
                </a>
                <a href="/bookzone/public/?ruta=libros/crear" class="shortcut-card">
                    <span>➕</span>
                    <strong>Agregar libro</strong>
                    <small>Registrar nuevo título</small>
                </a>
                <a href="/bookzone/public/?ruta=ventas/crear" class="shortcut-card">
                    <span>📝</span>
                    <strong>Registrar Venta</strong>
                    <small>Nueva venta de libro</small>
                </a>
                <?php if ($_SESSION['usuario_rol'] === 'admin'): ?>
                <a href="/bookzone/public/?ruta=usuarios" class="shortcut-card">
                    <span>👥</span>
                    <strong>Gestionar usuarios</strong>
                    <small>Administrar accesos</small>
                </a>
                <a href="/bookzone/public/?ruta=usuarios/crear" class="shortcut-card">
                    <span>👤</span>
                    <strong>Nuevo usuario</strong>
                    <small>Crear cuenta de empleado</small>
                </a>
                <a href="/bookzone/public/?ruta=ventas" class="shortcut-card">
                    <span>💰</span>
                    <strong>Ver Ventas</strong>
                    <small>Historial de ventas</small>
                </a>
                <?php endif; ?>
                <a href="/bookzone/public/?ruta=catalogo" class="shortcut-card shortcut-secondary">
                    <span>🌐</span>
                    <strong>Ver catálogo público</strong>
                    <small>Vista del cliente</small>
                </a>
            </div>
        </div>

        <!-- Últimos libros -->
        <?php if (!empty($ultimosLibros)): ?>
        <div class="dashboard-table">
            <h2>Últimos libros registrados</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ultimosLibros as $libro): ?>
                        <tr>
                            <td><?= htmlspecialchars($libro['titulo']) ?></td>
                            <td><?= htmlspecialchars($libro['autor']) ?></td>
                            <td><span class="badge"><?= htmlspecialchars($libro['categoria']) ?></span></td>
                            <td>$<?= number_format($libro['precio'], 0, ',', '.') ?></td>
                            <td>
                                <span class="<?= $libro['stock'] > 0 ? 'stock-ok' : 'stock-empty' ?>">
                                    <?= $libro['stock'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="/bookzone/public/?ruta=libros/editar&id=<?= $libro['id'] ?>" class="action-link edit">✏️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="/bookzone/public/?ruta=libros" class="btn btn-outline mt-1">Ver todos los libros →</a>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/layout_footer.php'; ?>
