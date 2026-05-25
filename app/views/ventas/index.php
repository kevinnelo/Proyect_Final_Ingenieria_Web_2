<?php
$pageTitle = 'Ventas';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container">

        <!-- Título -->
        <div class="dashboard-header">
            <div>
                <h1>💰 Ventas Registradas</h1>
                <p>Historial completo de ventas realizadas</p>
            </div>
            <a href="/bookzone/public/?ruta=dashboard" class="btn btn-outline">Volver al Dashboard</a>
        </div>

        <!-- Mensajes de error/éxito -->
        <?php if ($error): ?>
            <div class="alert alert-error">
                <span>❌</span> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <span>✅</span> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <!-- Tabla de ventas -->
        <?php if (!empty($ventas)): ?>
            <div class="dashboard-table">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Libro</th>
                                <th>Comprador</th>
                                <th>Teléfono</th>
                                <th>Valor</th>
                                <th>Empleado</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><strong>#<?= $venta['id'] ?></strong></td>
                                <td><?= htmlspecialchars($venta['libro_titulo']) ?></td>
                                <td><?= htmlspecialchars($venta['comprador_nombre']) ?></td>
                                <td><?= htmlspecialchars($venta['comprador_telefono']) ?></td>
                                <td>
                                    <span class="badge badge-primary">
                                        $<?= number_format($venta['valor_total'], 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $venta['usuario_nombre'] ? htmlspecialchars($venta['usuario_nombre']) : '<em>Sin asignar</em>' ?>
                                </td>
                                <td>
                                    <small><?= date('d/m/Y H:i', strtotime($venta['fecha_venta'])) ?></small>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="stats-grid" style="margin-top: 40px;">
                <article class="stat-widget">
                    <div class="stat-widget-icon">📊</div>
                    <div class="stat-widget-info">
                        <span class="stat-widget-num"><?= count($ventas) ?></span>
                        <span class="stat-widget-label">Total de ventas</span>
                    </div>
                </article>
                <article class="stat-widget">
                    <div class="stat-widget-icon">💵</div>
                    <div class="stat-widget-info">
                        <span class="stat-widget-num">$<?= number_format(array_sum(array_column($ventas, 'valor_total')), 0, ',', '.') ?></span>
                        <span class="stat-widget-label">Total recaudado</span>
                    </div>
                </article>
            </div>

        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <h3>No hay ventas registradas</h3>
                <p>Todavía no se han registrado ventas en el sistema.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
