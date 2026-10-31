<?php
declare(strict_types=1);

/*
 * Nastavení webu. Údaje o firmě jsou jen tady, stránky je berou odsud.
 *
 * SITE_URL: adresa webu s lomítkem na konci. Při sestavení pro GitHub Pages ji nastaví
 * proměnná prostředí SITE_URL, na produkčním hostingu platí výchozí hodnota.
 * SPUSTENO: dokud je false, stránky mají noindex. Po spuštění na mriservis.cz přepnout na true.
 */
const SPUSTENO = false;
const PRODUKCNI_URL = 'https://www.mriservis.cz/';

define('SITE_URL', rtrim(getenv('SITE_URL') ?: PRODUKCNI_URL, '/') . '/');
define('BASE_PATH', rtrim((string) (parse_url(SITE_URL, PHP_URL_PATH) ?: '/'), '/') . '/');
define('INDEXOVAT', SPUSTENO && str_ends_with((string) parse_url(SITE_URL, PHP_URL_HOST), 'mriservis.cz'));
define('STATIC_BUILD', getenv('STATIC_BUILD') === '1');
define('ROOT', dirname(__DIR__));

const FIRMA = [
    'nazev'      => 'MRI Servis - průmyslová automatizace s.r.o.',
    'kratce'     => 'MRI Servis',
    'ico'        => '01989286',
    'dic'        => 'CZ01989286',
    'zalozeno'   => '2013',
    'sidlo'      => ['ulice' => 'Nová čtvrť 282/7c', 'psc' => '750 02', 'mesto' => 'Přerov'],
    'provozovna' => ['ulice' => 'Tovačovská 3457/4a', 'psc' => '750 02', 'mesto' => 'Přerov'],
    'telefon'    => '+420 581 737 934',
    'email'      => 'info@mriservis.cz',
    'jednatel'   => ['jmeno' => 'Marek Drgáč', 'telefon' => '+420 603 146 529', 'email' => 'drgac@mriservis.cz'],
];

const MRIPRO_URL = 'https://mripro.cz';

/** Formulář poptávky: FormSubmit přepošle poptávku na e-mail firmy. */
const FORMULAR_ACTION = 'https://formsubmit.co/info@mriservis.cz';

/** Bezpečný výpis textu do HTML. */
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Odkaz na stránku webu. $route je '' (úvod), 'mri-pro/', 'dekujeme/'...
 * Při sestavení i na hostingu s .htaccess vede na hezkou adresu.
 */
function url(string $route = ''): string
{
    return BASE_PATH . ltrim($route, '/');
}

/** Absolutní adresa (kanonická adresa, sociální sítě, mapa webu). */
function abs_url(string $route = ''): string
{
    return SITE_URL . ltrim($route, '/');
}

/** Soubor z assets/ s otiskem obsahu, aby si prohlížeč po změně stáhl novou verzi. */
function asset(string $path): string
{
    $file = ROOT . '/assets/' . $path;
    $v = is_file($file) ? substr(md5_file($file), 0, 8) : '0';
    return url('assets/' . $path) . '?v=' . $v;
}

/** Telefon pro odkaz tel: (bez mezer). */
function tel(string $cislo): string
{
    return 'tel:' . str_replace(' ', '', $cislo);
}

/** Adresa na jeden řádek. */
function adresa(array $a): string
{
    return $a['ulice'] . ', ' . $a['psc'] . ' ' . $a['mesto'];
}
