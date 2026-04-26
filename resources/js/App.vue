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

        <!-- Projects Section -->
        <section class="w-full bg-[var(--bg)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]" id="projects">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-24 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[01] Selected Work</p>
                    <p>Scroll to explore</p>
                </div>
                
                <div class="flex flex-col border-b border-[var(--border-subtle)]">
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal">
                        <h2 class="text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Lumen OS
                        </h2>
                        <p class="font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">Vue / GSAP</p>
                    </div>
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal">
                        <h2 class="text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Atlas Commerce
                        </h2>
                        <p class="font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">Laravel</p>
                    </div>
                    <!-- Project Item -->
                    <div class="group relative py-12 border-t border-[var(--border-subtle)] flex flex-col md:flex-row md:justify-between md:items-center cursor-pointer hover:bg-[var(--hover-bg)] transition-colors reveal">
                        <h2 class="text-[10vw] md:text-[6vw] font-black uppercase tracking-tighter leading-none text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors display-font" style="transform: scaleY(1.1);">
                            Arcadia XR
                        </h2>
                        <p class="font-sans text-xs tracking-[0.16em] uppercase text-[var(--muted)] mt-4 md:mt-0 opacity-50 group-hover:opacity-100 transition-opacity">WebGL</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Case Study Section -->
        <section class="w-full bg-[var(--bg-elev)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]" id="case-study">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-24 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[02] Case Study</p>
                    <p>NovaPay</p>
                </div>

                <h2 class="text-3xl md:text-5xl lg:text-7xl font-medium tracking-tight mb-24 max-w-5xl leading-[1.1] reveal">
                    NovaPay onboarding rebuilt for clarity. Full-funnel experience design that reduced drop-offs while keeping the premium tone.
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-t border-[var(--border-subtle)] pt-12 reveal">
                    <div>
                        <p class="font-sans text-[11px] tracking-[0.16em] text-[var(--muted)] uppercase mb-4">Problem</p>
                        <p class="text-lg text-[var(--text-soft)] leading-relaxed">Dense onboarding dropped user trust within the first minute.</p>
                    </div>
                    <div>
                        <p class="font-sans text-[11px] tracking-[0.16em] text-[var(--muted)] uppercase mb-4">Solution</p>
                        <p class="text-lg text-[var(--text-soft)] leading-relaxed">Guided narrative with clear progress cues and calm animations.</p>
                    </div>
                    <div>
                        <p class="font-sans text-[11px] tracking-[0.16em] text-[var(--muted)] uppercase mb-4">Process</p>
                        <p class="text-lg text-[var(--text-soft)] leading-relaxed">Rapid prototyping, motion studies, and usability labs.</p>
                    </div>
                    <div>
                        <p class="font-sans text-[11px] tracking-[0.16em] text-[var(--muted)] uppercase mb-4">Result</p>
                        <p class="text-5xl md:text-7xl font-black tracking-tighter text-[var(--accent-blue)] display-font" style="transform: scaleY(1.1);">+42%</p>
                        <p class="text-sm text-[var(--muted)] mt-4">Completion rate lift</p>
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
