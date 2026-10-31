/* Předvyplní předmět poptávky podle odkazu (…?predmet=Servis%20a%20revize#kontakt). */
(function () {
  var sel = document.getElementById('v-predmet');
  if (!sel) return;
  var hodnota = new URLSearchParams(location.search).get('predmet');
  if (!hodnota) return;
  for (var i = 0; i < sel.options.length; i++) {
    if (sel.options[i].text === hodnota) { sel.selectedIndex = i; break; }
  }
})();
