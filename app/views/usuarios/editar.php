<?php
$pageTitle = 'Editar usuario';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container form-container">

        <div class="page-heading">
            <div>
                <h1>✏️ Editar usuario</h1>
                <p>Modifica los datos del usuario seleccionado</p>
            </div>
            <a href="/bookzone/public/?ruta=usuarios" class="btn btn-outline">← Volver</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/bookzone/public/?ruta=usuarios/editar" method="POST" class="data-form">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre completo <span class="required">*</span></label>
                    <input type="text" id="nombre" name="nombre" required maxlength="100"
                           value="<?= htmlspecialchars($usuario['nombre']) ?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required maxlength="150"
                           value="<?= htmlspecialchars($usuario['email']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Nueva contraseña</label>
                    <div class="input-password">
                        <input type="password" id="password" name="password"
                               minlength="6" placeholder="Dejar vacío para no cambiar">
                        <button type="button" class="toggle-password" data-target="password">👁️</button>
                    </div>
                    <small>Solo completa si deseas cambiar la contraseña (mín. 6 caracteres)</small>
                </div>
                <div class="form-group">
                    <label for="rol">Rol <span class="required">*</span></label>
                    <select id="rol" name="rol" required
                            <?= $usuario['id'] == $_SESSION['usuario_id'] ? 'disabled' : '' ?>>
                        <option value="admin"    <?= $usuario['rol'] === 'admin'    ? 'selected' : '' ?>>Administrador</option>
                        <option value="empleado" <?= $usuario['rol'] === 'empleado' ? 'selected' : '' ?>>Empleado</option>
                    </select>
                    <?php if ($usuario['id'] == $_SESSION['usuario_id']): ?>
                        <!-- Campo oculto para que el rol no se pierda al deshabilitar el select -->
                        <input type="hidden" name="rol" value="<?= $usuario['rol'] ?>">
                        <small>⚠️ No puedes cambiar tu propio rol.</small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Actualizar usuario</button>
                <a href="/bookzone/public/?ruta=usuarios" class="btn btn-outline">Cancelar</a>
            </div>
        </form>

    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
