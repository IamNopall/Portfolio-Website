<template>
    <div class="page">
        <HeaderBar />
        <FooterBar />
        <!-- Minimalist Typography Hero -->
        <section
            class="hero-section relative min-h-screen w-full flex items-center justify-center bg-[var(--bg)] text-[var(--text)] overflow-hidden"
            id="top">
            <div class="hero-grid-lines absolute inset-0 pointer-events-none"></div>

            <!-- Center Massive Text -->
            <h1 class="absolute left-1/2 top-1/2 text-[16vw] font-black tracking-tight leading-none uppercase z-10 text-center display-font whitespace-nowrap flex items-baseline"
                style="transform: translate(-50%, -50%) scaleY(1.15);">
                NOPAL<span 
                    ref="heroDotRef"
                    class="cursor-pointer transition-all duration-300 inline-block"
                    :class="isFollowerActive
                        ? 'text-[var(--muted)] opacity-40'
                        : (isHeroDotHover
                            ? 'text-[var(--cursor-dot)] [text-shadow:0_0_20px_var(--cursor-dot),0_0_40px_var(--cursor-dot)] brightness-125'
                            : 'text-[var(--cursor-dot)]')"
                    @click="toggleFollowerDot">.</span>
            </h1>


            <!-- Minimalist custom pointer -->
            <div ref="cursorRef" class="minimal-cursor fixed z-50 pointer-events-none"></div>
            <!-- Follower Dot -->
            <div ref="dotRef" class="cursor-follower-dot fixed z-50 pointer-events-none transition-opacity duration-300"
                :style="{ opacity: isFollowerActive ? 1 : 0 }"></div>

        </section>

        <!-- Portfolio Profile Section -->
        <section class="w-full bg-[var(--bg-elev)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]"
            id="profile">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex justify-between items-end mb-20 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[01] Portfolio Profile</p>
                    <p>Tech Stack</p>
                </div>

                <div
                    class="grid grid-cols-1 lg:grid-cols-[0.8fr_1.2fr] gap-12 lg:gap-20 border-b border-[var(--border-subtle)] pb-24 reveal">
                    <div class="lg:sticky lg:top-32 self-start">
                        <h2 class="text-[19vw] md:text-[13vw] lg:text-[8.5vw] font-black uppercase leading-[0.8] tracking-tighter display-font text-[var(--heading)]"
                            style="transform: scaleY(1.08);">
                            ABOUT<br>ME
                        </h2>
                        <div
                            class="mt-12 flex flex-col gap-4 font-sans text-[11px] tracking-[0.18em] uppercase text-[var(--muted)]">
                            <p class="flex items-center gap-4">
                                <span class="w-8 h-[1px] bg-[var(--border-subtle)]"></span>
                                Informatics Engineering
                            </p>
                            <p class="flex items-center gap-4">
                                <span class="w-8 h-[1px] bg-[var(--border-subtle)]"></span>
                                Unity 3D Game Developer
                            </p>
                            <p class="flex items-center gap-4">
                                <span class="w-8 h-[1px] bg-[var(--border-subtle)]"></span>
                                Frontend & UI/UX
                            </p>
                        </div>
                    </div>

                    <div class="max-w-4xl lg:pt-4">
                        <h3
                            class="text-3xl md:text-5xl lg:text-[3.2rem] leading-[1.1] font-medium tracking-tight text-[var(--heading)]">
                            Crafting immersive 3D games and engaging digital experiences.
                        </h3>

                        <div class="mt-14 flex flex-col gap-8">
                            <p class="text-xl md:text-2xl leading-[1.6] text-[var(--text-soft)] font-light">
                                Currently an Informatics Engineering student. My primary focus is on developing
                                interactive games using Unity 3D, turning imaginative concepts into engaging gameplay.
                            </p>
                            <p class="text-xl md:text-2xl leading-[1.6] text-[var(--text-soft)] font-light">
                                Alongside game development, I also craft intuitive UI/UX and responsive frontend web
                                applications. I love bridging the gap between creative design and technical execution.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[0.32fr_0.68fr] gap-12 lg:gap-20 pt-16 reveal">
                    <div>
                        <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase mb-6">Tech Stack
                        </p>
                        <h3 class="text-[14vw] md:text-[8vw] lg:text-[4.8vw] font-black uppercase leading-[0.85] display-font text-[var(--heading)]"
                            style="transform: scaleY(1.08);">
                            TOOLS I<br>WORK WITH
                        </h3>
                    </div>

                    <div class="border-t border-[var(--border-subtle)]">
                        <div v-for="group in stackGroups" :key="group.title"
                            class="grid grid-cols-1 md:grid-cols-[0.32fr_0.68fr] gap-5 py-8 border-b border-[var(--border-subtle)]">
                            <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase pt-2">{{
                                group.title }}</p>
                            <div class="stack-items">
                                <span v-for="item in group.items" :key="item.name" class="stack-item"
                                    :aria-label="item.name">
                                    <img :src="item.iconUrl ?? `https://cdn.simpleicons.org/${item.icon}`"
                                        :alt="`${item.name} icon`" loading="lazy" decoding="async">
                                    <span class="stack-item-label">{{ item.name }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="w-full bg-[var(--bg)] text-[var(--text)] px-8 py-32 border-t border-[var(--border-subtle)]"
            id="about">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex justify-between items-end mb-24 font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase reveal">
                    <p>[02] About</p>
                </div>

                <div class="flex flex-col md:flex-row gap-16 justify-between items-start reveal">
                    <h2 class="text-[12vw] md:text-[6vw] font-black uppercase tracking-tighter leading-[0.85] display-font"
                        style="transform: scaleY(1.1);">
                        DESIGNER<br>INSTINCTS.<br>DEVELOPER<br>PRECISION.
                    </h2>
                    <div class="max-w-md font-sans text-sm leading-relaxed text-[var(--text-soft)] mt-4 md:mt-0">
                        <p class="mb-12 text-base">
                            I collaborate with visionary teams to craft digital products that feel cinematic yet
                            effortless. My work blends motion, typography, and engineering into experiences that stay
                            clean and fast.
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
        <section
            class="w-full bg-[var(--bg-elev)] text-[var(--text)] px-8 py-32 md:py-48 border-t border-[var(--border-subtle)] flex flex-col items-center justify-center text-center overflow-hidden"
            id="contact">
            <p class="font-sans text-[11px] tracking-[0.18em] text-[var(--muted)] uppercase mb-8 reveal">[03] Ready to
                build?</p>
            <a href="mailto:naufaltsq333@gmail.com"
                class="text-[15vw] md:text-[12vw] font-black uppercase tracking-tighter leading-none hover:text-[var(--accent-blue)] transition-colors reveal display-font"
                style="transform: scaleY(1.1);">
                LET'S TALK
            </a>
        </section>

    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import FooterBar from './components/FooterBar.vue';
import HeaderBar from './components/HeaderBar.vue';

const cursorRef = ref(null);
const dotRef = ref(null);
const heroDotRef = ref(null);
let observer;
let rafId;

const isFollowerActive = ref(false);
const isHeroDotHover = ref(false);

const isPointerOnHeroDot = (clientX, clientY) => {
    if (!heroDotRef.value) return false;

    const rect = heroDotRef.value.getBoundingClientRect();
    const dotCenterX = rect.left + rect.width / 2;
    const dotCenterY = rect.bottom - rect.height * 0.16;
    const radius = Math.max(6, Math.min(rect.width * 0.55, rect.height * 0.12));

    const dx = clientX - dotCenterX;
    const dy = clientY - dotCenterY;

    return dx * dx + dy * dy <= radius * radius;
};

const toggleFollowerDot = (e) => {
    if (!isPointerOnHeroDot(e.clientX, e.clientY)) return;

    isFollowerActive.value = !isFollowerActive.value;
    
    if (isFollowerActive.value) {
        const rect = e.target.getBoundingClientRect();
        dotState.x = rect.left + rect.width / 2;
        dotState.y = rect.top + rect.height / 2;
    }
};

const stackGroups = [
    {
        title: 'Programming',
        items: [
            { name: 'C#', icon: 'csharp', iconUrl: 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/csharp/csharp-plain.svg' },
            { name: 'C++', icon: 'cplusplus' },
            { name: 'JavaScript', icon: 'javascript' },
            { name: 'PHP', icon: 'php' },
            { name: 'HTML', icon: 'html5' },
            { name: 'CSS', icon: 'css' },
        ],
    },
    {
        title: 'Framework',
        items: [
            { name: 'Vue.js', icon: 'vuedotjs' },
            { name: 'Laravel', icon: 'laravel' },
            { name: 'Tailwind CSS', icon: 'tailwindcss' },
            { name: 'Unity', icon: 'unity' },
        ],
    },
    {
        title: 'Database',
        items: [
            { name: 'MySQL', icon: 'mysql' },
        ],
    },
    {
        title: 'Tools',
        items: [
            { name: 'Figma', icon: 'figma' },
            { name: 'Git', icon: 'git' },
            { name: 'GitHub', icon: 'github' },
            { name: 'VS Code', icon: 'visualstudiocode', iconUrl: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg' },
            { name: 'Blender', icon: 'blender' },
        ],
    },
];

const mousePos = { x: -100, y: -100 };
const cursorState = { x: -100, y: -100 };
const dotState = { x: -100, y: -100 };
const interactiveSelector = 'a, button, [role="button"], .cursor-pointer';

const handleMouseMove = (e) => {
    mousePos.x = e.clientX;
    mousePos.y = e.clientY;
    isHeroDotHover.value = !isFollowerActive.value && isPointerOnHeroDot(e.clientX, e.clientY);
};

const handlePointerOver = (e) => {
    if (e.target.closest(interactiveSelector)) {
        if (cursorRef.value) cursorRef.value.classList.add('is-interactive');
        if (dotRef.value) dotRef.value.classList.add('is-interactive');
    }
};

const handlePointerOut = (e) => {
    if (e.target.closest(interactiveSelector)) {
        if (cursorRef.value) cursorRef.value.classList.remove('is-interactive');
        if (dotRef.value) dotRef.value.classList.remove('is-interactive');
    }
};

const animateDot = () => {
    // Arrow follows closely
    const arrowLerp = 0.3;
    cursorState.x += (mousePos.x - cursorState.x) * arrowLerp;
    cursorState.y += (mousePos.y - cursorState.y) * arrowLerp;

    if (cursorRef.value) {
        cursorRef.value.style.transform = `translate3d(${cursorState.x}px, ${cursorState.y}px, 0)`;
    }

    // Follower dot follows loosely with offset
    if (isFollowerActive.value) {
        const dotLerp = 0.12;
        const targetX = mousePos.x + 19;
        const targetY = mousePos.y + 20;

        dotState.x += (targetX - dotState.x) * dotLerp;
        dotState.y += (targetY - dotState.y) * dotLerp;

        if (dotRef.value) {
            dotRef.value.style.transform = `translate3d(${dotState.x}px, ${dotState.y}px, 0)`;
        }
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
