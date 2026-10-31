/* Zvětšení snímku po kliknutí. Bez JavaScriptu odkaz otevře obrázek samostatně. */
(function () {
  var links = document.querySelectorAll('a.zoom');
  if (!links.length || typeof HTMLDialogElement !== 'function') return;
  var dlg = document.createElement('dialog');
  dlg.className = 'lightbox';
  dlg.innerHTML = '<button type="button" class="lightbox__close" aria-label="Zavřít">×</button><img alt="">';
  document.body.appendChild(dlg);
  var img = dlg.querySelector('img');
  links.forEach(function (a) {
    a.addEventListener('click', function (e) {
      if (e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;
      e.preventDefault();
      var src = a.querySelector('img');
      img.src = a.href;
      img.alt = src ? src.alt : '';
      dlg.showModal();
    });
  });
  dlg.addEventListener('click', function () { dlg.close(); });
  dlg.addEventListener('close', function () { img.removeAttribute('src'); });
})();
