(() => {
    const groupTab = document.getElementById('tab-group');
    const individualTab = document.getElementById('tab-individual');
    if (groupTab && individualTab) {
        const switchPricing = (type) => {
            const group = type === 'group';
            document.querySelectorAll('.pricing-group, .group-capacity').forEach(el => el.classList.toggle('hidden', !group));
            document.querySelectorAll('.pricing-individual').forEach(el => el.classList.toggle('hidden', group));
            [[groupTab, group], [individualTab, !group]].forEach(([tab, active]) => {
                tab.classList.toggle('bg-slate-800', active);
                tab.classList.toggle('text-white', active);
                tab.classList.toggle('text-gray-600', !active);
                tab.setAttribute('aria-pressed', String(active));
            });
        };
        groupTab.addEventListener('click', () => switchPricing('group'));
        individualTab.addEventListener('click', () => switchPricing('individual'));
    }

    const sections = [...document.querySelectorAll('section[id]')];
    const navLinks = document.querySelectorAll('.nav-link');
    const highlightActiveSection = () => {
        const current = sections.find(section => window.scrollY + 100 >= section.offsetTop && window.scrollY + 100 < section.offsetTop + section.offsetHeight);
        navLinks.forEach(link => {
            const active = !!current && link.getAttribute('href') === '#' + current.id;
            link.classList.toggle('text-blue-600', active);
            link.classList.toggle('font-semibold', active);
            link.classList.toggle('text-gray-700', !active);
        });
    };
    window.addEventListener('scroll', highlightActiveSection, { passive: true });
    window.addEventListener('load', highlightActiveSection);

    document.querySelectorAll('a[href^="#"]:not([href="#"]):not(.ms_booking)').forEach(anchor => {
        anchor.addEventListener('click', event => {
            const target = document.getElementById(anchor.getAttribute('href').slice(1));
            if (!target) return;
            event.preventDefault();
            target.scrollIntoView({ behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth', block: 'start' });
            history.replaceState(null, '', anchor.getAttribute('href'));
        });
    });

    if (document.querySelector('.glightbox')) {
        const initializeGallery = () => {
            if (typeof window.GLightbox === 'function') {
                window.GLightbox({ touchNavigation: true, loop: true, openEffect: 'zoom', closeEffect: 'fade' });
            }
        };
        if (typeof window.GLightbox === 'function') {
            initializeGallery();
        } else {
            document.querySelector('[data-gallery-script]')?.addEventListener('load', initializeGallery, { once: true });
        }
    }
})();
