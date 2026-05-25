/**
 * BookZone - main.js
 * Interactividad básica: menú móvil y mostrar/ocultar contraseña
 */

document.addEventListener('DOMContentLoaded', function () {

    // ── 1. Menú hamburguesa ────────────────────────────────────────
    const navToggle = document.getElementById('navToggle');
    const mainNav   = document.getElementById('mainNav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            const isOpen = mainNav.classList.toggle('open');
            navToggle.classList.toggle('open', isOpen);
            navToggle.setAttribute('aria-expanded', isOpen.toString());
        });

        // Cerrar menú al hacer clic en un enlace
        mainNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                mainNav.classList.remove('open');
                navToggle.classList.remove('open');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });

        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function (e) {
            if (!navToggle.contains(e.target) && !mainNav.contains(e.target)) {
                mainNav.classList.remove('open');
                navToggle.classList.remove('open');
                navToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── 2. Mostrar / ocultar contraseña ───────────────────────────
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var targetId = btn.getAttribute('data-target');
            var input    = document.getElementById(targetId);
            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
                btn.setAttribute('aria-label', 'Ocultar contraseña');
            } else {
                input.type = 'password';
                btn.textContent = '👁️';
                btn.setAttribute('aria-label', 'Mostrar contraseña');
            }
        });
    });

    // ── 3. Auto-cerrar alertas después de 5 segundos ──────────────
    document.querySelectorAll('.alert').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity .5s ease';
            alert.style.opacity = '0';
            setTimeout(function () { alert.remove(); }, 500);
        }, 5000);
    });

    // ── 4. Marcar enlace activo del dashboard sidebar (si existe) ──
    var currentPath = window.location.search;
    document.querySelectorAll('.shortcut-card').forEach(function (card) {
        if (card.getAttribute('href') && currentPath.includes(card.getAttribute('href').split('?')[1])) {
            card.style.borderColor = 'var(--primary)';
        }
    });

});
