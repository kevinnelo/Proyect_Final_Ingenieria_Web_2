<?php
$pageTitle = 'Gestión de usuarios';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container">

        <div class="page-heading">
            <div>
                <h1>👥 Usuarios</h1>
                <p>Administración de cuentas del sistema</p>
            </div>
            <a href="/bookzone/public/?ruta=usuarios/crear" class="btn btn-primary">+ Nuevo usuario</a>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">✅ <?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (empty($usuarios)): ?>
            <div class="empty-state"><p>📭 No hay usuarios registrados.</p></div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                    <tr class="<?= $u['id'] == $_SESSION['usuario_id'] ? 'row-highlight' : '' ?>">
                        <td><?= $u['id'] ?></td>
                        <td><?= htmlspecialchars($u['nombre']) ?>
                            <?php if ($u['id'] == $_SESSION['usuario_id']): ?>
                            <span class="badge-you">Tú</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td>
                            <span class="badge-rol <?= $u['rol'] ?>">
                                <?= ucfirst($u['rol']) ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($u['fecha_creacion'])) ?></td>
                        <td class="actions-cell">
                            <a href="/bookzone/public/?ruta=usuarios/editar&id=<?= $u['id'] ?>"
                               class="action-btn edit" title="Editar">✏️</a>
                            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                            <a href="/bookzone/public/?ruta=usuarios/eliminar&id=<?= $u['id'] ?>"
                               class="action-btn delete"
                               title="Eliminar"
                               onclick="return confirm('¿Eliminar al usuario: <?= htmlspecialchars(addslashes($u['nombre'])) ?>?')">🗑️</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="table-count">Total: <?= count($usuarios) ?> usuario(s)</p>
        <?php endif; ?>

        <div class="page-back">
            <a href="/bookzone/public/?ruta=dashboard" class="btn btn-outline">← Volver al dashboard</a>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
