/* Složí e-mailové odkazy až v prohlížeči, aby je roboti nesbírali z HTML. */
(function () {
  document.querySelectorAll('a.js-mail').forEach(function (a) {
    var adresa = a.getAttribute('data-u') + '@' + a.getAttribute('data-d');
    a.href = 'mailto:' + adresa;
    a.textContent = adresa;
  });
})();
