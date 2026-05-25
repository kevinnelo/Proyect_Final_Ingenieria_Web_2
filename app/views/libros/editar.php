<?php
$pageTitle = 'Editar libro';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container form-container">

        <div class="page-heading">
            <div>
                <h1>✏️ Editar libro</h1>
                <p>Modifica los datos del título seleccionado</p>
            </div>
            <a href="/bookzone/public/?ruta=libros" class="btn btn-outline">← Volver</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/bookzone/public/?ruta=libros/editar" method="POST" class="data-form">
            <!-- ID oculto -->
            <input type="hidden" name="id" value="<?= $libro['id'] ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="titulo">Título <span class="required">*</span></label>
                    <input type="text" id="titulo" name="titulo" required maxlength="200"
                           value="<?= htmlspecialchars($libro['titulo']) ?>">
                </div>
                <div class="form-group">
                    <label for="autor">Autor <span class="required">*</span></label>
                    <input type="text" id="autor" name="autor" required maxlength="150"
                           value="<?= htmlspecialchars($libro['autor']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="categoria">Categoría <span class="required">*</span></label>
                    <select id="categoria" name="categoria" required>
                        <option value="">-- Selecciona --</option>
                        <?php
                        $cats = ['Literatura','Fantasía','Ciencia Ficción','Historia','Autoayuda','Misterio','Infantil','Clásicos','Otros'];
                        foreach ($cats as $c):
                        ?>
                        <option value="<?= $c ?>" <?= $libro['categoria'] === $c ? 'selected' : '' ?>><?= $c ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="precio">Precio (COP) <span class="required">*</span></label>
                    <input type="number" id="precio" name="precio" required min="0" step="500"
                           value="<?= htmlspecialchars($libro['precio']) ?>">
                </div>
                <div class="form-group">
                    <label for="stock">Stock <span class="required">*</span></label>
                    <input type="number" id="stock" name="stock" required min="0"
                           value="<?= htmlspecialchars($libro['stock']) ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"><?= htmlspecialchars($libro['descripcion'] ?? '') ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Actualizar libro</button>
                <a href="/bookzone/public/?ruta=libros" class="btn btn-outline">Cancelar</a>
            </div>
        </form>

    </div>
</section>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
