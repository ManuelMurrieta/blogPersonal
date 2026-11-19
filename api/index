<?php
// Punto de entrada principal para Vercel (api/index.php)
$baseDir = dirname(__DIR__);

// Cargar datos
$ensayos = json_decode(file_get_contents($baseDir . '/datos/ensayos.json'), true) ?? [];
$notas = json_decode(file_get_contents($baseDir . '/datos/diario.json'), true) ?? [];

// Determinar la sección solicitada (lista blanca por seguridad)
$seccion = $_GET['seccion'] ?? 'inicio';
$seccionesPermitidas = ['inicio', 'ensayo', 'notas', 'sobre-mi'];

if (!in_array($seccion, $seccionesPermitidas, true)) {
    $seccion = 'inicio';
}

$pageTitle = 'Entreacto — Blog personal';
if ($seccion === 'notas') {
    $pageTitle = 'Apuntes de camerino — Entreacto';
} elseif ($seccion === 'sobre-mi') {
    $pageTitle = 'Sobre mí — Entreacto';
} elseif ($seccion === 'ensayo') {
    $slug = $_GET['slug'] ?? '';
    foreach ($ensayos as $item) {
        if ($item['slug'] === $slug) {
            $pageTitle = $item['title'] . ' — Entreacto';
            break;
        }
    }
}

require $baseDir . '/secciones/header.php';
require $baseDir . '/secciones/' . $seccion . '.php';
require $baseDir . '/secciones/footer.php';
