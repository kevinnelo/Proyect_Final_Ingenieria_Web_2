<?php
$pageTitle = 'Iniciar sesión';
require_once __DIR__ . '/../layout.php';
?>

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-header">
            <span class="auth-logo">📚</span>
            <h1>Bienvenido a BookZone</h1>
            <p>Ingresa tus credenciales para acceder al panel</p>
        </div>

        <?php if (!empty($error)): ?>
        <div class="alert alert-error" role="alert">
            ⚠️ <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form action="/bookzone/public/?ruta=login" method="POST" class="auth-form" novalidate>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="admin@bookzone.com"
                    required
                    autocomplete="email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                >
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-password">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="toggle-password" aria-label="Mostrar contraseña" data-target="password">👁️</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </form>

        <p class="auth-hint">
            <small>Usuario demo: <strong>admin@bookzone.com</strong> / Contraseña: <strong>admin123</strong></small>
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
