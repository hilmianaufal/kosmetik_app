import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { createIcons, icons } from 'lucide';
import Chart from 'chart.js/auto';

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
        { x: -15, opacity: 0 },
        {
            x: 0,
            opacity: 1,
            duration: 0.45,
            stagger: 0.07,
            ease: 'power2.out',
            clearProps: 'opacity,transform'
        }
    );

    gsap.from('.dashboard-title', {
        y: 20,
        opacity: 0,
        duration: 0.6,
        delay: 0.2,
        ease: 'power3.out'
    });

    gsap.fromTo('.stat-card',
        { y: 35, opacity: 0, scale: 0.96 },
        {
            y: 0,
            opacity: 1,
            scale: 1,
            duration: 0.65,
            stagger: 0.1,
            delay: 0.25,
            ease: 'back.out(1.4)',
            clearProps: 'all'
        }
    );
});