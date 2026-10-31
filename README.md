# mriservis-web

Web firmy MRI Servis - průmyslová automatizace s.r.o. (mriservis.cz) a představení aplikace MRI Pro.

- `index.html` hlavní stránka (zdroj pravdy je tento repozitář, návrhy na plátně už se nesynchronizují)
- `mri-pro.html` podstránka MRI Pro (tmavá varianta)
- `dekujeme.html` stránka po odeslání poptávky
- `assets/` loga, fotky a snímky z aplikace

Statické HTML bez build kroku, hostované na GitHub Pages (větev `main`, kořen).

## Před spuštěním na mriservis.cz

- Doplnit místa v hranatých závorkách (reference, fotky realizací, snímky MRI Pro, cena).
- Odstranit `<meta name="robots" content="noindex, nofollow">` z obou stránek.
- Formulář poptávky posílá přes FormSubmit (formsubmit.co) na info@mriservis.cz. Po prvním odeslání přijde na tu adresu aktivační e-mail, je potřeba ho potvrdit. Po přechodu na doménu změnit `_next` v `index.html` na novou adresu stránky `dekujeme.html`.
- Doménu nastavit v Settings > Pages > Custom domain a u registrátora přidat DNS záznamy pro GitHub Pages.
