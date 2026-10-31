<?php
declare(strict_types=1);
require __DIR__ . '/inc/config.php';

/** Stránky do mapy webu: adresa => soubor (podle data změny souboru). */
$stranky = ['' => 'index.php', 'mri-pro/' => 'mri-pro.php'];

if (!STATIC_BUILD && !headers_sent()) {
    header('Content-Type: application/xml; charset=utf-8');
}
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($stranky as $route => $soubor) {
    $zmena = date('Y-m-d', (int) filemtime(__DIR__ . '/' . $soubor));
    echo '  <url><loc>' . e(abs_url($route)) . '</loc><lastmod>' . $zmena . '</lastmod></url>' . "\n";
}
echo "</urlset>\n";
