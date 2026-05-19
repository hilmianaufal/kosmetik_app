import './bootstrap';
import '../css/app.css';
import './pos';

import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { createIcons, icons } from 'lucide';
import Chart from 'chart.js/auto';
import { Html5Qrcode } from "html5-qrcode";

window.Html5Qrcode = Html5Qrcode;
window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });

    gsap.from('.sidebar-brand', {
        y: -20,
        opacity: 0,
        duration: 0.7,
        ease: 'back.out(1.7)',
    });

    gsap.fromTo('.menu-item',
        { x: -18, opacity: 0 },
        {
            x: 0,
            opacity: 1,
            duration: 0.45,
            stagger: 0.06,
            ease: 'power3.out',
            clearProps: 'all'
        }
    );

    gsap.from('.dashboard-title, h1', {
        y: 24,
        opacity: 0,
        duration: 0.7,
        ease: 'power3.out',
    });

    gsap.from('.page-subtitle, p.text-gray-500', {
        y: 16,
        opacity: 0,
        duration: 0.6,
        delay: 0.12,
        ease: 'power3.out',
    });

    gsap.fromTo('.stat-card, .bg-white, .bg-white\\/90, .bg-white\\/80',
        {
            y: 35,
            opacity: 0,
            scale: 0.96,
            filter: 'blur(8px)',
        },
        {
            y: 0,
            opacity: 1,
            scale: 1,
            filter: 'blur(0px)',
            duration: 0.75,
            stagger: 0.08,
            delay: 0.18,
            ease: 'power4.out',
            clearProps: 'all'
        }
    );

    gsap.from('table tbody tr', {
        y: 18,
        opacity: 0,
        duration: 0.45,
        stagger: 0.045,
        delay: 0.25,
        ease: 'power3.out',
        clearProps: 'all'
    });

    gsap.from('form input, form select, form button, textarea', {
        y: 18,
        opacity: 0,
        duration: 0.45,
        stagger: 0.05,
        delay: 0.2,
        ease: 'power3.out',
        clearProps: 'all'
    });

    gsap.from('.cart-panel', {
        x: 40,
        opacity: 0,
        duration: 0.8,
        delay: 0.25,
        ease: 'power4.out',
        clearProps: 'all'
    });

    gsap.from('.sidebar-brand img', {
    scale: 0.7,
    rotate: -10,
    opacity: 0,
    duration: 1,
    ease: 'elastic.out(1, 0.5)',
    });

    gsap.from('img[alt="Logo"]', {
        y: -20,
        scale: 0.8,
        duration: 1,
        ease: 'back.out(2)',
    });

gsap.fromTo('.logo-glow',
    {
        scale: 0.85,
        rotate: -4,
    },
    {
        scale: 1,
        rotate: 0,
        duration: 0.9,
        ease: 'elastic.out(1, 0.5)',
        clearProps: 'transform'
    }
);

});
