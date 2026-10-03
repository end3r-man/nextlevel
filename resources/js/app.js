/**
 * Next Level Packers & Movers — front-end behaviour.
 *
 * Deliberately dependency-free. The legacy site shipped jQuery + Bootstrap +
 * Swiper + GSAP + ScrollTrigger + SplitText + Fancybox + jarallax + isotope +
 * Lenis + Lenis smooth-scroll (roughly 600 KB of blocking JavaScript) purely for
 * a mobile nav, a carousel and some scroll reveals. Everything below does the
 * same job in a few KB, which is the single biggest win for LCP/TBT on a
 * content site whose whole job is to rank.
 */

const onReady = (fn) => {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn, { once: true });
    }
};

/* ------------------------------------------------------------------ *
 * Sticky header shadow
 * ------------------------------------------------------------------ */
function initStickyHeader() {
    const header = document.querySelector('[data-sticky-header]');
    if (!header) return;

    const sync = () => {
        header.classList.toggle('is-stuck', window.scrollY > 24);
    };

    sync();
    window.addEventListener('scroll', sync, { passive: true });
}

/* ------------------------------------------------------------------ *
 * Mobile navigation drawer
 * ------------------------------------------------------------------ */
function initMobileNav() {
    const triggers = document.querySelectorAll('[data-nav-open]');
    const closers = document.querySelectorAll('[data-nav-close]');
    const panel = document.querySelector('[data-nav-panel]');

    if (!panel) return;

    const focusableSelector =
        'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])';

    const panelFocusables = () => Array.from(panel.querySelectorAll(focusableSelector));

    let lastTrigger = null;

    const setOpen = (open) => {
        if (open === !panel.classList.contains('hidden')) return;

        panel.classList.toggle('hidden', !open);
        panel.setAttribute('aria-hidden', String(!open));

        // Keep the page behind the drawer from scrolling while it is open.
        document.documentElement.classList.toggle('overflow-hidden', open);

        triggers.forEach((btn) => {
            btn.setAttribute('aria-expanded', String(open));
            btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        });

        // Move focus only when opening. Focusing on close would drop the user
        // into a hidden panel — previously Escape did exactly that.
        if (open) {
            lastTrigger = document.activeElement;
            panelFocusables()[0]?.focus({ preventScroll: true });
        } else {
            (lastTrigger instanceof HTMLElement ? lastTrigger : triggers[0])?.focus({
                preventScroll: true,
            });
        }
    };

    triggers.forEach((btn) => btn.addEventListener('click', () => setOpen(true)));
    closers.forEach((btn) => btn.addEventListener('click', () => setOpen(false)));

    document.addEventListener('keydown', (e) => {
        const open = !panel.classList.contains('hidden');
        if (!open) return;

        if (e.key === 'Escape') {
            setOpen(false);
            return;
        }

        // Keep Tab inside the drawer while it is open.
        if (e.key === 'Tab') {
            const items = panelFocusables();
            if (!items.length) return;

            const first = items[0];
            const last = items[items.length - 1];

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
}

/* ------------------------------------------------------------------ *
 * Scroll reveal — IntersectionObserver, replaced GSAP + ScrollTrigger.
 * Elements only start hidden when JS is present (see html.js class) so the
 * page is never blank if the observer never fires.
 * ------------------------------------------------------------------ */
function initReveal() {
    const items = document.querySelectorAll('[data-reveal]');

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        items.forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const delay = Number(entry.target.dataset.reveal || 0);
                setTimeout(() => entry.target.classList.add('is-revealed'), delay * 70);
                observer.unobserve(entry.target);
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
    );

    items.forEach((el) => observer.observe(el));
}

/* ------------------------------------------------------------------ *
 * Animated counters
 * ------------------------------------------------------------------ */
function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');

    if (!counters.length) return;

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const render = (el, value) => {
        const decimals = Number(el.dataset.counterDecimals || 0);
        const suffix = el.dataset.counterSuffix || '';
        el.textContent = value.toFixed(decimals) + suffix;
    };

    const run = (el) => {
        const target = Number(el.dataset.counter);
        if (reduced) return render(el, target);

        const duration = 1400;
        const start = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            // easeOutExpo
            const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            render(el, target * eased);
            if (progress < 1) requestAnimationFrame(tick);
        };

        requestAnimationFrame(tick);
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                run(entry.target);
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.4 },
    );

    counters.forEach((el) => observer.observe(el));
}

/* ------------------------------------------------------------------ *
 * Accordion (FAQ) — progressive, <details> style but JS-driven so we can
 * keep only one panel open at a time.
 * ------------------------------------------------------------------ */
function initAccordion() {
    document.querySelectorAll('[data-accordion]').forEach((root, rootIndex) => {
        const single = root.dataset.accordion === 'single';
        const triggers = root.querySelectorAll('[data-accordion-trigger]');

        triggers.forEach((trigger, index) => {
            const panel = trigger.nextElementSibling;
            if (!panel) return;

            // Give every trigger/panel pair an id relationship. Doing it here
            // keeps the three templates free of hand-maintained id pairs that
            // drift the moment an accordion is reordered.
            if (!panel.id) {
                panel.id = `accordion-panel-${rootIndex}-${index}`;
            }
            trigger.setAttribute('aria-controls', panel.id);

            trigger.addEventListener('click', () => {
                const isOpen = trigger.getAttribute('aria-expanded') === 'true';

                if (single && !isOpen) {
                    triggers.forEach((other) => {
                        if (other === trigger) return;
                        other.setAttribute('aria-expanded', 'false');
                        const otherPanel = other.nextElementSibling;
                        if (otherPanel) otherPanel.classList.add('hidden');
                        other.querySelector('[data-accordion-icon]')?.classList.remove('rotate-180');
                    });
                }

                trigger.setAttribute('aria-expanded', String(!isOpen));
                panel.classList.toggle('hidden', isOpen);
                trigger.querySelector('[data-accordion-icon]')?.classList.toggle('rotate-180', !isOpen);
            });
        });
    });
}

/* ------------------------------------------------------------------ *
 * Testimonial slider — CSS scroll-snap driven, JS only wires the buttons.
 * ------------------------------------------------------------------ */
function initSliders() {
    document.querySelectorAll('[data-slider]').forEach((root) => {
        const track = root.querySelector('[data-slider-track]');
        const prev = root.querySelector('[data-slider-prev]');
        const next = root.querySelector('[data-slider-next]');

        if (!track) return;

        const step = () => {
            const first = track.firstElementChild;
            return first ? first.getBoundingClientRect().width + 24 : 320;
        };

        prev?.addEventListener('click', () => {
            track.scrollBy({ left: -step(), behavior: 'smooth' });
        });

        next?.addEventListener('click', () => {
            track.scrollBy({ left: step(), behavior: 'smooth' });
        });
    });
}

/* ------------------------------------------------------------------ *
 * Gallery lightbox
 *
 * Every [data-lightbox-trigger] on the page becomes a navigable set, so
 * arrow keys / prev / next walk the gallery instead of forcing a reopen.
 * ------------------------------------------------------------------ */
function initLightbox() {
    const lightbox = document.querySelector('[data-lightbox]');
    if (!lightbox) return;

    const image = lightbox.querySelector('[data-lightbox-image]');
    const caption = lightbox.querySelector('[data-lightbox-caption]');
    const counter = lightbox.querySelector('[data-lightbox-counter]');
    const focusables = () => Array.from(lightbox.querySelectorAll('button:not([disabled])'));

    let slides = [];
    let index = 0;
    let lastFocused = null;

    const render = () => {
        const slide = slides[index];
        if (!slide || !image) return;

        image.src = slide.src;
        image.alt = slide.alt || '';

        if (caption) caption.textContent = slide.title || slide.alt || '';

        if (counter) {
            counter.textContent = slides.length > 1 ? `${index + 1} / ${slides.length}` : '';
        }

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightbox.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('overflow-hidden');
    };

    const open = (trigger) => {
        lastFocused = document.activeElement;

        slides = Array.from(document.querySelectorAll('[data-lightbox-trigger]')).map((el) => ({
            src: el.dataset.lightboxTrigger,
            alt: el.dataset.lightboxAlt || '',
            title: el.dataset.lightboxTitle || '',
        }));
        index = Math.max(0, slides.findIndex((s) => s.src === trigger.dataset.lightboxTrigger));

        render();
        focusables()[0]?.focus({ preventScroll: true });
    };

    const step = (delta) => {
        if (slides.length < 2) return;
        index = (index + delta + slides.length) % slides.length;
        render();
    };

    const close = () => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        lightbox.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('overflow-hidden');
        lastFocused?.focus({ preventScroll: true });
    };

    lightbox.querySelector('[data-lightbox-close]')?.addEventListener('click', close);
    lightbox.querySelector('[data-lightbox-prev]')?.addEventListener('click', () => step(-1));
    lightbox.querySelector('[data-lightbox-next]')?.addEventListener('click', () => step(1));

    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-lightbox-trigger]');
        if (trigger) {
            e.preventDefault();
            open(trigger);
            return;
        }
        if (e.target === lightbox) close();
    });

    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('hidden')) return;

        if (e.key === 'Escape') {
            close();
            return;
        }
        if (e.key === 'ArrowLeft') step(-1);
        if (e.key === 'ArrowRight') step(1);

        // Keep Tab inside the dialog — it is modal.
        if (e.key === 'Tab') {
            const items = focusables();
            if (!items.length) return;
            const first = items[0];
            const last = items[items.length - 1];

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
}

/* ------------------------------------------------------------------ *
 * Enquiry form — fetch submit, inline validation messaging
 * ------------------------------------------------------------------ */
function initQuoteForm() {
    const form = document.querySelector('[data-quote-form]');
    if (!form) return;

    const messages = form.querySelector('[data-form-messages]');
    const submit = form.querySelector('[type="submit"]');
    const originalLabel = submit?.innerHTML;

    const say = (message, tone = 'error') => {
        if (!messages) return;
        messages.innerHTML = `<div role="alert" class="rounded-lg px-4 py-3 text-sm font-medium ${
            tone === 'success'
                ? 'bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200'
                : 'bg-red-50 text-red-800 ring-1 ring-red-200'
        }">${message}</div>`;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        messages?.replaceChildren();

        if (!form.reportValidity()) return;

        const payload = Object.fromEntries(new FormData(form).entries());

        if (submit) {
            submit.disabled = true;
            submit.innerHTML = '<span>Sending…</span>';
        }

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    // Web routes are CSRF-protected. The token is rendered into
                    // the head by the layout; without this every submit 419s.
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                },
                body: JSON.stringify(payload),
            });

            if (res.ok) {
                const data = await res.json().catch(() => ({}));
                form.reset();
                say(
                    data.message ??
                        'Thank you! Your enquiry has been received. We will call you within 30 minutes.',
                    'success',
                );
                if (data.whatsapp_url) {
                    const link = document.createElement('a');
                    link.href = data.whatsapp_url;
                    link.target = '_blank';
                    link.rel = 'noopener';
                    link.className =
                        'mt-3 inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 underline hover:no-underline';
                    link.textContent = 'Continue on WhatsApp →';
                    messages.appendChild(link);
                }
            } else {
                const data = await res.json().catch(() => ({}));

                // Mark the offending inputs so the message is not just noise.
                form.querySelectorAll('[aria-invalid="true"]').forEach((el) =>
                    el.removeAttribute('aria-invalid'),
                );
                Object.keys(data.errors || {}).forEach((field) => {
                    form.querySelectorAll(`[name="${field}"]`).forEach((el) =>
                        el.setAttribute('aria-invalid', 'true'),
                    );
                });

                say(
                    data.message ??
                        (res.status === 422
                            ? Object.values(data.errors || {}).flat().join(' ')
                            : 'Something went wrong. Please call us on +91 93635 55311.'),
                );
            }
        } catch {
            say('Network error. Please call us on +91 93635 55311 or try again.');
        } finally {
            if (submit) {
                submit.disabled = false;
                submit.innerHTML = originalLabel;
            }
        }
    });
}

/* ------------------------------------------------------------------ *
 * Auto-submit-friendly date/time inputs (native, no jQuery datepicker)
 * ------------------------------------------------------------------ */
function initDateConstraints() {
    const date = document.querySelector('[name="moving_date"]');
    if (!date) return;

    const today = new Date();
    today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
    date.min = today.toISOString().split('T')[0];
}

/* ------------------------------------------------------------------ *
 * Quick Move Estimator (Hero Calculator)
 * ------------------------------------------------------------------ */
function initQuickCalculator() {
    const form = document.querySelector('[data-calc-form]');
    if (!form) return;

    const fromSelect = form.querySelector('[data-calc-from]');
    const toSelect = form.querySelector('[data-calc-to]');
    const sizeSelect = form.querySelector('[data-calc-size]');
    const output = form.querySelector('[data-calc-output]');
    const tabs = document.querySelectorAll('[data-move-tab]');
    const submitBtn = form.querySelector('[data-calc-submit]');

    let currentTab = 'home';

    const sizeOptions = {
        home: [
            { value: '1bhk', label: '1 BHK (Standard Flat / 1-2 Rooms)' },
            { value: '2bhk', label: '2 BHK (Complete Household)' },
            { value: '3bhk', label: '3 BHK / Independent House' },
            { value: 'villa', label: '4+ BHK / Luxury Villa' },
            { value: 'items', label: 'Few Furniture Items / Single Room' },
        ],
        office: [
            { value: 'small_office', label: 'Small Office (5–15 Workstations)' },
            { value: 'mid_office', label: 'Medium Office (15–40 Workstations)' },
            { value: 'corporate', label: 'Entire Floor / Corporate Office' },
            { value: 'shop', label: 'Shop / Showroom / Commercial Space' },
        ],
        vehicle: [
            { value: 'commuter', label: 'Commuter Bike (100cc–160cc)' },
            { value: 'premium_bike', label: 'Premium / Royal Enfield / Cruiser' },
            { value: 'scooter', label: 'Scooter / Moped (Activa/Jupiter)' },
            { value: 'car', label: 'Car Transport (Hatchback / SUV)' },
        ],
    };

    const updateSizeOptions = () => {
        const options = sizeOptions[currentTab] || sizeOptions.home;
        sizeSelect.innerHTML = options
            .map((opt) => `<option value="${opt.value}">${opt.label}</option>`)
            .join('');
    };

    const calculate = () => {
        if (!output) return;

        const from = fromSelect?.value || 'Erode';
        const to = toSelect?.value || 'Coimbatore';
        const size = sizeSelect?.value || '1bhk';

        const isLocal = from === to;
        const isIntercity = !isLocal && (from === 'Bengaluru' || to === 'Bengaluru' || from === 'Chennai' || to === 'Chennai');

        let min = 3500;
        let max = 6500;

        if (currentTab === 'home') {
            switch (size) {
                case 'items':
                    min = isLocal ? 1999 : isIntercity ? 4500 : 3200;
                    max = isLocal ? 3499 : isIntercity ? 7500 : 4999;
                    break;
                case '1bhk':
                    min = isLocal ? 3499 : isIntercity ? 8999 : 5499;
                    max = isLocal ? 5999 : isIntercity ? 13999 : 8499;
                    break;
                case '2bhk':
                    min = isLocal ? 5999 : isIntercity ? 14999 : 8999;
                    max = isLocal ? 8999 : isIntercity ? 22999 : 13999;
                    break;
                case '3bhk':
                    min = isLocal ? 8999 : isIntercity ? 21999 : 13999;
                    max = isLocal ? 14999 : isIntercity ? 32999 : 19999;
                    break;
                case 'villa':
                    min = isLocal ? 13999 : isIntercity ? 29999 : 19999;
                    max = isLocal ? 22999 : isIntercity ? 45999 : 28999;
                    break;
            }
        } else if (currentTab === 'office') {
            switch (size) {
                case 'small_office':
                    min = isLocal ? 6999 : isIntercity ? 16999 : 10999;
                    max = isLocal ? 11999 : isIntercity ? 24999 : 16999;
                    break;
                case 'mid_office':
                    min = isLocal ? 14999 : isIntercity ? 29999 : 21999;
                    max = isLocal ? 24999 : isIntercity ? 44999 : 32999;
                    break;
                case 'corporate':
                    min = isLocal ? 29999 : isIntercity ? 59999 : 42999;
                    max = isLocal ? 54999 : isIntercity ? 95000 : 72000;
                    break;
                case 'shop':
                    min = isLocal ? 5999 : isIntercity ? 14999 : 9999;
                    max = isLocal ? 10999 : isIntercity ? 22999 : 15999;
                    break;
            }
        } else if (currentTab === 'vehicle') {
            switch (size) {
                case 'commuter':
                    min = isLocal ? 1499 : isIntercity ? 3499 : 2499;
                    max = isLocal ? 2499 : isIntercity ? 4999 : 3499;
                    break;
                case 'premium_bike':
                    min = isLocal ? 1999 : isIntercity ? 4499 : 3299;
                    max = isLocal ? 2999 : isIntercity ? 6499 : 4499;
                    break;
                case 'scooter':
                    min = isLocal ? 1499 : isIntercity ? 3499 : 2499;
                    max = isLocal ? 2499 : isIntercity ? 4999 : 3499;
                    break;
                case 'car':
                    min = isLocal ? 4999 : isIntercity ? 11999 : 7999;
                    max = isLocal ? 7999 : isIntercity ? 17999 : 11999;
                    break;
            }
        }

        output.textContent = `₹${min.toLocaleString('en-IN')} – ₹${max.toLocaleString('en-IN')}*`;
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach((t) => {
                t.classList.remove('active-tab', 'bg-brand-600', 'text-white', 'shadow-sm');
                t.classList.add('text-slate-300');
            });
            tab.classList.add('active-tab', 'bg-brand-600', 'text-white', 'shadow-sm');
            tab.classList.remove('text-slate-300');

            currentTab = tab.dataset.moveTab;
            updateSizeOptions();
            calculate();
        });
    });

    fromSelect?.addEventListener('change', calculate);
    toSelect?.addEventListener('change', calculate);
    sizeSelect?.addEventListener('change', calculate);

    // Pre-fill final quote form when user clicks "Lock This Price"
    submitBtn?.addEventListener('click', (e) => {
        const fromVal = fromSelect?.value;
        const toVal = toSelect?.value;

        const qFrom = document.querySelector('#q-from');
        const qTo = document.querySelector('#q-to');
        const qService = document.querySelector('#q-service');
        const qName = document.querySelector('#q-name');

        if (qFrom && fromVal) qFrom.value = fromVal;
        if (qTo && toVal) qTo.value = toVal;
        if (qService) {
            if (currentTab === 'home') qService.value = 'House Shifting';
            else if (currentTab === 'office') qService.value = 'Office Shifting';
            else if (currentTab === 'vehicle') qService.value = 'Two Wheeler Shifting';
        }

        if (qName) {
            setTimeout(() => qName.focus(), 400);
        }
    });

    calculate();
}

/* ------------------------------------------------------------------ *
 * Location Search Filter
 * ------------------------------------------------------------------ */
function initLocationFilter() {
    const input = document.querySelector('[data-location-filter]');
    const list = document.querySelector('[data-location-list]');
    if (!input || !list) return;

    const items = list.querySelectorAll('li[data-city-name]');

    input.addEventListener('input', () => {
        const query = input.value.toLowerCase().trim();
        items.forEach((item) => {
            const city = item.dataset.cityName || '';
            const match = !query || city.includes(query);
            item.style.display = match ? '' : 'none';
        });
    });
}

/* ------------------------------------------------------------------ *
 * Service Category Filter
 * ------------------------------------------------------------------ */
function initServiceCategoryFilter() {
    const buttons = document.querySelectorAll('[data-service-filter]');
    const cards = document.querySelectorAll('[data-service-category]');
    if (!buttons.length || !cards.length) return;

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.serviceFilter;

            buttons.forEach((b) => {
                b.classList.remove('bg-brand-600', 'text-white', 'shadow-soft');
                b.classList.add('bg-white', 'text-ink-700', 'border', 'border-ink-200', 'shadow-2xs');
            });

            btn.classList.add('bg-brand-600', 'text-white', 'shadow-soft');
            btn.classList.remove('bg-white', 'text-ink-700', 'border', 'border-ink-200', 'shadow-2xs');

            cards.forEach((card) => {
                const category = card.dataset.serviceCategory;
                const match = filter === 'all' || category === filter;
                card.style.display = match ? '' : 'none';
            });
        });
    });
}

/* ------------------------------------------------------------------ *
 * Why Choose Us Tabs (Mission, Vision, Values)
 * ------------------------------------------------------------------ */
function initWhyUsTabs() {
    const group = document.querySelector('[data-tab-group]');
    if (!group) return;

    const triggers = group.querySelectorAll('[data-tab-target]');
    const panels = group.querySelectorAll('[data-tab-panel]');

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const target = trigger.dataset.tabTarget;

            triggers.forEach((t) => {
                t.classList.remove('border-brand-600', 'text-brand-700', 'font-bold');
                t.classList.add('border-transparent', 'text-ink-500', 'font-semibold');
            });

            trigger.classList.add('border-brand-600', 'text-brand-700', 'font-bold');
            trigger.classList.remove('border-transparent', 'text-ink-500', 'font-semibold');

            panels.forEach((p) => {
                if (p.dataset.tabPanel === target) {
                    p.classList.remove('hidden');
                } else {
                    p.classList.add('hidden');
                }
            });
        });
    });
}

/* ------------------------------------------------------------------ *
 * Copy phone to clipboard (small UX nicety on the contact page)
 * ------------------------------------------------------------------ */
function initCopyButtons() {
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('[data-copy]');
        if (!btn) return;
        try {
            await navigator.clipboard.writeText(btn.dataset.copy);
            const original = btn.textContent;
            btn.textContent = 'Copied!';
            setTimeout(() => {
                btn.textContent = original;
            }, 1800);
        } catch {
            /* clipboard unavailable — ignore */
        }
    });
}

onReady(() => {
    initStickyHeader();
    initMobileNav();
    initReveal();
    initCounters();
    initAccordion();
    initSliders();
    initLightbox();
    initQuoteForm();
    initDateConstraints();
    initQuickCalculator();
    initLocationFilter();
    initServiceCategoryFilter();
    initWhyUsTabs();
    initCopyButtons();
});
