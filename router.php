<?php
// Jen pro vývoj: php -S localhost:8000 router.php (napodobuje .htaccess z hostingu).
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$mapa = ['/' => 'index.php', '/mri-pro/' => 'mri-pro.php', '/mri-pro' => 'mri-pro.php', '/dekujeme/' => 'dekujeme.php', '/robots.txt' => 'robots.php', '/sitemap.xml' => 'sitemap.php'];
if (isset($mapa[$path])) {
    require __DIR__ . '/' . $mapa[$path];
    return true;
}
if (is_file(__DIR__ . $path) && !preg_match('#^/(inc|\.github)/|\.php$#', $path)) {
    return false;
}
require __DIR__ . '/404.php';
return true;
