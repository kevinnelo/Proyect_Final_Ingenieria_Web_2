<?php
$pageTitle = 'Catálogo';
require_once __DIR__ . '/layout.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Catálogo de libros</h1>
        <p>Explora nuestra colección completa de títulos</p>
    </div>
</section>

<section class="section-catalog">
    <div class="container">

        <!-- Filtro por categoría -->
        <?php if (!empty($categorias)): ?>
        <div class="catalog-filters">
            <a href="/bookzone/public/?ruta=catalogo" class="filter-btn <?= empty($_GET['cat']) ? 'active' : '' ?>">Todos</a>
            <?php foreach ($categorias as $cat): ?>
            <a href="/bookzone/public/?ruta=catalogo&cat=<?= urlencode($cat) ?>"
               class="filter-btn <?= ($_GET['cat'] ?? '') === $cat ? 'active' : '' ?>">
                <?= htmlspecialchars($cat) ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Filtrar por categoría si se pasa parámetro -->
        <?php
        if (!empty($_GET['cat'])) {
            $catFiltro = htmlspecialchars($_GET['cat']);
            $todosLibros = array_filter($todosLibros, fn($l) => $l['categoria'] === $_GET['cat']);
        }
        ?>

        <!-- Grid de libros -->
        <?php if (empty($todosLibros)): ?>
            <div class="empty-state">
                <p>📭 No hay libros disponibles en este momento.</p>
            </div>
        <?php else: ?>
        <div class="books-grid">
            <?php foreach ($todosLibros as $libro): ?>
            <article class="book-card">
                <div class="book-cover">
                    <span><?= mb_substr(htmlspecialchars($libro['titulo']), 0, 2) ?></span>
                </div>
                <div class="book-info">
                    <span class="book-categoria"><?= htmlspecialchars($libro['categoria']) ?></span>
                    <h3 class="book-titulo"><?= htmlspecialchars($libro['titulo']) ?></h3>
                    <p class="book-autor">✍️ <?= htmlspecialchars($libro['autor']) ?></p>
                    <p class="book-desc"><?= htmlspecialchars(mb_substr($libro['descripcion'] ?? '', 0, 100)) ?>...</p>
                    <div class="book-footer">
                        <span class="book-precio">$<?= number_format($libro['precio'], 0, ',', '.') ?></span>
                        <span class="book-stock <?= $libro['stock'] > 0 ? 'en-stock' : 'sin-stock' ?>">
                            <?= $libro['stock'] > 0 ? "Stock: {$libro['stock']}" : 'Agotado' ?>
                        </span>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/layout_footer.php'; ?>
