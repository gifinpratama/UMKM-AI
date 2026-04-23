import './bootstrap';

// ===== UMKM.AI Animation Utilities =====
// These are globally available animation helpers using anime.js

document.addEventListener('DOMContentLoaded', () => {
    // Intersection Observer for scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const animationType = el.dataset.animate;

                switch (animationType) {
                    case 'fade-in':
                        anime({
                            targets: el,
                            opacity: [0, 1],
                            translateY: [20, 0],
                            duration: 700,
                            easing: 'easeOutCubic'
                        });
                        break;
                    case 'slide-left':
                        anime({
                            targets: el,
                            opacity: [0, 1],
                            translateX: [-40, 0],
                            duration: 700,
                            easing: 'easeOutCubic'
                        });
                        break;
                    case 'slide-right':
                        anime({
                            targets: el,
                            opacity: [0, 1],
                            translateX: [40, 0],
                            duration: 700,
                            easing: 'easeOutCubic'
                        });
                        break;
                    case 'scale-in':
                        anime({
                            targets: el,
                            opacity: [0, 1],
                            scale: [0.9, 1],
                            duration: 600,
                            easing: 'easeOutCubic'
                        });
                        break;
                    case 'stagger':
                        anime({
                            targets: el.children,
                            opacity: [0, 1],
                            translateY: [15, 0],
                            delay: anime.stagger(80),
                            duration: 500,
                            easing: 'easeOutCubic'
                        });
                        break;
                }

                animationObserver.unobserve(el);
            }
        });
    }, observerOptions);

    // Auto-observe elements with data-animate attribute
    document.querySelectorAll('[data-animate]').forEach(el => {
        // Set initial state
        el.style.opacity = '0';
        animationObserver.observe(el);
    });

    // Sidebar hover effects
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('mouseenter', () => {
            anime({
                targets: link,
                paddingLeft: '1.25rem',
                duration: 200,
                easing: 'easeOutCubic'
            });
        });
        link.addEventListener('mouseleave', () => {
            anime({
                targets: link,
                paddingLeft: '1rem',
                duration: 200,
                easing: 'easeOutCubic'
            });
        });
    });
});

// ===== Global Helper Functions =====

// Counter animation (for stat numbers)
window.animateCounter = function(element, target, duration = 1500, prefix = '', suffix = '') {
    const obj = { value: 0 };
    anime({
        targets: obj,
        value: target,
        round: 1,
        duration: duration,
        easing: 'easeOutExpo',
        update: () => {
            element.textContent = prefix + obj.value.toLocaleString('id-ID') + suffix;
        }
    });
};

// Particle background generator for landing page
window.createParticles = function(container, count = 30) {
    for (let i = 0; i < count; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.width = (Math.random() * 4 + 2) + 'px';
        particle.style.height = particle.style.width;
        particle.style.opacity = Math.random() * 0.5 + 0.1;
        container.appendChild(particle);

        anime({
            targets: particle,
            translateY: [0, anime.random(-80, 80)],
            translateX: [0, anime.random(-60, 60)],
            opacity: [() => Math.random() * 0.5 + 0.1, () => Math.random() * 0.3],
            scale: [1, anime.random(0.5, 1.5)],
            duration: anime.random(3000, 6000),
            direction: 'alternate',
            loop: true,
            easing: 'easeInOutSine',
            delay: anime.random(0, 2000),
        });
    }
};

// Hero section animation
window.animateHero = function() {
    const tl = anime.timeline({ easing: 'easeOutExpo' });
    
    tl.add({ targets: '.hero-badge', opacity: [0, 1], translateY: [-20, 0], duration: 600 })
      .add({ targets: '.hero-title', opacity: [0, 1], translateY: [30, 0], duration: 800 }, '-=300')
      .add({ targets: '.hero-subtitle', opacity: [0, 1], translateY: [20, 0], duration: 600 }, '-=400')
      .add({ targets: '.hero-cta', opacity: [0, 1], translateY: [20, 0], scale: [0.9, 1], duration: 600 }, '-=300')
      .add({ targets: '.hero-stats > *', opacity: [0, 1], translateY: [20, 0], delay: anime.stagger(100), duration: 500 }, '-=200');
};

// Cards entrance animation
window.animateCards = function(selector, delay = 100) {
    anime({
        targets: selector,
        opacity: [0, 1],
        translateY: [30, 0],
        scale: [0.95, 1],
        delay: anime.stagger(delay),
        duration: 700,
        easing: 'easeOutCubic'
    });
};

// Chart entrance animation
window.animateCharts = function(selector) {
    anime({
        targets: selector,
        opacity: [0, 1],
        scale: [0.9, 1],
        duration: 800,
        delay: 200,
        easing: 'easeOutCubic'
    });
};

// Page transition effect
window.animatePageTransition = function(direction = 'in') {
    if (direction === 'in') {
        anime({
            targets: 'main > *',
            opacity: [0, 1],
            translateY: [15, 0],
            duration: 600,
            delay: anime.stagger(80),
            easing: 'easeOutCubic'
        });
    }
};

// Number format helper (Indonesian format)
window.formatRupiah = function(number) {
    return 'Rp ' + number.toLocaleString('id-ID');
};
