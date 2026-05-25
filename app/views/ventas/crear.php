<?php
$pageTitle = 'Registrar Venta';
require_once __DIR__ . '/../layout.php';
?>

<section class="dashboard-section">
    <div class="container">

        <!-- Título -->
        <div class="dashboard-header">
            <div>
                <h1>📝 Registrar Venta</h1>
                <p>Completa el formulario para registrar una venta de libro</p>
            </div>
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

        <!-- Formulario -->
        <div class="form-container">
            <form method="POST" action="/bookzone/public/?ruta=ventas/guardar" class="form-venta">

                <!-- Libro -->
                <div class="form-group">
                    <label for="libro_id">Libro vendido *</label>
                    <select id="libro_id" name="libro_id" required>
                        <option value="">-- Selecciona un libro --</option>
                        <?php foreach ($libros as $libro): ?>
                            <option value="<?= $libro['id'] ?>" data-stock="<?= $libro['stock'] ?>">
                                <?= htmlspecialchars($libro['titulo']) ?> 
                                (Stock: <?= $libro['stock'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small id="stock-info" style="color: #666; margin-top: 5px; display: none;"></small>
                </div>

                <!-- Nombre comprador -->
                <div class="form-group">
                    <label for="comprador_nombre">Nombre del comprador *</label>
                    <input 
                        type="text" 
                        id="comprador_nombre" 
                        name="comprador_nombre" 
                        placeholder="Ej: Juan Pérez"
                        required
                    >
                </div>

                <!-- Teléfono comprador -->
                <div class="form-group">
                    <label for="comprador_telefono">Teléfono del comprador *</label>
                    <input 
                        type="tel" 
                        id="comprador_telefono" 
                        name="comprador_telefono" 
                        placeholder="Ej: 3001234567"
                        required
                    >
                </div>

                <!-- Valor total -->
                <div class="form-group">
                    <label for="valor_total">Valor total de la venta *</label>
                    <input 
                        type="number" 
                        id="valor_total" 
                        name="valor_total" 
                        placeholder="Ej: 35000"
                        step="0.01"
                        min="0.01"
                        required
                    >
                    <small>Valor en pesos colombianos (COP)</small>
                </div>

                <!-- Botones -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Registrar Venta</button>
                    <a href="/bookzone/public/?ruta=dashboard" class="btn btn-outline">Cancelar</a>
                </div>

            </form>
        </div>

    </div>
</section>

<script>
// Mostrar información de stock al seleccionar un libro
document.getElementById('libro_id').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const stockInfo = document.getElementById('stock-info');
    
    if (this.value) {
        const stock = selected.getAttribute('data-stock');
        stockInfo.textContent = `Stock disponible: ${stock} unidad(es)`;
        stockInfo.style.display = 'block';
        
        if (stock <= 0) {
            stockInfo.style.color = '#c81e1e';
            stockInfo.textContent = '❌ No hay stock disponible de este libro';
        } else if (stock <= 5) {
            stockInfo.style.color = '#ff6b00';
            stockInfo.textContent = `⚠️ Stock bajo: ${stock} unidad(es)`;
        }
    } else {
        stockInfo.style.display = 'none';
    }
});
</script>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>
