<template>
    <div class="page">
        <HeaderBar />
        <FooterBar />
        <!-- Minimalist Typography Hero -->
        <section class="hero-section relative min-h-screen w-full flex items-center justify-center bg-[var(--bg)] text-[var(--text)] overflow-hidden" id="top">
            <!-- Center Massive Text -->
            <h1 class="absolute left-1/2 top-1/2 text-[16vw] font-black tracking-tight leading-none uppercase z-10 text-center display-font" style="transform: translate(-50%, -50%) scaleY(1.15);">
                NOPAL<span class="text-[var(--cursor-dot)]">.</span>
            </h1>

            <!-- Minimalist custom pointer -->
            <div ref="dotRef" class="minimal-cursor fixed z-50 pointer-events-none"></div>

        </section>

        <!-- Portfolio Profile Section -->
        <section class="w-full bg-[var(--bg-elev)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]" id="case-study">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-20 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[01] Portfolio Profile</p>
                    <p>UI/UX / Frontend / Unity Game</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[1.25fr_0.75fr] gap-16 lg:gap-24 items-end border-b border-[var(--border-subtle)] pb-20 reveal">
                    <h2 class="text-[18vw] md:text-[13vw] lg:text-[10vw] font-black uppercase leading-[0.78] display-font text-[var(--heading)]" style="transform: scaleY(1.08);">
                        PORT<br>FOLIO
                    </h2>

                    <p class="text-2xl md:text-4xl lg:text-5xl leading-[1.05] text-[var(--text-soft)] max-w-2xl">
                        A personal digital space built around sharp interface design, clean frontend execution, and interactive game thinking.
                    </p>
                </div>

                <div class="reveal">
                    <div class="group grid grid-cols-1 lg:grid-cols-[0.18fr_0.52fr_0.3fr] gap-6 lg:gap-10 items-end py-12 border-b border-[var(--border-subtle)]">
                        <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase">01</p>
                        <h3 class="text-[17vw] md:text-[10vw] lg:text-[6.8vw] font-black uppercase leading-[0.82] display-font text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors" style="transform: scaleY(1.08);">
                            UI/UX
                        </h3>
                        <p class="text-lg md:text-xl text-[var(--text-soft)] leading-relaxed lg:pb-3">
                            Designing clear flows, strong hierarchy, and interfaces that feel simple without losing character.
                        </p>
                    </div>

                    <div class="group grid grid-cols-1 lg:grid-cols-[0.18fr_0.52fr_0.3fr] gap-6 lg:gap-10 items-end py-12 border-b border-[var(--border-subtle)]">
                        <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase">02</p>
                        <h3 class="text-[17vw] md:text-[10vw] lg:text-[6.8vw] font-black uppercase leading-[0.82] display-font text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors" style="transform: scaleY(1.08);">
                            FRONTEND
                        </h3>
                        <p class="text-lg md:text-xl text-[var(--text-soft)] leading-relaxed lg:pb-3">
                            Building responsive web experiences with Vue, Laravel, Tailwind, and smooth interaction details.
                        </p>
                    </div>

                    <div class="group grid grid-cols-1 lg:grid-cols-[0.18fr_0.52fr_0.3fr] gap-6 lg:gap-10 items-end py-12 border-b border-[var(--border-subtle)]">
                        <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase">03</p>
                        <h3 class="text-[17vw] md:text-[10vw] lg:text-[6.8vw] font-black uppercase leading-[0.82] display-font text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors" style="transform: scaleY(1.08);">
                            UNITY GAME
                        </h3>
                        <p class="text-lg md:text-xl text-[var(--text-soft)] leading-relaxed lg:pb-3">
                            Creating real-time gameplay, 3D scenes, and interactive systems with a designer's sense of feel.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="w-full bg-[var(--bg)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]" id="projects">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-24 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[02] Portfolio List</p>
                    <p>Dummy projects</p>
                </div>
                
                <div class="flex flex-col border-b border-[var(--border-subtle)]">
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal overflow-hidden">
                        <h2 class="relative z-10 text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Portfolio Website
                        </h2>
                        <div class="portfolio-preview absolute inset-0 overflow-hidden bg-[var(--bg)] opacity-0">
                            <img :src="'/img/project-dashboard.png'" alt="" class="h-full w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0">
                        </div>
                        <p class="relative z-10 font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">UI/UX / Vue / Laravel</p>
                    </div>
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal overflow-hidden">
                        <h2 class="relative z-10 text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Mobile App UI
                        </h2>
                        <div class="portfolio-preview absolute inset-0 overflow-hidden bg-[var(--bg)] opacity-0">
                            <img :src="'/img/project-mobile.png'" alt="" class="h-full w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0">
                        </div>
                        <p class="relative z-10 font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">Figma / Prototype / UX Flow</p>
                    </div>
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal overflow-hidden">
                        <h2 class="relative z-10 text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Unity Adventure
                        </h2>
                        <div class="portfolio-preview absolute inset-0 overflow-hidden bg-[var(--bg)] opacity-0">
                            <img :src="'/img/project-game.png'" alt="" class="h-full w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0">
                        </div>
                        <p class="relative z-10 font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">Unity / C# / 3D Game</p>
                    </div>
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal overflow-hidden">
                        <h2 class="relative z-10 text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Dashboard UI
                        </h2>
                        <div class="portfolio-preview absolute inset-0 overflow-hidden bg-[var(--bg)] opacity-0">
                            <img :src="'/img/project-ecommerce.png'" alt="" class="h-full w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0">
                        </div>
                        <p class="relative z-10 font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">Frontend / Admin Panel</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="w-full bg-[var(--bg)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]" id="about">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-24 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[03] About</p>
                </div>

                <div class="flex flex-col md:flex-row gap-16 justify-between items-start reveal">
                    <h2 class="text-[12vw] md:text-[6vw] font-black uppercase tracking-tighter leading-[0.85] display-font" style="transform: scaleY(1.1);">
                        DESIGNER<br>INSTINCTS.<br>DEVELOPER<br>PRECISION.
                    </h2>
                    <div class="max-w-md font-sans text-sm leading-relaxed text-[var(--text-soft)] mt-4 md:mt-0">
                        <p class="mb-12 text-base">
                            I collaborate with visionary teams to craft digital products that feel cinematic yet effortless. My work blends motion, typography, and engineering into experiences that stay clean and fast.
                        </p>
                        <div class="flex gap-16 uppercase tracking-[0.16em] text-[11px] font-sans">
                            <ul class="space-y-4">
                                <li>Vue</li>
                                <li>Laravel</li>
                            </ul>
                            <ul class="space-y-4">
                                <li>GSAP</li>
                                <li>Tailwind</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="w-full bg-[var(--bg-elev)] text-[var(--text)] px-8 py-32 md:py-48 border-t border-[var(--border-subtle)] flex flex-col items-center justify-center text-center overflow-hidden" id="contact">
            <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase mb-8 reveal">[04] Ready to build?</p>
            <a href="mailto:naufaltsq333@gmail.com" class="text-[15vw] md:text-[12vw] font-black uppercase tracking-tighter leading-none hover:text-[var(--accent-blue)] transition-colors reveal display-font" style="transform: scaleY(1.1);">
                LET'S TALK
            </a>
        </section>

    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import FooterBar from './components/FooterBar.vue';
import HeaderBar from './components/HeaderBar.vue';

const dotRef = ref(null);
let observer;
let rafId;

const mousePos = { x: -100, y: -100 };
const dotPos = { x: -100, y: -100 };
const interactiveSelector = 'a, button, [role="button"], .cursor-pointer';

const handleMouseMove = (e) => {
    mousePos.x = e.clientX;
    mousePos.y = e.clientY;
};

const handlePointerOver = (e) => {
    if (dotRef.value && e.target.closest(interactiveSelector)) {
        dotRef.value.classList.add('is-interactive');
    }
};

const handlePointerOut = (e) => {
    if (dotRef.value && e.target.closest(interactiveSelector)) {
        dotRef.value.classList.remove('is-interactive');
    }
};

const animateDot = () => {
    // Smooth lerp follow
    const lerp = 0.15;
    dotPos.x += (mousePos.x - dotPos.x) * lerp;
    dotPos.y += (mousePos.y - dotPos.y) * lerp;

    if (dotRef.value) {
        dotRef.value.style.transform = `translate3d(${dotPos.x}px, ${dotPos.y}px, 0)`;
    }
    rafId = requestAnimationFrame(animateDot);
};

onMounted(() => {
    window.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseover', handlePointerOver);
    document.addEventListener('mouseout', handlePointerOut);
    animateDot();
    const elements = Array.from(document.querySelectorAll('.reveal'));
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        elements.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -10% 0px' }
    );

    elements.forEach((el) => observer.observe(el));
});

onBeforeUnmount(() => {
    window.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseover', handlePointerOver);
    document.removeEventListener('mouseout', handlePointerOut);
    if (rafId) cancelAnimationFrame(rafId);
    if (observer) {
        observer.disconnect();
    }
});
</script>
