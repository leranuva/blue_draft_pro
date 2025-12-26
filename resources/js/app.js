import './bootstrap';
import Alpine from 'alpinejs';
import { animate, scroll, inView } from '@motionone/dom';

// Detección automática del tema del sistema
(function() {
    'use strict';
    
    // Función para detectar y aplicar el tema del sistema
    function applySystemTheme() {
        const html = document.documentElement;
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (prefersDark) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
    }
    
    // Aplicar tema inicial
    applySystemTheme();
    
    // Escuchar cambios en la preferencia del sistema
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applySystemTheme);
})();

// Inicializar Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Animaciones de scroll reveal
document.addEventListener('DOMContentLoaded', function() {
    // Animar elementos al entrar en vista
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animate(
                    entry.target,
                    { opacity: [0, 1], transform: ['translateY(30px)', 'translateY(0)'] },
                    { duration: 0.6, easing: 'ease-out' }
                );
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observar elementos con clase 'reveal'
    document.querySelectorAll('.reveal').forEach(el => {
        observer.observe(el);
    });

    // Animación para cards de proyectos
    document.querySelectorAll('.project-card').forEach((card, index) => {
        observer.observe(card);
        card.style.transitionDelay = `${index * 0.1}s`;
    });
});

// Smooth scroll mejorado
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offsetTop = target.offsetTop - 80;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// Cerrar menú móvil al hacer scroll (opcional - puede ser molesto para algunos usuarios)
// Descomenta si quieres que el menú se cierre automáticamente al hacer scroll
/*
document.addEventListener('DOMContentLoaded', function() {
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (Math.abs(scrollTop - lastScrollTop) > 50) {
            // Disparar evento para cerrar menú
            const event = new CustomEvent('close-mobile-menu');
            window.dispatchEvent(event);
        }
        lastScrollTop = scrollTop;
    });
});
*/
