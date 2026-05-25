<?php
/**
 * BookZone - logout.php (alternativo)
 * Este archivo es un alias por si alguien accede directo a /logout
 */
session_start();
session_unset();
session_destroy();
header('Location: /bookzone/public/');
exit;
