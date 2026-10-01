/* MDE site — vanilla JS, no dependencies. */
(() => {
  const root = document.documentElement;
  const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => [...c.querySelectorAll(s)];

  // Headline line-by-line intro
  requestAnimationFrame(() => requestAnimationFrame(() => root.classList.add('is-ready')));

  /* ---------- Header: solid on scroll, hide while scrolling down ---------- */
  const header = $('.site-header');
  const toTop = $('.to-top');
  let lastY = scrollY, ticking = false;
  const onScroll = () => {
    const y = scrollY;
    header?.classList.toggle('is-scrolled', y > 10);
    if (!root.classList.contains('menu-open')) {
      header?.classList.toggle('is-hidden', y > 400 && y > lastY + 4);
      if (y < lastY - 4) header?.classList.remove('is-hidden');
    }
    toTop?.classList.toggle('is-visible', y > 800);
    lastY = y;
    ticking = false;
  };
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(onScroll); } }, { passive: true });
  onScroll();
  toTop?.addEventListener('click', () => scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' }));

  /* ---------- Mobile menu ---------- */
  const menuBtn = $('.menu-btn');
  const setMenu = (open) => {
    root.classList.toggle('menu-open', open);
    menuBtn?.setAttribute('aria-expanded', String(open));
    document.body.style.overflow = open ? 'hidden' : '';
  };
  menuBtn?.addEventListener('click', () => setMenu(!root.classList.contains('menu-open')));
  $$('.mobile-menu a').forEach((a) => a.addEventListener('click', () => setMenu(false)));
  addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });

  /* ---------- Reveal on scroll ---------- */
  const revealEls = $$('[data-reveal]');
  if ('IntersectionObserver' in window && !reduceMotion) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) { entry.target.classList.add('is-in'); io.unobserve(entry.target); }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    revealEls.forEach((el) => io.observe(el));
  } else {
    revealEls.forEach((el) => el.classList.add('is-in'));
  }

  /* ---------- Active nav link ---------- */
  const navLinks = $$('.nav a[href^="#"], .nav a[href*="/#"]');
  const sections = navLinks.map((a) => $(a.hash)).filter(Boolean);
  if (sections.length && 'IntersectionObserver' in window) {
    const navIO = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        navLinks.forEach((a) => a.classList.toggle('is-active', a.hash === '#' + entry.target.id));
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    sections.forEach((s) => navIO.observe(s));
  }

  /* ---------- Counters ---------- */
  const counters = $$('[data-count]');
  const runCounter = (el) => {
    const target = +el.dataset.count, suffix = el.dataset.suffix || '';
    if (reduceMotion) { el.textContent = target + suffix; return; }
    const start = performance.now(), dur = 1600;
    const step = (now) => {
      const p = Math.min(1, (now - start) / dur);
      el.textContent = Math.round(target * (1 - Math.pow(1 - p, 4))) + suffix;
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };
  if ('IntersectionObserver' in window) {
    const cIO = new IntersectionObserver((entries) => {
      entries.forEach((e) => { if (e.isIntersecting) { runCounter(e.target); cIO.unobserve(e.target); } });
    }, { threshold: 0.6 });
    counters.forEach((c) => cIO.observe(c));
  } else counters.forEach(runCounter);

  /* ---------- Floating objects follow the cursor (desktop only) ---------- */
  const floaters = $$('[data-depth]');
  if (floaters.length && !reduceMotion && matchMedia('(pointer: fine)').matches) {
    let mx = 0, my = 0, cx = 0, cy = 0, raf = null;
    const loop = () => {
      cx += (mx - cx) * 0.06; cy += (my - cy) * 0.06;
      floaters.forEach((f) => {
        const d = +f.dataset.depth;
        f.style.transform = `translate3d(${cx * d}px, ${cy * d - scrollY * d * 0.6}px, 0)`;
      });
      raf = Math.abs(mx - cx) + Math.abs(my - cy) > 0.05 ? requestAnimationFrame(loop) : null;
    };
    const kick = () => { if (!raf) raf = requestAnimationFrame(loop); };
    addEventListener('pointermove', (e) => {
      mx = (e.clientX / innerWidth - 0.5) * 60;
      my = (e.clientY / innerHeight - 0.5) * 60;
      kick();
    }, { passive: true });
    // Light scroll parallax while the hero is on screen.
    addEventListener('scroll', () => { if (scrollY < innerHeight * 1.5) kick(); }, { passive: true });
  }

  /* ---------- Portfolio filter ---------- */
  const grid = $('.work-grid');
  $$('[data-filter]').forEach((chip) => chip.addEventListener('click', () => {
    const f = chip.dataset.filter;
    $$('[data-filter]').forEach((c) => {
      c.classList.toggle('is-active', c === chip);
      c.setAttribute('aria-pressed', String(c === chip));
    });
    grid?.classList.toggle('is-filtered', f !== 'all');
    $$('.work-card', grid).forEach((card) => {
      const show = f === 'all' || card.dataset.category === f;
      card.hidden = !show;
      if (show) card.classList.add('is-in');
    });
  }));

  /* ---------- Like button (one per IP, server-side) ---------- */
  const likeBtns = $$('[data-like]');
  if (likeBtns.length) {
    const render = (d) => likeBtns.forEach((b) => {
      if ('count' in d) $('.count', b).textContent = d.count > 99 ? '99+' : d.count;
      if ('liked' in d) { b.classList.toggle('is-liked', d.liked); b.setAttribute('aria-pressed', String(d.liked)); }
    });
    fetch('/like-count').then((r) => r.json()).then(render).catch(() => {});
    fetch('/like-status').then((r) => r.json()).then(render).catch(() => {});
    likeBtns.forEach((b) => b.addEventListener('click', () => {
      b.classList.remove('pop'); void b.offsetWidth; b.classList.add('pop');
      fetch('/like-toggle', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, Accept: 'application/json' } })
        .then((r) => r.json()).then(render).catch(() => {});
    }));
  }

  /* ---------- Contact dialog ---------- */
  const dialog = $('#contact');
  $$('[data-contact]').forEach((b) => b.addEventListener('click', (e) => {
    if (!dialog?.showModal) return; // very old browsers follow the link instead
    e.preventDefault();
    setMenu(false);
    dialog.showModal();
  }));
  dialog?.addEventListener('click', (e) => { if (e.target === dialog) dialog.close(); });
  $$('[data-close]', dialog || document).forEach((b) => b.addEventListener('click', () => dialog.close()));

  const form = $('#contact-form');
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = $('button[type="submit"]', form);
    const note = $('.form-note', form);
    $$('.error', form).forEach((el) => { el.textContent = ''; el.hidden = true; });
    note.hidden = true;
    btn.disabled = true;
    btn.querySelector('.label').textContent = 'Sending…';
    btn.querySelector('.spinner').hidden = false;
    try {
      const res = await fetch(form.action, {
        method: 'POST', body: new FormData(form), headers: { 'X-CSRF-TOKEN': csrf, Accept: 'application/json' },
      });
      const data = await res.json().catch(() => ({}));
      if (res.ok && data.success) {
        form.reset();
        note.textContent = 'Thank you! Your message has been sent — I will get back to you soon.';
        note.hidden = false;
      } else if (res.status === 429) {
        note.textContent = 'Too many messages. Please try again in a minute.';
        note.hidden = false;
      } else {
        Object.entries(data.errors || {}).forEach(([field, msgs]) => {
          const el = $(`[data-error="${field}"]`, form);
          if (el) { el.textContent = msgs[0]; el.hidden = false; }
        });
      }
    } catch {
      note.textContent = 'Something went wrong. Please try again.';
      note.hidden = false;
    } finally {
      btn.disabled = false;
      btn.querySelector('.label').textContent = 'Send message';
      btn.querySelector('.spinner').hidden = true;
    }
  });
})();
