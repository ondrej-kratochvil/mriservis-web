<?php
declare(strict_types=1);
require __DIR__ . '/inc/layout.php';

$funkce = [
    ['Monitoring v reálném čase', '<strong>Stav všech zařízení</strong> na jednom místě. Barvy rozliší optimální chod, běh naprázdno, přetížení a hodnoty mimo nastavený rozsah.'],
    ['Hlášení výpadků', 'Systém <strong>upozorní na výpadek</strong> komunikace nebo zastavení výroby. Hlášení dostane i <strong>servisní technik MRI Servis</strong>.'],
    ['Historie v grafech', 'Interaktivní grafy s přiblížením. Více strojů a kanálů na jedné časové ose, trendy a úzká místa. Data z grafu <strong>stáhnete do Excelu</strong>.'],
    ['Vytížení po směnách', 'Poměr optimálního provozu, chodu naprázdno a přetížení <strong>po dnech i směnách</strong>. Grafy a statistiky pro vedoucího provozu.'],
    ['Reporty e-mailem', '<strong>Pravidelné shrnutí výroby</strong> do e-mailu. Export surových i agregovaných dat do PDF, XLSX, ODS a CSV.'],
    ['Nastavení podle vás', 'Vlastní hierarchie provozů, uživatelé s různými oprávněními a <strong>limity hodnot a alarmy</strong> pro každé zařízení.'],
];

$ukazky = [
    ['graf-historie', 'Graf historie v MRI Pro s průběhem několika strojů na jedné časové ose', 'Pokročilá analýza historie', 'Interaktivní grafy s přiblížením. <strong>Více strojů a kanálů na jedné časové ose</strong>, trendy a úzká místa ve výrobě. Data z grafu stáhnete do Excelu.'],
    ['vytizeni-smeny', 'Detail kanálu v MRI Pro s agregací vytížení a prstencovým grafem', 'Agregace a přehled vytížení', 'Kolik času stroj stál, běžel naprázdno, optimálně nebo v přetížení. <strong>Hodiny i procenta</strong> po dnech, směnách i za celý měsíc.'],
    ['export', 'Nabídka exportu dat v MRI Pro', 'Exporty jedním kliknutím', 'Formátovaný export do <strong>XLSX, ODS a PDF</strong> pro porady a strojový export do CSV, XLSX, ODS, PDF a JSON pro další systémy.'],
    ['limity-alarmy', 'Nastavení mezních hodnot jednotlivých úrovní zatížení v MRI Pro', 'Vlastní limity a úrovně', 'U každého kanálu nastavíte, kde končí stání, chod naprázdno a jednotlivé úrovně zatížení. <strong>Limity platí od zvoleného data</strong>, takže historie zůstane správně.'],
    ['tydenni-report', 'Týdenní e-mailový report MRI Pro s tabulkou vytížení strojů', 'Týdenní report e-mailem', '<strong>Shrnutí za celý týden</strong> přijde do e-mailu: vytížení, stání a výpadky všech strojů v přehledné tabulce.'],
];

$cesta = [
    ['Čidla', 'Na drtičích, vahách, pásových vahách a podavačích. <strong>Napojíme i stávající zařízení.</strong>'],
    ['Ústředna', 'Sbírá hodnoty a drží je v paměti, dokud je bezpečně neodešle.'],
    ['Komunikace', 'Data jdou přes pevné připojení k internetu nebo mobilní síť. Kde je slabý signál, doplníme venkovní anténu.'],
    ['MRI Pro', 'Ukládá data, počítá vytížení a hlídá výpadky. <strong>Zálohuje se denně.</strong>'],
    ['Prohlížeč', 'Na počítači, tabletu i v mobilu. <strong>Nic se neinstaluje.</strong>'],
];

$pro_koho = [
    ['Pro vedoucího provozu', 'Výroba za den, týden a měsíc. Kde stroje stály a proč. Podklady pro porady bez přepisování.'],
    ['Pro expedici a směnu', 'Okamžitý stav linky. Výpadek nebo přetížení uvidíte dřív, než se projeví na skládce.'],
    ['Pro vedení firmy', 'Srovnání provozů a vytížení strojů na jednom místě. Data k rozhodnutí o investicích.'],
];

$otazky = [
    ['Funguje to se stroji od různých výrobců?', '<strong>Ano.</strong> MRI Pro sjednotí data bez ohledu na výrobce stroje a komunikační protokol.'],
    ['Musíme něco instalovat?', '<strong>U vás ne</strong>, aplikace běží v prohlížeči. Čidla a ústřednu v provozu nainstalují technici MRI Servis.'],
    ['Kdo k datům má přístup?', '<strong>Jen uživatelé, které založíte.</strong> Každý vidí provozy podle svého oprávnění.'],
    ['Co když vypadne signál?', 'Ústředna <strong>drží data v paměti</strong> a odešle je, až se spojení obnoví. Výpadek se zároveň nahlásí.'],
];

$schema_app = [
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => 'MRI Pro',
    'url' => abs_url('mri-pro/'),
    'applicationCategory' => 'BusinessApplication',
    'operatingSystem' => 'Web',
    'description' => 'Sběr, vizualizace a analýza provozních dat z drtičů, vah, pásových vah a podavačů: chod, prostoje a vytížení strojů ve výrobě.',
    'image' => abs_url('assets/og/og-mripro.jpg'),
    'provider' => ['@id' => abs_url() . '#firma'],
    'inLanguage' => 'cs',
];
$schema_faq = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($q) => [
        '@type' => 'Question',
        'name' => $q[0],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($q[1])],
    ], $otazky),
];

page_start([
    'route'       => 'mri-pro/',
    'title'       => 'MRI Pro | monitoring chodu, prostojů a vytížení strojů',
    'og_title'    => 'MRI Pro: chod, prostoje a vytížení strojů ve výrobě',
    'description' => 'Informační systém MRI Pro sbírá a vyhodnocuje data z drtičů, vah, pásových vah a podavačů bez ohledu na výrobce. Stav strojů, výpadky, grafy, reporty.',
    'og_image'    => 'og-mripro.jpg',
    'og_alt'      => 'MRI Pro, informační systém pro vaše technologie',
    'theme'       => 'dark',
    'scripts'     => ['js/lightbox.js'],
    
    'schema'      => [$schema_app, $schema_faq],
    'nav' => [
        ['#funkce', 'Funkce'],
        ['#ukazky', 'Ukázky'],
        ['#jak', 'Jak to funguje'],
        ['#otazky', 'Otázky'],
        [MRIPRO_URL, 'Přihlásit do MRI Pro', true],
    ],
]);
?>
<section class="hero-dark">
<div class="wrap split">
<div class="stack" style="gap:20px">
<div class="app-mark"><img src="<?= asset('img/mripro-logo-bile.svg') ?>" alt="MRI Pro" width="160" height="120"><p class="eyebrow">Informační systém pro vaše technologie</p></div>
<h1 class="h1">Chod, prostoje a vytížení strojů ve výrobě</h1>
<p class="lead">Sběr, vizualizace a analýza provozních dat z drtičů, vah, pásových vah a podavačů. <strong>Bez ohledu na výrobce stroje</strong> nebo komunikační protokol. <strong>Stačí webový prohlížeč.</strong></p>
<div class="btns">
<a class="btn btn--orange" href="#kontakt">Domluvit ukázku</a>
<a class="btn btn--line" href="#ukazky">Prohlédnout aplikaci</a>
</div>
</div>
<figure class="shot-card"><?= snimek('prehled-provozu', 'Přehled provozu MRI Pro s barevným stavem strojů', true) ?></figure>
</div>
</section>

<section class="section" id="funkce">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Funkce</p>
<h2 class="h2">Co v MRI Pro uvidíte</h2>
</div>
<div class="cards">
<?php foreach ($funkce as [$nadpis, $text]): ?>
<article class="feature"><h3><?= e($nadpis) ?></h3><p><?= $text ?></p></article>
<?php endforeach; ?>
</div>
</div>
</section>

<section class="section section--panel" id="ukazky">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Ukázky z aplikace</p>
<h2 class="h2">Prohlédněte si MRI Pro</h2>
</div>
<?php foreach ($ukazky as $i => [$nazev, $alt, $nadpis, $text]): ?>
<div class="showcase">
<?php if ($i % 2 === 1): ?><figure class="shot-card"><?= snimek($nazev, $alt) ?></figure><?php endif; ?>
<div class="stack" style="gap:12px"><span class="showcase__num"><?= sprintf('%02d', $i + 1) ?></span><h3><?= e($nadpis) ?></h3><p><?= $text ?></p></div>
<?php if ($i % 2 === 0): ?><figure class="shot-card"><?= snimek($nazev, $alt) ?></figure><?php endif; ?>
</div>
<?php endforeach; ?>
<div class="showcase">
<figure class="phone"><a class="zoom" href="<?= asset('img/mripro/mobil-390.webp') ?>" aria-label="Přehled provozu MRI Pro v mobilu (zvětšit)"><picture><source type="image/avif" srcset="<?= asset('img/mripro/mobil-390.avif') ?>"><source type="image/webp" srcset="<?= asset('img/mripro/mobil-390.webp') ?>"><img src="<?= asset('img/mripro/mobil.png') ?>" alt="Přehled provozu MRI Pro v mobilu" width="390" height="844" loading="lazy" decoding="async"></picture></a></figure>
<div class="stack" style="gap:12px"><span class="showcase__num"><?= sprintf('%02d', count($ukazky) + 1) ?></span><h3>Přehled i v mobilu</h3><p>Stav strojů a výpadky uvidíte <strong>odkudkoli z telefonu</strong>. Aplikace běží v prohlížeči, nic se neinstaluje.</p></div>
</div>
</div>
</section>

<section class="section" id="jak">
<div class="wrap">
<div class="intro">
<p class="eyebrow">Jak to funguje</p>
<h2 class="h2">Od čidla na stroji k vaší obrazovce</h2>
</div>
<ol class="tl tl--nophase" style="--steps:<?= count($cesta) ?>">
<?php foreach ($cesta as $i => [$nadpis, $text]): ?>
<li><span class="dot"><?= $i + 1 ?></span><h3><?= e($nadpis) ?></h3><p><?= $text ?></p></li>
<?php endforeach; ?>
</ol>
</div>
</section>

<section class="audience" aria-label="Pro koho je MRI Pro">
<div class="wrap">
<?php foreach ($pro_koho as [$nadpis, $text]): ?>
<div class="stack" style="gap:8px"><p class="eyebrow"><?= e($nadpis) ?></p><p><?= e($text) ?></p></div>
<?php endforeach; ?>
</div>
</section>

<section class="section" id="otazky">
<div class="wrap faq">
<h2 class="h2">Časté otázky</h2>
<div>
<?php foreach ($otazky as $i => [$otazka, $odpoved]): ?>
<details<?= $i === 0 ? ' open' : '' ?>><summary><?= e($otazka) ?></summary><p><?= $odpoved ?></p></details>
<?php endforeach; ?>
</div>
</div>
</section>

<section class="cta-band" id="kontakt">
<div class="wrap">
<div class="stack" style="gap:16px"><h2 class="h2">Chcete MRI Pro u sebe?</h2><p>Ukážeme vám aplikaci na datech ze skutečného provozu.</p></div>
<p><strong><?= e(FIRMA['jednatel']['jmeno']) ?></strong>, jednatel<br><a href="<?= tel(FIRMA['jednatel']['telefon']) ?>"><?= e(FIRMA['jednatel']['telefon']) ?></a><br><a href="mailto:<?= FIRMA['jednatel']['email'] ?>"><?= FIRMA['jednatel']['email'] ?></a></p>
<p><strong>Kancelář</strong><br><a href="<?= tel(FIRMA['telefon']) ?>"><?= e(FIRMA['telefon']) ?></a><br><a href="mailto:<?= FIRMA['email'] ?>"><?= FIRMA['email'] ?></a></p>
</div>
</section>
<?php page_end(['theme' => 'dark', 'scripts' => ['js/lightbox.js']]);
