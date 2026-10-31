<?php
declare(strict_types=1);

/*
 * Varianta B webu podle revize (ChatGPT, 31. 10. 2026): víc obchodní prezentace,
 * služby po oblastech, výraznější cesta k poptávce, stránka o ochraně osobních údajů.
 * Sdílí inc/config.php a inc/layout.php se současným webem, liší se obsahem a barvami
 * (assets/css/varianta.css). Vždy noindex, je to jen návrh k porovnání.
 */
require_once __DIR__ . '/../inc/layout.php';

/** Oblasti služeb: kotva => [název, krátký popis, ikona]. Obsah jen ze starého webu mriservis.cz a mripro.cz. */
const V_OBLASTI = [
    'navrh'       => ['Návrh a projekt', 'Posouzení stavu, návrh řešení a cenová kalkulace.', 'navrh'],
    'elektro'     => ['Elektroinstalace', 'Od trafostanice přes kabelové rozvody po pracoviště obsluhy.', 'elektro'],
    'automatizace' => ['Automatizace a řídicí systémy', 'Řídicí a vizualizační pracoviště, vzdálená správa.', 'automatizace'],
    'servis'      => ['Servis a revize', 'Záruční i pozáruční servis, smluvně do 24 hodin.', 'servis'],
    'monitoring'  => ['Monitoring MRI Pro', 'Vlastní software pro sledování chodu a vytížení strojů.', 'monitoring'],
];

/** Předměty poptávky pro formulář. */
const V_PREDMETY = ['Návrh a projekt', 'Elektroinstalace', 'Automatizace a řídicí systémy', 'Servis a revize', 'Monitoring MRI Pro', 'Jiné'];

function v_url(string $route = ''): string
{
    return url('varianta/' . ltrim($route, '/'));
}

/** Jednoduché čárové ikony (inline SVG, bez knihovny). */
function v_ikona(string $nazev): string
{
    $cesty = [
        'navrh'        => '<path d="M4 20h16"/><path d="M6 16l9-9 3 3-9 9H6z"/><path d="M13 9l3 3"/>',
        'elektro'      => '<path d="M13 2L5 14h6l-1 8 8-12h-6z"/>',
        'automatizace' => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M12 16v4"/><path d="M7 12l3-3 2 2 4-4"/>',
        'servis'       => '<path d="M14.5 6.5a4 4 0 0 0-5 5L4 17l3 3 5.5-5.5a4 4 0 0 0 5-5l-2.5 2.5-2.5-.5-.5-2.5z"/>',
        'monitoring'   => '<path d="M3 12h4l2-5 4 10 2-5h6"/>',
    ];
    return '<svg class="ikona" viewBox="0 0 24 24" width="28" height="28" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . ($cesty[$nazev] ?? '') . '</svg>';
}

/** Společné nastavení stránek varianty (menu, pruh nahoře, patička). */
function v_page(array $p): array
{
    $sluzby = [];
    foreach (V_OBLASTI as $kotva => [$nazev]) {
        $sluzby[] = [$kotva === 'monitoring' ? url('mri-pro/') : v_url('sluzby/#' . $kotva), $nazev];
    }
    return $p + [
        'noindex'    => true,
        'css'        => ['varianta.css'],
        'body_class' => 'v2',
        'home'       => v_url(),
        'banner'     => '<div class="v2-banner">Varianta B webu (návrh podle revize). <a href="' . url() . '">Zobrazit současnou verzi</a></div>',
        'nav'        => [
            [v_url(), 'Úvod'],
            [v_url('sluzby/'), 'Služby', false, $sluzby],
            [v_url('#realizace'), 'Reference'],
            [v_url('#o-nas'), 'O nás'],
            [v_url('#kontakt'), 'Kontakt'],
            [v_url('#kontakt'), 'Poptat řešení', true],
        ],
    ];
}

function v_footer(): array
{
    return [
        'footer_extra' => '<span class="v2-foot"><a href="' . tel(FIRMA['telefon']) . '">' . e(FIRMA['telefon']) . '</a> · <a href="mailto:' . FIRMA['email'] . '">' . FIRMA['email'] . '</a> · <a href="' . v_url('ochrana-osobnich-udaju/') . '">Ochrana osobních údajů</a></span>',
        'scripts' => ['js/predmet.js'],
    ];
}

/** Poptávkový formulář (FormSubmit na info@mriservis.cz). */
function v_formular(): string
{
    ob_start(); ?>
<form class="form" action="<?= FORMULAR_ACTION ?>" method="post" accept-charset="UTF-8">
<p class="form__title">Nezávazná poptávka</p>
<input type="hidden" name="_subject" value="Poptávka z webu mriservis.cz (varianta B)">
<input type="hidden" name="_template" value="table">
<input type="hidden" name="_next" value="<?= e(abs_url('dekujeme/')) ?>">
<input class="hp" type="text" name="_honey" tabindex="-1" autocomplete="off" aria-hidden="true">
<div class="form__grid">
<label for="v-jmeno">Jméno a příjmení<input id="v-jmeno" name="jmeno" type="text" autocomplete="name" required></label>
<label for="v-firma">Firma<input id="v-firma" name="firma" type="text" autocomplete="organization"></label>
<label for="v-email">E-mail<input id="v-email" name="email" type="email" autocomplete="email" required></label>
<label for="v-telefon">Telefon <span class="opt">(nepovinný)</span><input id="v-telefon" name="telefon" type="tel" autocomplete="tel"></label>
<label class="wide" for="v-predmet">Předmět poptávky<select id="v-predmet" name="predmet">
<?php foreach (V_PREDMETY as $pr): ?><option><?= e($pr) ?></option><?php endforeach; ?>
</select></label>
</div>
<label for="v-zprava">Popis požadavku<textarea id="v-zprava" name="zprava" rows="5" required></textarea></label>
<p class="small">Odesláním poptávky souhlasíte se zpracováním údajů pro její vyřízení. <a href="<?= v_url('ochrana-osobnich-udaju/') ?>">Ochrana osobních údajů</a></p>
<button class="btn btn--orange" type="submit">Odeslat poptávku</button>
</form>
<?php
    return (string) ob_get_clean();
}
