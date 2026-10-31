<?php
declare(strict_types=1);
require __DIR__ . '/inc/layout.php';

if (!STATIC_BUILD && !headers_sent()) {
    http_response_code(404);
}
page_start([
    'route'       => '404',
    'title'       => 'Stránka nenalezena | MRI Servis',
    'description' => 'Stránka na této adrese neexistuje.',
    'noindex'     => true,
    'nav'         => [[url(), 'Úvod'], [url('mri-pro/'), 'MRI Pro'], [url('#kontakt'), 'Kontakt', true]],
]);
?>
<section class="plain">
<div class="wrap">
<div class="stack" style="gap:20px">
<p class="eyebrow">Chyba 404</p>
<h1 class="h1">Tahle stránka tu není</h1>
<p class="lead">Možná se změnila adresa. Pokračujte na úvodní stránku, nebo nám zavolejte na <a href="<?= tel(FIRMA['telefon']) ?>"><strong><?= e(FIRMA['telefon']) ?></strong></a>.</p>
<div class="btns"><a class="btn btn--dark" href="<?= url() ?>">Na úvodní stránku</a><a class="btn btn--line" href="<?= url('mri-pro/') ?>">MRI Pro</a></div>
</div>
</div>
</section>
<?php page_end();
