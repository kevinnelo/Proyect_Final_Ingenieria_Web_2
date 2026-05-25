<?php
/**
 * BookZone - Punto de entrada público
 * Todos los requests pasan por aquí
 */

// Calcular la raíz del proyecto (un nivel arriba de /public/)
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL',  '/bookzone/public');

// Delegar al router principal
require_once BASE_PATH . '/router.php';
