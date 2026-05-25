<?php
$pageTitle = 'Inicio';
require_once __DIR__ . '/layout.php';
?>

<!-- ========== HERO ========== -->
<section class="hero">
    <div class="container hero-inner">
        <div class="hero-text">
            <h1>Descubre tu próxima<br><span>gran lectura</span></h1>
            <p>Más de 5.000 títulos disponibles. Literatura, ciencia, fantasía, historia y mucho más.</p>
            <a href="/bookzone/public/?ruta=catalogo" class="btn btn-primary">Ver catálogo</a>
        </div>
        <div class="hero-image" aria-hidden="true">
            <div class="book-stack">
                <div class="book book-1">📖</div>
                <div class="book book-2">📗</div>
                <div class="book book-3">📘</div>
            </div>
        </div>
    </div>
</section>

<!-- ========== CATEGORÍAS DESTACADAS ========== -->
<section class="section-categories">
    <div class="container">
        <h2 class="section-title">Categorías populares</h2>
        <div class="categories-grid">
            <?php
            $cats = [
                ['emoji'=>'📜','nombre'=>'Literatura',    'color'=>'#1a56db'],
                ['emoji'=>'🧙','nombre'=>'Fantasía',      'color'=>'#5521b5'],
                ['emoji'=>'🔬','nombre'=>'Ciencia',       'color'=>'#0694a2'],
                ['emoji'=>'📰','nombre'=>'Historia',      'color'=>'#c27803'],
                ['emoji'=>'💡','nombre'=>'Autoayuda',     'color'=>'#057a55'],
                ['emoji'=>'🔍','nombre'=>'Misterio',      'color'=>'#c81e1e'],
            ];
            foreach ($cats as $cat): ?>
            <article class="category-card">
                <a href="/bookzone/public/?ruta=catalogo">
                    <span class="cat-emoji"><?= $cat['emoji'] ?></span>
                    <span class="cat-nombre"><?= $cat['nombre'] ?></span>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== CARACTERÍSTICAS ========== -->
<section class="section-features">
    <div class="container">
        <h2 class="section-title">¿Por qué BookZone?</h2>
        <div class="features-grid">
            <article class="feature-card">
                <div class="feature-icon">🚚</div>
                <h3>Envío rápido</h3>
                <p>Recibe tus libros en 24-48 horas a todo el país sin costo adicional en compras mayores a $50.000.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">📦</div>
                <h3>Gran inventario</h3>
                <p>Más de 5.000 títulos disponibles en físico y digital. Siempre encontrarás lo que buscas.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">💳</div>
                <h3>Pago seguro</h3>
                <p>Aceptamos todas las tarjetas, PSE y efectivo. Transacciones 100% seguras y encriptadas.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">⭐</div>
                <h3>Calidad garantizada</h3>
                <p>Todos nuestros libros son originales y de primera calidad. Garantía de devolución en 15 días.</p>
            </article>
        </div>
    </div>
</section>

<!-- ========== CTA ========== -->
<section class="section-cta">
    <div class="container cta-inner">
        <h2>¿Listo para explorar?</h2>
        <p>Navega nuestro catálogo completo y encuentra tu próxima aventura literaria.</p>
        <a href="/bookzone/public/?ruta=catalogo" class="btn btn-white">Ver todos los libros</a>
    </div>
</section>

<?php require_once __DIR__ . '/layout_footer.php'; ?>
