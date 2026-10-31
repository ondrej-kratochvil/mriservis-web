<?php
declare(strict_types=1);
require __DIR__ . '/inc/layout.php';

$kroky = [
    ['faze' => 'Příprava', 'nazev' => 'Návrh', 'text' => 'Posoudíme současný stav a navrhneme napájení, instalaci a automatizaci <strong>včetně cenové kalkulace</strong>.'],
    ['faze' => '', 'nazev' => 'Projekt', 'text' => 'Moderní přístroje a chytrá řešení s ohledem na <strong>spotřebu energie</strong> a lidskou práci.'],
    ['faze' => 'Stavba', 'nazev' => 'Instalace', 'text' => 'Od trafostanic přes kabelové rozvody po řídicí a vizualizační pracoviště. <strong>Bezpečně</strong>, pod dohledem vedoucího montáže.'],
    ['faze' => '', 'nazev' => 'Automatizace', 'text' => 'Řídicí systém a vizualizace, které obsluha pochopí na první pohled. U nových linek <strong>se vzdálenou správou</strong>.', 'dash' => true],
    ['faze' => 'Provoz, opakovaně', 'nazev' => 'Servis', 'text' => 'Záruční i pozáruční, také mobilních technologií. Smluvním zákazníkům <strong>do 24 hodin</strong>.', 'dash' => true, 'provoz' => true],
    ['faze' => '', 'nazev' => 'Revize', 'text' => 'Pravidelná kontrola drží zařízení <strong>dlouhodobě provozuschopné a bezpečné</strong>.', 'provoz' => true],
];

$fakta = [
    ['do 24 hodin', 'servisní zásah u smluvních zákazníků'],
    ['vzdálená správa', 'součást dodávky nových linek'],
    ['vše z jedné ruky', 'návrh, projekt, montáž, revize i servis'],
];

/* Ilustrační ukázka vytížení: podíly v procentech [optimální, naprázdno, přetížení, stojí]. */
$ukazka = [
    'Primér'      => [62, 18, 8, 12],
    'Sekundér'    => [71, 14, 5, 10],
    'Pásová váha' => [80, 12, 0, 8],
    'Podavač'     => [55, 30, 0, 15],
];

$reference = [
    ['img/technologie.webp', 473, 272, 'Kabelové trasy a technologie uvnitř provozu'],
    ['img/rozvadec.webp', 447, 220, 'Rozvaděč s řídicím systémem'],
    ['img/servisni-vozy.webp', 448, 220, 'Servisní vozy MRI Servis v provozu'],
];

page_start([
    'route'       => '',
    'title'       => 'MRI Servis | elektroinstalace a automatizace technologických linek',
    'og_title'    => 'MRI Servis: elektroinstalace a automatizace technologických linek',
    'description' => 'Návrh, projekt, instalace, automatizace, servis a revize technologických linek. Přerov, od roku 2013. Monitoring provozu MRI Pro.',
    'og_image'    => 'og-mriservis.jpg',
    'og_alt'      => 'MRI Servis, elektroinstalace a automatizace technologických linek',
    'preload_image' => 'img/linka-sila.avif',
    'nav' => [
        ['#sluzby', 'Služby'],
        [url('mri-pro/'), 'MRI Pro'],
        ['#reference', 'Reference'],
        ['#firma', 'O firmě'],
        ['#kontakt', 'Kontakt', true],
    ],
]);
?>
<section class="hero" id="top">
<div class="wrap split">
<div class="stack" style="gap:24px">
<p class="eyebrow">Přerov · od roku <?= FIRMA['zalozeno'] ?></p>
<h1 class="h1">Elektroinstalace a automatizace technologických linek</h1>
<p class="lead">Od <strong>trafostanice</strong> přes kabelové rozvody až po <strong>řídicí a vizualizační pracoviště</strong> obsluhy. Navrhneme, nainstalujeme, zautomatizujeme a postaráme se <strong>o servis</strong>.</p>
<div class="btns">
<a class="btn btn--orange" href="#kontakt">Poptat řešení</a>
<a class="btn btn--line" href="<?= url('mri-pro/') ?>">Monitoring MRI Pro</a>
</div>
</div>
<div class="hero__photo">
<?= foto('linka-sila', 'Technologická linka se sily', 425, 272, true) ?>
</div>
</div>
</section>

<section class="facts" aria-label="Proč MRI Servis">
<div class="wrap">
<?php foreach ($fakta as [$nadpis, $text]): ?>
<p><strong><?= e($nadpis) ?></strong><span><?= e($text) ?></span></p>
<?php endforeach; ?>
</div>
</section>

<section class="section" id="sluzby">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Služby</p>
<h2 class="h2">Od prvního návrhu po roky provozu</h2>
<p class="lead">Navazujeme na dlouhou přerovskou tradici dodávek a instalací technologických linek <strong>pro kamenoprůmysl</strong>. Každou zakázku stavíme <strong>na požadavcích provozu</strong>, ne na katalogu.</p>
</div>
<ol class="tl">
<?php foreach ($kroky as $i => $k): ?>
<li<?= !empty($k['dash']) ? ' class="dash"' : '' ?>><span class="ph"><?= e($k['faze']) ?></span><span class="dot<?= !empty($k['provoz']) ? ' dot--o' : '' ?>"><?= $i + 1 ?></span><h3><?= e($k['nazev']) ?></h3><p><?= $k['text'] ?></p></li>
<?php endforeach; ?>
</ol>
</div>
</section>

<section class="section section--sand" id="mripro">
<div class="wrap split">
<div class="stack">
<p class="eyebrow">Vlastní software</p>
<h2><img src="<?= asset('img/mripro-logo.svg') ?>" alt="MRI Pro" width="160" height="120"></h2>
<p class="lead">Informační systém pro sběr, vizualizaci a analýzu dat z drtičů, vah, pásových vah a podavačů. <strong>Bez ohledu na výrobce stroje</strong> nebo komunikační protokol.</p>
<ul class="ticks">
<li><span><strong>Stav všech strojů</strong> na jednom místě, barevně: optimální chod, naprázdno, přetížení</span></li>
<li><span>Upozornění na <strong>výpadek komunikace</strong> nebo zastavení výroby</span></li>
<li><span><strong>Historie</strong> v interaktivních grafech, srovnání strojů na jedné časové ose</span></li>
<li><span><strong>Pravidelné reporty</strong> e-mailem, exporty do PDF, XLSX, ODS a CSV</span></li>
</ul>
<div class="btns">
<a class="btn btn--dark" href="<?= url('mri-pro/') ?>">Více o MRI Pro</a>
<a class="btn btn--line" href="<?= MRIPRO_URL ?>">Přihlásit se</a>
</div>
</div>
<figure class="demo">
<div class="demo__bar"><strong><img src="<?= asset('img/mripro-ikona.svg') ?>" alt="" width="24" height="24">MRI Pro · Provoz</strong><span>dnes, 1. směna</span></div>
<div class="demo__body">
<?php foreach ($ukazka as $stroj => [$ok, $idle, $over, $off]): ?>
<div class="demo__row"><span><?= e($stroj) ?></span><span class="meter" role="img" aria-label="<?= e("$stroj: optimální chod $ok %, naprázdno $idle %, přetížení $over %, stojí $off %") ?>"><i class="c-ok" style="width:<?= $ok ?>%"></i><i class="c-idle" style="width:<?= $idle ?>%"></i><?php if ($over): ?><i class="c-over" style="width:<?= $over ?>%"></i><?php endif; ?><i class="c-off" style="width:<?= $off ?>%"></i></span></div>
<?php endforeach; ?>
<div class="legend"><span><i class="c-ok"></i>optimální chod</span><span><i class="c-idle"></i>naprázdno</span><span><i class="c-over"></i>přetížení</span><span><i class="c-off"></i>stojí / bez dat</span></div>
</div>
<figcaption>Ilustrační ukázka vytížení strojů za směnu.</figcaption>
</figure>
</div>
</section>

<section class="section" id="reference">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Reference</p>
<h2 class="h2">Kde nás najdete v provozu</h2>
</div>
<div class="gallery">
<?php foreach ($reference as [$src, $w, $h, $alt]): ?>
<?= foto(basename($src, '.webp'), $alt, $w, $h) ?>
<?php endforeach; ?>
</div>
<p class="note">Pracujeme pro provozy v Česku i na Slovensku.</p>
</div>
</section>

<section class="section section--dark" id="firma">
<div class="wrap split" style="gap:40px">
<h2 class="h2" style="font-size:40px;line-height:1.1">Automatizaci nevnímáme jako složitou a drahou věc</h2>
<p style="font-size:18px;color:#DDD9D6">Je to prostředek, jak efektivně využít energie, suroviny a technologii. Naším cílem je co nejvyšší kvalita díky moderním technologiím a prvkům automatizace, ale hlavně <strong>spokojený zákazník</strong>.</p>
</div>
</section>

<section class="section" id="kontakt">
<div class="wrap contact">
<div class="stack" style="gap:16px">
<h2 class="h2">Kontakt</h2>
<p style="font-size:18px">Provozovna<br><strong><?= e(adresa(FIRMA['provozovna'])) ?></strong></p>
<p>tel. <a href="<?= tel(FIRMA['telefon']) ?>"><strong><?= e(FIRMA['telefon']) ?></strong></a><br><a href="mailto:<?= FIRMA['email'] ?>"><?= FIRMA['email'] ?></a></p>
<p><strong><?= e(FIRMA['jednatel']['jmeno']) ?></strong>, jednatel<br><a href="<?= tel(FIRMA['jednatel']['telefon']) ?>"><?= e(FIRMA['jednatel']['telefon']) ?></a> · <a href="mailto:<?= FIRMA['jednatel']['email'] ?>"><?= FIRMA['jednatel']['email'] ?></a></p>
<p class="billing"><strong>Fakturační údaje</strong><br><?= e(FIRMA['nazev']) ?><br><?= e(adresa(FIRMA['sidlo'])) ?><br>IČO <?= FIRMA['ico'] ?> · DIČ <?= FIRMA['dic'] ?></p>
</div>
<form class="form" action="<?= FORMULAR_ACTION ?>" method="post" accept-charset="UTF-8">
<p class="form__title">Poptávka</p>
<input type="hidden" name="_subject" value="Poptávka z webu mriservis.cz">
<input type="hidden" name="_template" value="table">
<input type="hidden" name="_next" value="<?= e(abs_url('dekujeme/')) ?>">
<input class="hp" type="text" name="_honey" tabindex="-1" autocomplete="off" aria-hidden="true">
<div class="form__grid">
<label class="wide" for="f-jmeno">Jméno a firma<input id="f-jmeno" name="jmeno" type="text" autocomplete="name" required></label>
<label for="f-email">E-mail<input id="f-email" name="email" type="email" autocomplete="email" required></label>
<label for="f-telefon">Telefon<input id="f-telefon" name="telefon" type="tel" autocomplete="tel"></label>
</div>
<label for="f-zprava">Co potřebujete<textarea id="f-zprava" name="zprava" rows="4" required></textarea></label>
<p class="small">Údaje použijeme jen k vyřízení vaší poptávky.</p>
<button class="btn btn--orange" type="submit">Odeslat poptávku</button>
</form>
</div>
</section>
<?php page_end();
