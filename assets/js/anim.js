/* Ukázka vytížení: dílky grafu se „nabijí“, když se sekce objeví na obrazovce. Bez JS nebo s omezením pohybu je graf hned celý. */
(function () {
  if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  document.querySelectorAll('.js-anim').forEach(function (el) {
    var r = el.getBoundingClientRect();
    if (r.top < window.innerHeight) return;
    el.classList.add('anim-ready');
    var io = new IntersectionObserver(function (zaznamy) {
      zaznamy.forEach(function (z) {
        if (z.isIntersecting) { el.classList.add('anim-in'); io.disconnect(); }
      });
    }, { threshold: 0.35 });
    io.observe(el);
  });
})();
