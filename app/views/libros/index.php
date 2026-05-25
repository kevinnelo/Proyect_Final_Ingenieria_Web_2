<?php
$pageTitle = 'Gestión de libros';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container">

        <div class="page-heading">
            <div>
                <h1>📚 Libros</h1>
                <p>Gestión completa del inventario de libros</p>
            </div>
            <a href="/bookzone/public/?ruta=libros/crear" class="btn btn-primary">+ Nuevo libro</a>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">✅ <?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (empty($libros)): ?>
            <div class="empty-state">
                <p>📭 No hay libros registrados. <a href="/bookzone/public/?ruta=libros/crear">Crea el primero</a>.</p>
            </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= $libro['id'] ?></td>
                        <td><?= htmlspecialchars($libro['titulo']) ?></td>
                        <td><?= htmlspecialchars($libro['autor']) ?></td>
                        <td><span class="badge"><?= htmlspecialchars($libro['categoria']) ?></span></td>
                        <td>$<?= number_format($libro['precio'], 0, ',', '.') ?></td>
                        <td>
                            <span class="<?= $libro['stock'] > 0 ? 'stock-ok' : 'stock-empty' ?>">
                                <?= $libro['stock'] ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($libro['fecha_creacion'])) ?></td>
                        <td class="actions-cell">
                            <a href="/bookzone/public/?ruta=libros/editar&id=<?= $libro['id'] ?>"
                               class="action-btn edit" title="Editar">✏️</a>
                            <a href="/bookzone/public/?ruta=libros/eliminar&id=<?= $libro['id'] ?>"
                               class="action-btn delete"
                               title="Eliminar"
                               onclick="return confirm('¿Eliminar el libro: <?= htmlspecialchars(addslashes($libro['titulo'])) ?>?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="table-count">Total: <?= count($libros) ?> libro(s)</p>
        <?php endif; ?>

        <div class="page-back">
            <a href="/bookzone/public/?ruta=dashboard" class="btn btn-outline">← Volver al dashboard</a>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
