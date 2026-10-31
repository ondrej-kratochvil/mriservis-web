<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/** Strukturovaná data o firmě (schema.org), na všech stránkách. */
function schema_firma(): array
{
    $p = FIRMA['provozovna'];
    return [
        '@context'  => 'https://schema.org',
        '@type'     => 'LocalBusiness',
        '@id'       => abs_url() . '#firma',
        'name'      => FIRMA['nazev'],
        'alternateName' => FIRMA['kratce'],
        'url'       => abs_url(),
        'logo'      => abs_url('assets/img/mriservis-logo.png'),
        'image'     => abs_url('assets/og/og-mriservis.jpg'),
        'description' => 'Elektroinstalace a automatizace technologických linek: návrh, projekt, instalace, automatizace, servis a revize.',
        'telephone' => FIRMA['telefon'],
        'email'     => FIRMA['email'],
        'foundingDate' => FIRMA['zalozeno'],
        'vatID'     => FIRMA['dic'],
        'taxID'     => FIRMA['ico'],
        'address'   => [
            '@type' => 'PostalAddress',
            'streetAddress' => $p['ulice'],
            'postalCode' => $p['psc'],
            'addressLocality' => $p['mesto'],
            'addressCountry' => 'CZ',
        ],
        'areaServed' => ['CZ', 'SK'],
    ];
}

/**
 * Začátek stránky: <head> se SEO a náhledem pro sociální sítě, hlavička s menu.
 *
 * $p = [
 *   'route' => '' | 'mri-pro/' ...,   'title' => ..., 'description' => ...,
 *   'theme' => 'light' | 'dark',      'og_image' => 'og-mriservis.jpg',
 *   'nav'   => [[href, text, cta?], ...], 'schema' => [extra JSON-LD], 'noindex' => bool,
 *   'preload_image' => cesta v assets/ pro obrázek nad ohybem
 * ]
 */
function page_start(array $p): void
{
    $theme = $p['theme'] ?? 'light';
    $robots = (INDEXOVAT && empty($p['noindex'])) ? 'index, follow' : 'noindex, nofollow';
    $canonical = abs_url($p['route'] ?? '');
    $og = abs_url('assets/og/' . ($p['og_image'] ?? 'og-mriservis.jpg'));
    $schema = array_merge([schema_firma()], $p['schema'] ?? []);
    $logo = $theme === 'dark' ? 'img/mriservis-logo-bile.svg' : 'img/mriservis-logo.svg';
    $navId = 'menu';
    ?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($p['title']) ?></title>
<meta name="description" content="<?= e($p['description']) ?>">
<meta name="robots" content="<?= $robots ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="theme-color" content="<?= $theme === 'dark' ? '#171415' : '#FFFFFF' ?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="cs_CZ">
<meta property="og:site_name" content="<?= e(FIRMA['kratce']) ?>">
<meta property="og:title" content="<?= e($p['og_title'] ?? $p['title']) ?>">
<meta property="og:description" content="<?= e($p['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($og) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= e($p['og_alt'] ?? $p['title']) ?>">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="<?= asset('icons/favicon.svg') ?>" type="image/svg+xml">
<link rel="icon" href="<?= asset('icons/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
<link rel="apple-touch-icon" href="<?= asset('icons/apple-touch-icon.png') ?>">
<link rel="manifest" href="<?= url('site.webmanifest') ?>">
<?php foreach (['outfit-latin', 'outfit-latin-ext', 'figtree-latin', 'figtree-latin-ext'] as $font): ?>
<link rel="preload" href="<?= url("assets/fonts/$font.woff2") ?>" as="font" type="font/woff2" crossorigin>
<?php endforeach; ?>
<?php if (!empty($p['preload_image'])): ?>
<link rel="preload" href="<?= asset($p['preload_image']) ?>" as="image" fetchpriority="high">
<?php endif; ?>
<link rel="stylesheet" href="<?= asset('css/web.css') ?>">
<script type="application/ld+json"><?= json_encode(count($schema) === 1 ? $schema[0] : $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
</head>
<body<?= $theme === 'dark' ? ' class="theme-dark"' : '' ?>>
<a class="skip" href="#obsah">Přeskočit na obsah</a>
<header class="site-header">
<div class="wrap site-header__in">
<a class="site-header__logo" href="<?= url() ?>"><img src="<?= asset($logo) ?>" alt="<?= e(FIRMA['kratce']) ?>, průmyslová automatizace, úvodní stránka" width="87" height="64"></a>
<?php if (!empty($p['nav'])): ?>
<button type="button" class="menu-btn" aria-controls="<?= $navId ?>" aria-expanded="false" aria-label="Otevřít menu"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path class="l1" d="M4 7h16"/><path class="l2" d="M4 12h16"/><path class="l3" d="M4 17h16"/></svg></button>
<nav id="<?= $navId ?>" class="nav" aria-label="Hlavní menu">
<?php foreach ($p['nav'] as $item): ?>
<a href="<?= e($item[0]) ?>"<?= !empty($item[2]) ? ' class="nav__cta"' : '' ?>><?= e($item[1]) ?></a>
<?php endforeach; ?>
</nav>
<?php endif; ?>
</div>
</header>
<main id="obsah">
<?php
}

/** Konec stránky: patička a skript menu. */
function page_end(array $p = []): void
{
    $theme = $p['theme'] ?? 'light';
    ?>
</main>
<footer class="site-footer">
<div class="wrap site-footer__in">
<?php if ($theme === 'dark'): ?>
<a href="<?= url() ?>">← mriservis.cz</a>
<?php else: ?>
<img src="<?= asset('img/mriservis-logo-slogan.svg') ?>" alt="<?= e(FIRMA['kratce']) ?>, průmyslová automatizace" width="85" height="72">
<?php endif; ?>
<span>© <?= e(FIRMA['nazev']) ?></span>
<?php if ($theme !== 'dark'): ?>
<a href="<?= MRIPRO_URL ?>"><img src="<?= asset('img/mripro-ikona.svg') ?>" alt="" width="28" height="28">mripro.cz</a>
<?php endif; ?>
</div>
</footer>
<script src="<?= asset('js/menu.js') ?>" defer></script>
</body>
</html>
<?php
}
