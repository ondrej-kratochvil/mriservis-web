<?php
declare(strict_types=1);
require __DIR__ . '/spolecne.php';

page_start(v_page([
    'route'       => 'varianta/ochrana-osobnich-udaju/',
    'title'       => 'Ochrana osobních údajů | MRI Servis (varianta B)',
    'description' => 'Jak MRI Servis zpracovává osobní údaje z poptávkového formuláře a kontaktů.',
]));
?>
<section class="section">
<div class="wrap v2-text">
<p class="eyebrow">Ochrana osobních údajů</p>
<h1 class="h1">Jak zacházíme s vašimi údaji</h1>
<p class="v2-draft">Návrh textu k posouzení. Před spuštěním webu ho musí schválit MRI Servis.</p>

<h2>Správce</h2>
<p><?= e(FIRMA['nazev']) ?>, <?= e(adresa(FIRMA['sidlo'])) ?>, IČO <?= FIRMA['ico'] ?>. Kontakt: <a href="mailto:<?= FIRMA['email'] ?>"><?= FIRMA['email'] ?></a>, <a href="<?= tel(FIRMA['telefon']) ?>"><?= e(FIRMA['telefon']) ?></a>.</p>

<h2>Jaké údaje a proč</h2>
<p>Z poptávkového formuláře zpracováváme jméno, firmu, e-mail, telefon a text poptávky. Použijeme je jen k vyřízení poptávky a k jednání o případné zakázce. Právním základem je jednání o smlouvě na vaši žádost (čl. 6 odst. 1 písm. b) GDPR).</p>

<h2>Komu údaje předáváme</h2>
<p>Formulář odesílá data přes službu FormSubmit (formsubmit.co), která nám je přepošle e-mailem. Jiným subjektům údaje nepředáváme, pokud to nevyžaduje zákon.</p>

<h2>Jak dlouho</h2>
<p>Po dobu nezbytnou k vyřízení poptávky. Pokud vznikne zakázka, po dobu jejího trvání a po dobu, kterou ukládají právní předpisy.</p>

<h2>Vaše práva</h2>
<p>Máte právo na přístup k údajům, jejich opravu nebo výmaz, omezení zpracování, přenositelnost a právo vznést námitku. Stížnost můžete podat u Úřadu pro ochranu osobních údajů (uoou.gov.cz).</p>

<h2>Cookies</h2>
<p>Web nepoužívá analytické ani marketingové cookies, proto nezobrazuje lištu se souhlasem.</p>
</div>
</section>
<?php page_end(v_footer());
