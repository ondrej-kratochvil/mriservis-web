<?php
declare(strict_types=1);
require __DIR__ . '/spolecne.php';

/* Obsah oblastí: jen to, co firma uvádí na dosavadním webu mriservis.cz. */
$oblasti = [
    'navrh' => [
        'co' => ['Odborné posouzení současného stavu', 'Návrh napájení, instalace a automatizace', 'Cenová kalkulace', 'Projekt s ohledem na hospodárné využití energie a lidské práce'],
        'kdy' => 'Plánujete modernizaci, rozšíření nebo výstavbu nové technologie a potřebujete podklady pro rozhodnutí.',
        'foto' => ['linka-sila', 425, 272, 'Technologická linka se sily'],
    ],
    'elektro' => [
        'co' => ['Kompletní dodávky a instalace technologických zařízení', 'Napájení od trafostanice', 'Veškeré kabelové rozvody', 'Napojení řídicích a vizualizačních pracovišť obsluhy'],
        'kdy' => 'Stavíte novou linku nebo přestavujete stávající a hledáte jednoho dodavatele elektra od napájení po obsluhu.',
        'foto' => ['technologie', 473, 272, 'Kabelové trasy a technologie uvnitř provozu'],
    ],
    'automatizace' => [
        'co' => ['Řídicí systém technologické linky', 'Vizualizace a pracoviště obsluhy', 'Vzdálená správa řídicího systému u nových linek', 'Úspora energie, surovin a zbytečných zásahů'],
        'kdy' => 'Chcete, aby linka běžela efektivněji, obsluha měla přehled a servis se dal řešit i na dálku.',
        'foto' => ['rozvadec', 447, 220, 'Rozvaděč s řídicím systémem'],
    ],
    'servis' => [
        'co' => ['Záruční i pozáruční servis', 'Servis do 24 hodin pro smluvní zákazníky', 'Servis a údržba mobilních technologií', 'Pravidelné revize zařízení'],
        'kdy' => 'Potřebujete, aby provoz běžel bez dlouhých výpadků a zařízení bylo bezpečné a v souladu s předpisy.',
        'foto' => ['servisni-vozy', 448, 220, 'Servisní vozy MRI Servis v provozu'],
    ],
];

page_start(v_page([
    'route'       => 'varianta/sluzby/',
    'title'       => 'Služby | MRI Servis (varianta B)',
    'description' => 'Návrh a projekt, elektroinstalace, automatizace a řídicí systémy, servis a revize technologických linek. MRI Servis, Přerov.',
]));
?>
<section class="v2-hero v2-hero--small">
<div class="wrap">
<div class="stack" style="gap:16px;max-width:760px">
<p class="eyebrow">Služby</p>
<h1 class="h1">Elektroinstalace a automatizace technologických linek</h1>
<p class="lead">Od prvního posouzení po roky provozu. Vyberte oblast, nebo nám rovnou popište, co potřebujete.</p>
<nav class="v2-chips" aria-label="Oblasti služeb">
<?php foreach (V_OBLASTI as $kotva => [$nazev]): ?>
<a href="<?= $kotva === 'monitoring' ? url('mri-pro/') : '#' . $kotva ?>"><?= e($nazev) ?></a>
<?php endforeach; ?>
</nav>
</div>
</div>
</section>

<?php $i = 0; foreach ($oblasti as $kotva => $o): [$nazev, $popis, $ikona] = V_OBLASTI[$kotva]; ?>
<section class="section<?= $i++ % 2 ? ' section--sand' : '' ?>" id="<?= $kotva ?>">
<div class="wrap split">
<div class="stack">
<p class="eyebrow"><?= v_ikona($ikona) ?><?= e($nazev) ?></p>
<h2 class="h2"><?= e($popis) ?></h2>
<h3 class="v2-sub">Co zahrnuje</h3>
<ul class="ticks">
<?php foreach ($o['co'] as $polozka): ?><li><span><?= e($polozka) ?></span></li><?php endforeach; ?>
</ul>
<h3 class="v2-sub">Kdy se vám hodí</h3>
<p><?= e($o['kdy']) ?></p>
<div class="btns"><a class="btn btn--orange" href="<?= v_url('?predmet=' . rawurlencode($nazev) . '#kontakt') ?>">Poptat <?= e(mb_strtolower($nazev)) ?></a></div>
</div>
<div class="v2-photo"><?php [$fn, $fw, $fh, $falt] = $o['foto']; ?><?= foto($fn, $falt, $fw, $fh) ?></div>
</div>
</section>
<?php endforeach; ?>

<section class="v2-cta">
<div class="wrap">
<div class="stack" style="gap:8px"><h2 class="h2">Monitoring provozu MRI Pro</h2><p>Vlastní software pro sběr a vyhodnocení dat z drtičů, vah, pásových vah a podavačů.</p></div>
<div class="btns"><a class="btn btn--dark" href="<?= url('mri-pro/') ?>">Více o MRI Pro</a><a class="btn btn--line" href="<?= v_url('#kontakt') ?>">Poptat řešení</a></div>
</div>
</section>
<?php page_end(v_footer());
