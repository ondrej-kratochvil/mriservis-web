<?php
declare(strict_types=1);
require __DIR__ . '/inc/config.php';

if (!STATIC_BUILD && !headers_sent()) {
    header('Content-Type: text/plain; charset=utf-8');
}
if (INDEXOVAT) {
    echo "User-agent: *\nAllow: /\n\nSitemap: " . abs_url('sitemap.xml') . "\n";
} else {
    echo "User-agent: *\nDisallow: /\n";
}
