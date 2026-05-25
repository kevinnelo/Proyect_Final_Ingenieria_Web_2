<?php
$pageTitle = 'Crear usuario';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container form-container">

        <div class="page-heading">
            <div>
                <h1>👤 Nuevo usuario</h1>
                <p>Registra una nueva cuenta en el sistema</p>
            </div>
            <a href="/bookzone/public/?ruta=usuarios" class="btn btn-outline">← Volver</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/bookzone/public/?ruta=usuarios/crear" method="POST" class="data-form">

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre completo <span class="required">*</span></label>
                    <input type="text" id="nombre" name="nombre" required maxlength="100"
                           value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"
                           placeholder="Ej: María López">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required maxlength="150"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                           placeholder="correo@ejemplo.com">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Contraseña <span class="required">*</span></label>
                    <div class="input-password">
                        <input type="password" id="password" name="password" required
                               minlength="6" placeholder="Mínimo 6 caracteres">
                        <button type="button" class="toggle-password" data-target="password">👁️</button>
                    </div>
                    <small>Mínimo 6 caracteres</small>
                </div>
                <div class="form-group">
                    <label for="rol">Rol <span class="required">*</span></label>
                    <select id="rol" name="rol" required>
                        <option value="">-- Selecciona --</option>
                        <option value="admin"    <?= ($_POST['rol'] ?? '') === 'admin'    ? 'selected' : '' ?>>Administrador</option>
                        <option value="empleado" <?= ($_POST['rol'] ?? '') === 'empleado' ? 'selected' : '' ?>>Empleado</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Crear usuario</button>
                <a href="/bookzone/public/?ruta=usuarios" class="btn btn-outline">Cancelar</a>
            </div>

        </form>
    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
