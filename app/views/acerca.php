<?php
$pageTitle = 'Nosotros';
require_once __DIR__ . '/layout.php';
?>

<section class="page-banner">
    <div class="container">
        <h1>Sobre BookZone</h1>
        <p>Más de 14 años llevando el conocimiento a tus manos</p>
    </div>
</section>

<section class="section-about">
    <div class="container about-grid">
        <div class="about-text">
            <h2>Nuestra historia</h2>
            <p>BookZone nació en 2010 con una sola misión: acercar los libros a cada lector colombiano de manera accesible, cómoda y confiable. Lo que empezó como una pequeña tienda en Bogotá, hoy es una plataforma con miles de clientes en todo el país.</p>
            <p>Creemos que los libros tienen el poder de transformar vidas, ampliar perspectivas y conectar personas a través del tiempo y el espacio. Por eso nos dedicamos a curar catálogos de calidad y ofrecer una experiencia de compra inigualable.</p>
        </div>
        <div class="about-stats">
            <div class="stat-card">
                <span class="stat-num">5.000+</span>
                <span class="stat-label">Títulos disponibles</span>
            </div>
            <div class="stat-card">
                <span class="stat-num">50.000+</span>
                <span class="stat-label">Clientes satisfechos</span>
            </div>
            <div class="stat-card">
                <span class="stat-num">14</span>
                <span class="stat-label">Años de experiencia</span>
            </div>
            <div class="stat-card">
                <span class="stat-num">32</span>
                <span class="stat-label">Ciudades con cobertura</span>
            </div>
        </div>
    </div>
</section>

<section class="section-team">
    <div class="container">
        <h2 class="section-title">Nuestros valores</h2>
        <div class="values-grid">
            <article class="value-card">
                <div class="value-icon">🎯</div>
                <h3>Pasión por la lectura</h3>
                <p>Somos lectores antes que vendedores. Cada recomendación viene de la experiencia y el amor por los libros.</p>
            </article>
            <article class="value-card">
                <div class="value-icon">🤝</div>
                <h3>Confianza</h3>
                <p>Transparencia en precios, calidad garantizada y servicio al cliente honesto y cercano.</p>
            </article>
            <article class="value-card">
                <div class="value-icon">🌱</div>
                <h3>Sostenibilidad</h3>
                <p>Empaque eco-amigable y alianzas con editoriales responsables con el medio ambiente.</p>
            </article>
        </div>
    </div>
</section>

<section class="section-contact">
    <div class="container">
        <h2 class="section-title">Contáctanos</h2>
        <div class="contact-grid">
            <article class="contact-card">
                <div class="contact-icon">📍</div>
                <h3>Dirección</h3>
                <address>Calle 45 # 10-20, Chapinero<br>Bogotá D.C., Colombia</address>
            </article>
            <article class="contact-card">
                <div class="contact-icon">📞</div>
                <h3>Teléfono</h3>
                <p>(601) 234-5678</p>
                <p>WhatsApp: 311 456 7890</p>
            </article>
            <article class="contact-card">
                <div class="contact-icon">🕐</div>
                <h3>Horario</h3>
                <p>Lunes a Viernes: 9am – 7pm</p>
                <p>Sábados: 10am – 5pm</p>
            </article>
            <article class="contact-card">
                <div class="contact-icon">✉️</div>
                <h3>Correo</h3>
                <p>info@bookzone.com</p>
                <p>ventas@bookzone.com</p>
            </article>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layout_footer.php'; ?>
