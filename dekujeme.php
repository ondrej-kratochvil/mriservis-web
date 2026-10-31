<?php
declare(strict_types=1);
require __DIR__ . '/inc/layout.php';

page_start([
    'route'       => 'dekujeme/',
    'title'       => 'Děkujeme za poptávku | MRI Servis',
    'description' => 'Poptávka byla odeslána. Ozveme se vám co nejdřív.',
    'noindex'     => true,
    'nav'         => [[url(), 'Úvod'], [url('mri-pro/'), 'MRI Pro'], [url('#kontakt'), 'Kontakt', true]],
]);
?>
<section class="plain">
<div class="wrap">
<div class="stack" style="gap:20px">
<h1 class="h1">Děkujeme za poptávku</h1>
<p class="lead">Ozveme se vám co nejdřív. Když to spěchá, volejte <a href="<?= tel(FIRMA['telefon']) ?>"><strong><?= e(FIRMA['telefon']) ?></strong></a>.</p>
<div class="btns"><a class="btn btn--dark" href="<?= url() ?>">Zpět na web</a></div>
</div>
</div>
</section>
<?php page_end();
