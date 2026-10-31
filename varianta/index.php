<?php
declare(strict_types=1);
require __DIR__ . '/spolecne.php';

$fakta = [
    ['od ' . FIRMA['zalozeno'], 'na trhu, s přerovskou tradicí linek pro kamenoprůmysl'],
    ['do 24 hodin', 'servisní zásah u smluvních zákazníků'],
    ['vzdálená správa', 'řídicího systému u nových automatizovaných linek'],
    ['Česko i Slovensko', 'provozy, kde pracujeme'],
];

$proc = [
    ['Vše z jedné ruky', 'Návrh, projekt, montáž, automatizace, revize i servis. Jeden partner od první prohlídky po roky provozu.'],
    ['Rychlý servis', 'Smluvním zákazníkům zajišťujeme servis do 24 hodin. U nových linek pomáhá vzdálená správa řídicího systému.'],
    ['Bezpečnost na stavbě', 'Vedoucí montáží hlídají kvalitu provedení i bezpečnost všech, kdo se na stavbě pohybují.'],
    ['Vlastní software', 'S aplikací MRI Pro vidíte chod, prostoje a vytížení strojů. Výpadek se hned nahlásí i našemu technikovi.'],
];

$kroky = [
    ['Příprava', 'Návrh', 'Posoudíme současný stav a navrhneme napájení, instalaci a automatizaci <strong>včetně cenové kalkulace</strong>.'],
    ['', 'Projekt', 'Moderní přístroje a chytrá řešení s ohledem na <strong>spotřebu energie</strong> a lidskou práci.'],
    ['Stavba', 'Instalace', 'Od trafostanic přes kabelové rozvody po pracoviště obsluhy. <strong>Bezpečně</strong>, pod dohledem vedoucího montáže.'],
    ['', 'Automatizace', 'Řídicí systém a vizualizace, které obsluha pochopí na první pohled.'],
    ['Provoz', 'Servis a revize', 'Záruční i pozáruční servis a pravidelné revize. Smluvně <strong>do 24 hodin</strong>.'],
];

/*
 * Reference: zatím prázdné, dokud Marek neurčí, co smíme zveřejnit. Každá položka:
 * ['nazev' => …, 'obor' => …, 'vychozi' => …, 'zadani' => …, 'technologie' => …, 'rozsah' => …, 'vysledek' => …, 'foto' => 'img/…', 'alt' => …]
 */
$realizace = [];

$fotky = [
    ['technologie', 473, 272, 'Kabelové trasy a technologie uvnitř provozu'],
    ['rozvadec', 447, 220, 'Rozvaděč s řídicím systémem'],
    ['servisni-vozy', 448, 220, 'Servisní vozy MRI Servis v provozu'],
];

page_start(v_page([
    'route'       => 'varianta/',
    'title'       => 'MRI Servis | průmyslová automatizace od návrhu po realizaci (varianta B)',
    'description' => 'Navrhujeme, realizujeme a servisujeme elektroinstalace a automatizaci technologických linek. Přerov, od roku 2013.',
    'preload_image' => 'img/linka-sila.avif',
]));
?>
<section class="v2-hero" id="top">
<div class="wrap split">
<div class="stack" style="gap:22px">
<p class="eyebrow">MRI Servis · průmyslová automatizace</p>
<h1 class="h1">Průmyslová automatizace. Od návrhu po realizaci.</h1>
<p class="lead">Navrhujeme, realizujeme a servisujeme <strong>elektroinstalace a automatizaci technologických linek</strong>. Od jednotlivých zařízení po celé technologické celky.</p>
<div class="btns">
<a class="btn btn--orange" href="<?= v_url('sluzby/') ?>">Naše služby</a>
<a class="btn btn--line" href="#realizace">Naše realizace</a>
<a class="btn btn--line" href="#kontakt">Kontaktujte nás</a>
</div>
</div>
<div class="v2-hero__photo"><?= foto('linka-sila', 'Technologická linka se sily', 425, 272, true) ?></div>
</div>
</section>

<section class="v2-facts" aria-label="MRI Servis v číslech">
<div class="wrap">
<?php foreach ($fakta as [$a, $b]): ?>
<p><strong><?= e($a) ?></strong><span><?= e($b) ?></span></p>
<?php endforeach; ?>
</div>
</section>

<section class="section" id="sluzby">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Služby</p>
<h2 class="h2">Co pro vás uděláme</h2>
<p class="lead">Navazujeme na dlouhou přerovskou tradici dodávek a instalací technologických linek, především pro kamenoprůmysl. Každou zakázku stavíme <strong>na požadavcích provozu</strong>, ne na katalogu.</p>
</div>
<div class="v2-services">
<?php foreach (V_OBLASTI as $kotva => [$nazev, $popis, $ikona]): ?>
<a class="v2-service" href="<?= $kotva === 'monitoring' ? url('mri-pro/') : v_url('sluzby/#' . $kotva) ?>">
<?= v_ikona($ikona) ?>
<h3><?= e($nazev) ?></h3>
<p><?= e($popis) ?></p>
<span class="v2-more">Více o službě →</span>
</a>
<?php endforeach; ?>
</div>
</div>
</section>

<section class="section section--sand" id="postup">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Jak spolupracujeme</p>
<h2 class="h2">Od prvního návrhu po roky provozu</h2>
</div>
<ol class="tl" style="--steps:<?= count($kroky) ?>">
<?php foreach ($kroky as $i => [$faze, $nazev, $text]): ?>
<li<?= $i >= 3 ? ' class="dash"' : '' ?>><span class="ph"><?= e($faze) ?></span><span class="dot<?= $i === 4 ? ' dot--o' : '' ?>"><?= $i + 1 ?></span><h3><?= e($nazev) ?></h3><p><?= $text ?></p></li>
<?php endforeach; ?>
</ol>
</div>
</section>

<section class="section" id="realizace">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Reference</p>
<h2 class="h2">Z našich realizací</h2>
</div>
<?php if ($realizace): ?>
<div class="v2-cases">
<?php foreach ($realizace as $r): ?>
<article class="v2-case">
<?= foto(basename($r['foto'], '.webp'), $r['alt'], 640, 420) ?>
<div class="stack" style="gap:10px">
<p class="eyebrow"><?= e($r['obor']) ?></p>
<h3><?= e($r['nazev']) ?></h3>
<dl>
<dt>Výchozí situace</dt><dd><?= e($r['vychozi']) ?></dd>
<dt>Zadání</dt><dd><?= e($r['zadani']) ?></dd>
<dt>Technologie</dt><dd><?= e($r['technologie']) ?></dd>
<dt>Rozsah</dt><dd><?= e($r['rozsah']) ?></dd>
<dt>Výsledek</dt><dd><?= e($r['vysledek']) ?></dd>
</dl>
</div>
</article>
<?php endforeach; ?>
</div>
<?php else: ?>
<div class="gallery">
<?php foreach ($fotky as [$n, $w, $h, $alt]): ?>
<?= foto($n, $alt, $w, $h) ?>
<?php endforeach; ?>
</div>
<p class="note">Pracujeme pro provozy v Česku i na Slovensku. Podrobnosti o konkrétních zakázkách rádi probereme osobně.</p>
<?php endif; ?>
</div>
</section>

<section class="section section--dark" id="o-nas">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Proč MRI Servis</p>
<h2 class="h2">Automatizaci nevnímáme jako složitou a drahou věc</h2>
<p class="lead">Je to prostředek, jak efektivně využít energie, suroviny a technologii. Naším cílem je co nejvyšší kvalita díky moderním technologiím, ale hlavně <strong>spokojený zákazník</strong>.</p>
</div>
<div class="v2-why">
<?php foreach ($proc as [$a, $b]): ?>
<div><h3><?= e($a) ?></h3><p><?= e($b) ?></p></div>
<?php endforeach; ?>
</div>
</div>
</section>

<section class="v2-cta">
<div class="wrap">
<div class="stack" style="gap:8px"><h2 class="h2">Máte projekt, který potřebuje technické řešení?</h2><p>Pojďme společně najít vhodné řešení. Poptávka je nezávazná.</p></div>
<div class="btns"><a class="btn btn--dark" href="#kontakt">Nezávazně poptat projekt</a><a class="btn btn--line" href="<?= tel(FIRMA['telefon']) ?>">Zavolat <?= e(FIRMA['telefon']) ?></a></div>
</div>
</section>

<section class="section" id="kontakt">
<div class="wrap contact">
<div class="stack" style="gap:16px">
<p class="eyebrow">Kontakt</p>
<h2 class="h2">Ozvěte se nám</h2>
<p><strong><?= e(FIRMA['jednatel']['jmeno']) ?></strong>, jednatel<br><a href="<?= tel(FIRMA['jednatel']['telefon']) ?>"><?= e(FIRMA['jednatel']['telefon']) ?></a><br><a href="mailto:<?= FIRMA['jednatel']['email'] ?>"><?= FIRMA['jednatel']['email'] ?></a></p>
<p><strong>Kancelář</strong><br><a href="<?= tel(FIRMA['telefon']) ?>"><?= e(FIRMA['telefon']) ?></a><br><a href="mailto:<?= FIRMA['email'] ?>"><?= FIRMA['email'] ?></a></p>
<p><strong>Provozovna</strong><br><?= e(adresa(FIRMA['provozovna'])) ?></p>
<p class="billing"><strong>Fakturační údaje</strong><br><?= e(FIRMA['nazev']) ?><br><?= e(adresa(FIRMA['sidlo'])) ?><br>IČO <?= FIRMA['ico'] ?> · DIČ <?= FIRMA['dic'] ?></p>
</div>
<?= v_formular() ?>
</div>
</section>
<?php page_end(v_footer());
