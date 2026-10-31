<?php
declare(strict_types=1);

/*
 * Sestavení statické verze webu (pro GitHub Pages nebo jiný hosting bez PHP).
 *
 *   SITE_URL=https://ondrej-kratochvil.github.io/mriservis-web/ php build.php _site
 *
 * Každou PHP stránku spustí a uloží jako HTML s hezkou adresou (mri-pro/index.html).
 * Na hostingu s PHP se build nepoužívá, stránky běží přímo (viz .htaccess).
 */

$out = rtrim($argv[1] ?? '_site', '/');
$root = __DIR__;

$stranky = [
    'index.php'   => 'index.html',
    'mri-pro.php' => 'mri-pro/index.html',
    'dekujeme.php' => 'dekujeme/index.html',
    '404.php'     => '404.html',
    'robots.php'  => 'robots.txt',
    'sitemap.php' => 'sitemap.xml',
    'varianta/index.php' => 'varianta/index.html',
    'varianta/sluzby.php' => 'varianta/sluzby/index.html',
    'varianta/ochrana-osobnich-udaju.php' => 'varianta/ochrana-osobnich-udaju/index.html',
    'varianta-c/index.php' => 'varianta-c/index.html',
];

/** Staré adresy z prvního náhledu přesměrujeme na nové. */
$presmerovani = [
    'mri-pro.html'  => 'mri-pro/',
    'dekujeme.html' => 'dekujeme/',
];

/** Složky a soubory, které se kopírují beze změny. */
$kopirovat = ['assets', 'logo-mri-pro', 'logo-mri-servis', 'site.webmanifest', 'favicon.ico'];

function rm_rf(string $path): void
{
    if (!file_exists($path)) {
        return;
    }
    if (is_dir($path) && !is_link($path)) {
        foreach (scandir($path) as $f) {
            if ($f !== '.' && $f !== '..') {
                rm_rf("$path/$f");
            }
        }
        rmdir($path);
    } else {
        unlink($path);
    }
}

function copy_r(string $from, string $to): void
{
    if (is_dir($from)) {
        @mkdir($to, 0777, true);
        foreach (scandir($from) as $f) {
            if ($f !== '.' && $f !== '..') {
                copy_r("$from/$f", "$to/$f");
            }
        }
    } else {
        @mkdir(dirname($to), 0777, true);
        copy($from, $to);
    }
}

rm_rf($out);
mkdir($out, 0777, true);

$env = ['STATIC_BUILD' => '1', 'SITE_URL' => getenv('SITE_URL') ?: ''];
foreach ($stranky as $src => $dst) {
    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg("$root/$src");
    $proc = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes, $root, array_merge(getenv(), $env));
    $html = stream_get_contents($pipes[1]);
    $err = stream_get_contents($pipes[2]);
    $code = proc_close($proc);
    if ($code !== 0 || $err !== '' || stripos($html, 'Warning:') !== false || stripos($html, 'Notice:') !== false || stripos($html, 'Deprecated:') !== false) {
        fwrite(STDERR, "Chyba při sestavení $src:\n$err\n" . substr($html, 0, 2000) . "\n");
        exit(1);
    }
    @mkdir(dirname("$out/$dst"), 0777, true);
    file_put_contents("$out/$dst", $html);
    echo "  $src -> $dst\n";
}

require_once "$root/inc/config.php";
foreach ($presmerovani as $stara => $nova) {
    $cil = e(url($nova));
    file_put_contents("$out/$stara", "<!DOCTYPE html>\n<html lang=\"cs\"><head><meta charset=\"utf-8\"><title>Přesměrování</title><meta name=\"robots\" content=\"noindex\"><meta http-equiv=\"refresh\" content=\"0; url=$cil\"><link rel=\"canonical\" href=\"" . e(abs_url($nova)) . "\"></head><body><p><a href=\"$cil\">Pokračovat</a></p></body></html>\n");
}

foreach ($kopirovat as $co) {
    copy_r("$root/$co", "$out/$co");
}
touch("$out/.nojekyll");

echo "Hotovo: $out (" . SITE_URL . ")\n";
