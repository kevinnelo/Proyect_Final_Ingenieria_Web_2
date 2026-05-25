# 📚 BookZone — Aplicación Web de Librería

> Proyecto académico desarrollado para la asignatura **Ingeniería Web II**  
> Tecnologías: PHP nativo · MySQL · PDO · HTML5 · CSS3 · JavaScript · MVC

---

## 🖼️ Vista previa

| Página | Descripción |
|--------|-------------|
| `/` | Página de inicio con hero, categorías y características |
| `/catalogo` | Catálogo público de libros |
| `/acerca` | Información de la librería |
| `/login` | Autenticación de usuarios |
| `/dashboard` | Panel privado con estadísticas |
| `/libros` | CRUD completo de libros |
| `/usuarios` | CRUD completo de usuarios (solo admin) |

---

## 📁 Estructura del proyecto

```
bookzone/
├── app/
│   ├── controllers/
│   │   ├── AuthController.php       ← Login / logout
│   │   ├── LibroController.php      ← CRUD libros
│   │   └── UsuarioController.php    ← CRUD usuarios
│   ├── models/
│   │   ├── Libro.php                ← Modelo de libro con PDO
│   │   └── Usuario.php              ← Modelo de usuario con PDO
│   └── views/
│       ├── auth/login.php
│       ├── libros/{index,crear,editar}.php
│       ├── usuarios/{index,crear,editar}.php
│       ├── inicio.php
│       ├── catalogo.php
│       ├── acerca.php
│       ├── dashboard.php
│       ├── layout.php               ← Header y <head> compartido
│       └── layout_footer.php        ← Footer compartido
├── config/
│   └── database.php                 ← Credenciales PDO
├── public/
│   ├── css/style.css                ← CSS propio (sin Bootstrap)
│   ├── js/main.js                   ← JS vanilla
│   └── index.php                    ← Punto de entrada único
├── router.php                       ← Despachador de rutas
├── logout.php
├── setup_password.php               ← ⚠️ Eliminar después de usar
├── database.sql
└── README.md
```

---

## ⚙️ Instalación en XAMPP (paso a paso)

### Requisitos
- XAMPP con **Apache** y **MySQL** activos
- PHP 8.0 o superior
- Navegador moderno

### Pasos

**1. Copiar el proyecto**
```
Copia la carpeta bookzone/ dentro de:
C:\xampp\htdocs\       (Windows)
/opt/lampp/htdocs/     (Linux)
/Applications/XAMPP/htdocs/  (macOS)
```

**2. Crear la base de datos**
- Abre el navegador en: `http://localhost/phpmyadmin`
- Clic en **Nueva** → nombre: `bookzone` → Crear
- Ve a la pestaña **Importar**
- Selecciona el archivo `database.sql` → clic en **Continuar**

**3. Configurar conexión (si es necesario)**  
Edita `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'bookzone');
define('DB_USER', 'root');
define('DB_PASS', '');   // Vacío en XAMPP por defecto
```

**4. Crear usuario administrador**  
Abre en el navegador:
```
http://localhost/bookzone/setup_password.php
```
Verás la confirmación. **Elimina ese archivo** después:
```
Del archivo:  C:\xampp\htdocs\bookzone\setup_password.php
```

**5. Abrir la aplicación**
```
http://localhost/bookzone/public/
```

---

## 🔑 Credenciales de prueba

| Campo | Valor |
|-------|-------|
| Email | `admin@bookzone.com` |
| Contraseña | `admin123` |
| Rol | Administrador |

---

## 🧭 Rutas disponibles

| URL | Acceso | Descripción |
|-----|--------|-------------|
| `?ruta=inicio` | Público | Página de inicio |
| `?ruta=catalogo` | Público | Catálogo de libros |
| `?ruta=acerca` | Público | Información librería |
| `?ruta=login` | Público | Formulario de login |
| `?ruta=logout` | Autenticado | Cerrar sesión |
| `?ruta=dashboard` | Autenticado | Panel principal |
| `?ruta=libros` | Autenticado | Listar libros |
| `?ruta=libros/crear` | Autenticado | Crear libro |
| `?ruta=libros/editar&id=N` | Autenticado | Editar libro |
| `?ruta=libros/eliminar&id=N` | Autenticado | Eliminar libro |
| `?ruta=usuarios` | Solo admin | Listar usuarios |
| `?ruta=usuarios/crear` | Solo admin | Crear usuario |
| `?ruta=usuarios/editar&id=N` | Solo admin | Editar usuario |
| `?ruta=usuarios/eliminar&id=N` | Solo admin | Eliminar usuario |

---

## 🔒 Seguridad implementada

| Medida | Implementación |
|--------|----------------|
| Contraseñas | `password_hash()` (bcrypt) / `password_verify()` |
| Inyección SQL | Consultas preparadas PDO con `?` placeholders |
| XSS | `htmlspecialchars()` en todos los outputs |
| Autenticación | `$_SESSION` con `session_regenerate_id()` |
| Rutas privadas | Verificación de sesión en cada controller |
| Gestión de roles | Solo admin accede al CRUD de usuarios |
| Auto-protección | Un admin no puede eliminarse ni cambiar su propio rol |

---

## 🏗️ Arquitectura MVC

```
Usuario hace request
       ↓
public/index.php (punto de entrada)
       ↓
router.php (despacha según ?ruta=)
       ↓
Controllers/ (lógica de negocio)
       ↓
Models/ (acceso a BD via PDO)
       ↓
Views/ (presentación HTML)
```

---

## 📤 Subir a GitHub

```bash
# Desde la carpeta del proyecto
cd C:\xampp\htdocs\bookzone

git init
git add .
git commit -m "feat: proyecto BookZone completo - Ingeniería Web II"

# Crear repo en github.com, luego:
git remote add origin https://github.com/tu-usuario/bookzone.git
git branch -M main
git push -u origin main
```

> **Tip:** Agrega un `.gitignore` para no subir datos sensibles:
> ```
> config/database.php
> setup_password.php
> ```

---

## 🌐 Despliegue en hosting gratuito

### InfinityFree
1. Crea cuenta en [infinityfree.com](https://infinityfree.com)
2. Crea base de datos MySQL desde el panel → importa `database.sql`
3. Actualiza `config/database.php` con las credenciales del hosting
4. Sube los archivos por FTP (FileZilla) a `/htdocs`
5. Ajusta las rutas en `router.php` y `layout.php` según el dominio

### Render (con PHP buildpack)
- Render no tiene soporte nativo para PHP + MySQL gratuito.
- Alternativa: usa [Railway.app](https://railway.app) o [000webhost](https://000webhost.com).

### Recomendación académica
Para sustentación en clase usa **XAMPP local** — es más estable y rápido para demostrar en vivo.

---

## ✅ Checklist de sustentación

- [ ] Página principal con diseño azul/blanco
- [ ] Vista responsive en celular (DevTools F12)
- [ ] Formulario de login funcionando
- [ ] Dashboard con nombre del usuario
- [ ] CRUD de libros (crear, listar, editar, eliminar)
- [ ] CRUD de usuarios (solo admin)
- [ ] Base de datos visible en phpMyAdmin
- [ ] Código subido a GitHub
- [ ] Reporte Lighthouse (Performance, Accessibility, Best Practices, SEO)

---

## 🎓 Cumplimiento de la guía académica

| Requisito | Cumplido | Cómo |
|-----------|----------|------|
| HTML5 semántico | ✅ | `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`, `<address>` |
| CSS3 externo Flexbox | ✅ | `public/css/style.css` sin Bootstrap |
| Paleta azul/blanco | ✅ | Variables CSS `--primary: #1a56db` |
| Diseño responsivo | ✅ | Media queries 768px, 480px |
| PHP nativo | ✅ | Sin Laravel ni ningún framework |
| MySQL + PDO | ✅ | `config/database.php`, modelos con `prepare()` |
| Arquitectura MVC | ✅ | `controllers/`, `models/`, `views/` |
| Login con sesiones | ✅ | `$_SESSION`, `session_regenerate_id()` |
| `password_hash` / `password_verify` | ✅ | `Usuario.php`, `AuthController.php` |
| Seguridad básica | ✅ | PDO preparado, `htmlspecialchars`, validaciones |
| CRUD completo | ✅ | Libros y Usuarios |
| README explicativo | ✅ | Este archivo |
| Script SQL | ✅ | `database.sql` |

---

*BookZone © 2024 — Proyecto académico Ingeniería Web II*
