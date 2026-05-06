/* =============================================
   SDN Nusantara Jaya - Main JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

    // ===== PAGE LOADER =====
    const loader = document.querySelector('.page-loader');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 1600);
    }

    // ===== NAVBAR SCROLL EFFECT =====
    const navbar = document.querySelector('.navbar');
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const backToTop = document.querySelector('.back-to-top');

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        // Navbar scroll
        if (navbar) {
            if (scrollY > 60) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // Back to top button
        if (backToTop) {
            if (scrollY > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }

        // Active nav link based on scroll
        updateActiveNavLink();
    });

    // ===== MOBILE NAV TOGGLE =====
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('open');
        });

        // Close menu on nav link click
        navMenu.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navToggle.classList.remove('active');
                navMenu.classList.remove('open');
            });
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!navbar.contains(e.target)) {
                navToggle.classList.remove('active');
                navMenu.classList.remove('open');
            }
        });
    }

    // ===== ACTIVE NAV LINK =====
    function updateActiveNavLink() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
        let currentSection = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (window.scrollY >= sectionTop) {
                currentSection = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + currentSection) {
                link.classList.add('active');
            }
        });
    }

    // ===== BACK TO TOP =====
    if (backToTop) {
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ===== SCROLL ANIMATIONS (Intersection Observer) =====
    const animateElements = document.querySelectorAll(
        '.animate-on-scroll, .animate-left, .animate-right, .animate-scale'
    );

    if (animateElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -60px 0px'
        });

        animateElements.forEach(el => observer.observe(el));
    }

    // ===== COUNTER ANIMATION =====
    function animateCounter(el, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                el.textContent = target + (el.dataset.suffix || '');
                clearInterval(timer);
            } else {
                el.textContent = Math.floor(start) + (el.dataset.suffix || '');
            }
        }, 16);
    }

    const counters = document.querySelectorAll('.stat-num[data-count], .hero-stat-num[data-count]');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.counted) {
                entry.target.dataset.counted = 'true';
                const target = parseInt(entry.target.dataset.count);
                animateCounter(entry.target, target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => counterObserver.observe(counter));

    // ===== GALERI FILTER =====
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galeriItems = document.querySelectorAll('.galeri-item[data-kategori]');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;

            galeriItems.forEach(item => {
                if (filter === 'semua' || item.dataset.kategori === filter) {
                    item.style.display = '';
                    item.style.animation = 'fadeInUp 0.4s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // ===== GALERI LIGHTBOX =====
    const galeriOverlays = document.querySelectorAll('.galeri-item');
    galeriOverlays.forEach(item => {
        item.addEventListener('click', () => {
            const img = item.querySelector('img');
            const title = item.querySelector('.galeri-title')?.textContent || '';
            if (img) openLightbox(img.src, title);
        });
    });

    function openLightbox(src, title) {
        const lb = document.createElement('div');
        lb.className = 'lightbox';
        lb.innerHTML = `
            <div class="lb-overlay"></div>
            <div class="lb-content">
                <button class="lb-close">✕</button>
                <img src="${src}" alt="${title}">
                ${title ? `<p class="lb-caption">${title}</p>` : ''}
            </div>
        `;
        lb.style.cssText = `
            position:fixed;inset:0;z-index:9999;display:flex;
            align-items:center;justify-content:center;padding:20px;
        `;
        lb.querySelector('.lb-overlay').style.cssText = `
            position:absolute;inset:0;background:rgba(0,0,0,0.9);backdrop-filter:blur(4px);
        `;
        lb.querySelector('.lb-content').style.cssText = `
            position:relative;z-index:1;max-width:90vw;max-height:90vh;text-align:center;
        `;
        const img = lb.querySelector('img');
        img.style.cssText = `
            max-width:100%;max-height:85vh;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,0.5);
        `;
        const closeBtn = lb.querySelector('.lb-close');
        closeBtn.style.cssText = `
            position:absolute;top:-15px;right:-15px;width:40px;height:40px;
            background:#F9A825;border:none;border-radius:50%;cursor:pointer;
            font-size:1.1rem;color:#1B5E20;font-weight:900;z-index:2;
        `;
        const caption = lb.querySelector('.lb-caption');
        if (caption) caption.style.cssText = `
            color:white;margin-top:12px;font-weight:700;font-size:0.95rem;
            font-family:'Nunito',sans-serif;
        `;

        document.body.appendChild(lb);
        document.body.style.overflow = 'hidden';

        lb.querySelector('.lb-overlay').addEventListener('click', () => closeLightbox(lb));
        closeBtn.addEventListener('click', () => closeLightbox(lb));
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeLightbox(lb); });
    }

    function closeLightbox(lb) {
        lb.remove();
        document.body.style.overflow = '';
    }

    // ===== CONTACT FORM =====
    const contactForm = document.querySelector('#form-kontak');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const btn = this.querySelector('.btn-submit');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span>⏳</span> Mengirim...';
            btn.disabled = true;

            const formData = new FormData(this);

            fetch('proses_kontak.php', {
                method: 'POST',
                body: formData
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        showToast('✅ Pesan berhasil terkirim! Kami akan segera menghubungi Anda.', 'success');
                        contactForm.reset();
                    } else {
                        showToast('❌ ' + (data.message || 'Terjadi kesalahan, silakan coba lagi.'), 'error');
                    }
                })
                .catch(() => {
                    showToast('❌ Koneksi gagal. Silakan coba lagi.', 'error');
                })
                .finally(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        });
    }

    // ===== TOAST NOTIFICATION =====
    function showToast(message, type = 'success') {
        const existing = document.querySelector('.toast');
        if (existing) existing.remove();

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <span class="toast-icon">${type === 'success' ? '🎉' : '⚠️'}</span>
                <span class="toast-msg">${message}</span>
            </div>
        `;
        document.body.appendChild(toast);

        setTimeout(() => toast.classList.add('show'), 10);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 400);
        }, 4000);
    }

    // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ===== ADD STAGGER DELAY TO GRID CHILDREN =====
    document.querySelectorAll('.program-grid, .galeri-grid').forEach(grid => {
        grid.querySelectorAll('.animate-on-scroll').forEach((item, i) => {
            item.style.transitionDelay = (i * 0.1) + 's';
        });
    });

    // ===== PARALLAX HERO SHAPES =====
    const shapes = document.querySelectorAll('.shape');
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        shapes.forEach((shape, i) => {
            const speed = 0.05 + i * 0.02;
            shape.style.transform = `translateY(${scrollY * speed}px)`;
        });
    }, { passive: true });

    // ===== FADE IN KEYFRAME FOR GALERI =====
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);

    console.log('🎓 SDN Nusantara Jaya - Website Loaded!');
});

    // ===== MOBILE DROPDOWN TOGGLE (Informasi Only) =====
    const dropdownToggle = document.querySelector('.nav-link-dropdown');
    
    if (dropdownToggle) {
        dropdownToggle.addEventListener('click', function(e) {
            // Hanya aktif di mobile (< 768px)
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const parent = this.parentElement;
                const dropdown = parent.querySelector('.dropdown-menu');
                
                if (dropdown) {
                    dropdown.classList.toggle('open');
                    this.classList.toggle('open');s
                }
            }
        });
    }