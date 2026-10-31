# mriservis-web

Web firmy MRI Servis - průmyslová automatizace s.r.o. (mriservis.cz) a představení aplikace MRI Pro.

Náhled: https://ondrej-kratochvil.github.io/mriservis-web/

## Jak je web postavený

Čisté PHP bez frameworku. Společné části (hlavička stránky se SEO, menu, patička) jsou v `inc/layout.php`,
údaje o firmě (adresy, telefony, IČO) jen v `inc/config.php`. Obsah, který se opakuje (kroky, funkce,
otázky), je v polích na začátku stránek, takže se upravuje na jednom místě.

| Soubor | Co to je |
|---|---|
| `index.php` | hlavní stránka |
| `mri-pro.php` | podstránka MRI Pro (tmavá) |
| `dekujeme.php` | stránka po odeslání poptávky |
| `404.php` | stránka nenalezena |
| `robots.php`, `sitemap.php` | robots.txt a mapa webu (podle `SPUSTENO` v configu) |
| `inc/config.php` | adresa webu, údaje o firmě, pomocné funkce |
| `inc/layout.php` | `<head>` (SEO, Open Graph, schema.org), hlavička s menu, patička |
| `assets/css/web.css` | jediný soubor stylů |
| `assets/js/menu.js` | menu na mobilu |
| `assets/fonts/` | písma Outfit a Figtree (uložená na webu, bez Google Fonts) |
| `assets/img/`, `assets/og/`, `assets/icons/` | obrázky, náhledy pro sociální sítě, ikony |
| `logo-mri-pro/`, `logo-mri-servis/` | loga ke stažení (ZIP) |
| `build.php` | sestavení statické verze do `_site/` |
| `router.php` | jen pro vývoj (`php -S localhost:8000 router.php`) |
| `.htaccess` | hezké adresy, HTTPS, cache a komprese na hostingu s Apache |

## Nasazení

**GitHub Pages (náhled):** po každém pushi do `main` workflow `.github/workflows/pages.yml` spustí
`build.php` a nasadí statické HTML. V nastavení repa musí být Settings > Pages > Source: **GitHub Actions**.

**Hosting s PHP (mriservis.cz):** nahrát vše kromě `_site/`, `.github/`, `build.php` a `router.php`.
Stránky běží přímo, adresy řeší `.htaccess`. Výchozí adresa webu je `PRODUKCNI_URL` v `inc/config.php`.

## Před spuštěním na mriservis.cz

- Ověřit `PRODUKCNI_URL` (s www, nebo bez) a nastavit HTTPS na hostingu.
- Až bude obsah hotový, přepnout `SPUSTENO` na `true`: stránky se začnou indexovat a robots.txt povolí vyhledávače.
- Formulář poptávky posílá přes FormSubmit (formsubmit.co) na info@mriservis.cz. Po prvním odeslání přijde aktivační e-mail, je potřeba ho potvrdit. Adresa stránky Děkujeme se doplňuje sama podle adresy webu.
- Doplnit podklady, které jsou zatím z webu vyjmuté (reference, fotky realizací, snímky MRI Pro, cena); vedené jako úkoly v Tasks.

## Kontrola kvality

- HTML a CSS bez chyb ve validátoru Nu (W3C).
- Lighthouse (mobil): výkon 96 až 99, přístupnost 100, osvědčené postupy 100. SEO je nižší jen kvůli záměrnému noindex v náhledu.
