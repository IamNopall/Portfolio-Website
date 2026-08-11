<template>
    <div class="page">
        <HeaderBar />
        <FooterBar />

        <!-- Hero Section: Editorial Typography Anchor -->
        <section
            class="hero-section relative min-h-[100dvh] w-full flex items-center justify-center bg-[var(--bg)] text-[var(--text)] overflow-hidden px-4 sm:px-8"
            id="top">
            <div class="hero-grid-lines absolute inset-0 pointer-events-none opacity-20"></div>

            <!-- Center Massive Display Typography -->
            <h1 ref="heroH1Ref"
                class="absolute left-1/2 top-1/2 font-black tracking-tighter leading-none uppercase z-10 text-center display-font whitespace-nowrap flex items-baseline select-none"
                :style="{
                    fontSize: heroFontSize,
                    transform: 'translate(-50%, -50%)',
                }">
                <span class="greeting-roller" ref="rollerRef">
                    <Transition name="greeting-roll">
                        <span :key="currentGreetingIdx" class="greeting-word">{{
                            greetings[currentGreetingIdx]
                        }}</span>
                    </Transition>
                </span>
            </h1>

            <!-- Structural Metadata Overlay (Editorial Touch) -->
            <div
                class="absolute bottom-12 left-4 sm:left-8 right-4 sm:right-8 flex justify-between items-end text-[10px] tracking-[0.2em] uppercase font-sans text-[var(--muted)] pointer-events-none">
                <div>
                    <span class="block text-[var(--text)] font-semibold mb-1">NAUFAL TSAQIF</span>
                    <span>INFORMATICS · GAME DEV · FRONTEND</span>
                </div>
                <div class="text-right">
                    <span>EXPLORE BELOW</span>
                    <span class="block text-[var(--text)] font-semibold mt-1">↓</span>
                </div>
            </div>

            <!-- Minimalist custom pointer -->
            <div ref="cursorRef" class="minimal-cursor fixed z-50 pointer-events-none"></div>
            <!-- Cursor Follower Dot -->
            <div ref="followerDotRef" class="cursor-follower-dot fixed z-50 pointer-events-none" :style="{
                opacity: 1,
            }"></div>
        </section>

        <!-- Portfolio Profile Section: Asymmetric Typography & Structural Hairlines -->
        <section
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-20 sm:py-32 border-t border-[var(--border-subtle)]"
            id="profile">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex justify-between items-baseline mb-12 sm:mb-20 font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase reveal">
                    <p>01 / PROFILE</p>
                    <p>SPECIALIZATIONS</p>
                </div>

                <!-- Editorial Headline & Copy Layout -->
                <div
                    class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-12 lg:gap-24 border-b border-[var(--border-subtle)] pb-16 sm:pb-28 reveal">
                    <div class="lg:sticky lg:top-32 self-start">
                        <h2
                            class="text-[16vw] md:text-[11vw] lg:text-[7rem] font-black uppercase leading-[0.88] tracking-tighter display-font text-[var(--heading)]">
                            ABOUT<br />ME
                        </h2>
                        <div
                            class="mt-10 flex flex-col gap-3 font-sans text-[10px] tracking-[0.2em] uppercase text-[var(--muted)]">
                            <p class="flex items-center gap-3">
                                <span class="w-6 h-[1px] bg-[var(--border)]"></span>
                                Informatics Engineering
                            </p>
                            <p class="flex items-center gap-3">
                                <span class="w-6 h-[1px] bg-[var(--border)]"></span>
                                Unity 3D Game Developer
                            </p>
                            <p class="flex items-center gap-3">
                                <span class="w-6 h-[1px] bg-[var(--border)]"></span>
                                Frontend & UI/UX Specialist
                            </p>
                        </div>
                    </div>

                    <div class="max-w-3xl lg:pt-4">
                        <h3
                            class="text-3xl md:text-5xl lg:text-[3rem] leading-[1.08] font-normal tracking-tight text-[var(--heading)] display-font">
                            Crafting immersive 3D games and engaging digital experiences.
                        </h3>

                        <div class="mt-12 flex flex-col gap-8">
                            <p class="text-lg md:text-xl leading-[1.6] text-[var(--text-soft)] font-light max-w-[60ch]">
                                Currently an Informatics Engineering student. My primary focus is on developing
                                interactive games using Unity 3D, turning imaginative concepts into engaging gameplay.
                            </p>
                            <p class="text-lg md:text-xl leading-[1.6] text-[var(--text-soft)] font-light max-w-[60ch]">
                                Alongside game development, I also craft intuitive UI/UX and responsive frontend web
                                applications. I love bridging the gap between creative design and technical execution.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tech Stack Section: Typography-first Rows -->
                <div class="grid grid-cols-1 lg:grid-cols-[0.35fr_0.65fr] gap-12 lg:gap-24 pt-16 sm:pt-24 reveal">
                    <div>
                        <p class="font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase mb-4">
                            CAPABILITIES
                        </p>
                        <h3
                            class="text-[12vw] md:text-[7vw] lg:text-[4rem] font-black uppercase leading-[0.88] tracking-tighter display-font text-[var(--heading)]">
                            TOOLS I<br />WORK WITH
                        </h3>
                    </div>

                    <div class="border-t border-[var(--border-subtle)]">
                        <div v-for="group in stackGroups" :key="group.title"
                            class="grid grid-cols-1 md:grid-cols-[0.3fr_0.7fr] gap-4 py-8 border-b border-[var(--border-subtle)] items-baseline">
                            <p class="font-sans text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                {{ group.title }}
                            </p>
                            <div class="flex flex-wrap gap-[0.6rem] sm:gap-3">
                                <span v-for="item in group.items" :key="item.name"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 border border-[var(--border-subtle)] text-[11px] font-sans tracking-[0.1em] uppercase text-[var(--text)] hover:border-[var(--border)] transition-colors">
                                    <img :src="item.iconUrl ??
                                        `https://cdn.simpleicons.org/${item.icon}`
                                        " :alt="`${item.name} icon`"
                                        class="w-3.5 h-3.5 opacity-70 grayscale contrast-125" loading="lazy" />
                                    <span>{{ item.name }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Narrative Section -->
        <section
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-20 sm:py-32 border-t border-[var(--border-subtle)]"
            id="about">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex justify-between items-baseline mb-12 sm:mb-20 font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase reveal">
                    <p>02 / PHILOSOPHY</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[1fr_0.8fr] gap-12 lg:gap-24 items-start reveal">
                    <h2
                        class="text-[11vw] md:text-[5.5vw] font-black uppercase tracking-tighter leading-[0.88] display-font text-[var(--heading)]">
                        DESIGNER INSTINCTS.<br />DEVELOPER PRECISION.
                    </h2>
                    <div class="font-sans text-base leading-relaxed text-[var(--text-soft)]">
                        <p class="mb-10 text-lg sm:text-xl font-light leading-relaxed max-w-[55ch]">
                            I collaborate with visionary teams to craft digital products that feel cinematic yet
                            effortless. My work blends motion, typography, and engineering into experiences that stay
                            clean and fast.
                        </p>
                        <div
                            class="grid grid-cols-2 gap-8 uppercase tracking-[0.18em] text-[10px] font-sans text-[var(--muted)] border-t border-[var(--border-subtle)] pt-8">
                            <ul class="space-y-3">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-[var(--border)]"></span>
                                    Vue.js / Nuxt</li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-[var(--border)]"></span>
                                    Laravel / PHP</li>
                            </ul>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-[var(--border)]"></span>
                                    Unity 3D / C#</li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-[var(--border)]"></span>
                                    Tailwind CSS</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section: Pure Editorial List Layout -->
        <section
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-20 sm:py-32 border-t border-[var(--border-subtle)]"
            id="projects">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex justify-between items-baseline mb-12 sm:mb-20 font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase reveal">
                    <p>03 / SELECTED WORKS</p>
                    <p>{{ filteredProjects.length }} WORKS INDEXED</p>
                </div>

                <div class="mb-12 sm:mb-20 reveal">
                    <h2 class="display-font font-black uppercase leading-[0.88] tracking-tighter text-[var(--heading)]"
                        style="font-size: clamp(3rem, 8vw, 6.5rem);">
                        SELECTED WORKS
                    </h2>
                </div>

                <!-- Category Filters: Hairline Tabs -->
                <div
                    class="flex items-center gap-6 sm:gap-10 overflow-x-auto border-b border-[var(--border-subtle)] mb-0 reveal">
                    <button v-for="cat in projectCategories" :key="cat"
                        class="font-sans text-[10px] tracking-[0.22em] uppercase py-4 transition-colors relative"
                        :class="activeCategory === cat
                            ? 'text-[var(--heading)] font-semibold border-b-2 border-[var(--text)]'
                            : 'text-[var(--muted)] hover:text-[var(--text)]'
                            " @click="activeCategory = cat">
                        {{ cat }}
                        <span class="ml-1 text-[8px] tabular-nums opacity-60">
                            ({{
                                cat === "All"
                                    ? projects.length
                                    : projects.filter((p) => p.category === cat)
                                        .length
                            }})
                        </span>
                    </button>
                </div>

                <!-- Editorial Project Rows (No Cards) -->
                <div>
                    <TransitionGroup name="proj-list" tag="div">
                        <div v-for="(project, i) in filteredProjects" :key="project.title"
                            class="group relative block border-b border-[var(--border-subtle)] py-8 sm:py-12 transition-colors hover:bg-[var(--hover-bg)] cursor-pointer">
                            <div
                                class="grid grid-cols-1 md:grid-cols-[0.08fr_1fr_0.3fr] gap-6 md:gap-12 items-baseline">
                                <span class="font-sans text-[11px] tracking-[0.2em] text-[var(--muted)] tabular-nums">
                                    {{ String(i + 1).padStart(2, "0") }}
                                </span>

                                <div>
                                    <h3
                                        class="display-font font-black uppercase leading-[0.9] tracking-tighter text-[var(--heading)] text-3xl sm:text-5xl lg:text-6xl group-hover:text-[var(--accent-blue)] transition-colors">
                                        {{ project.title }}
                                    </h3>
                                    <p
                                        class="font-sans text-sm tracking-[0.05em] leading-relaxed text-[var(--muted)] mt-3 max-w-[65ch]">
                                        {{ project.desc }}
                                    </p>
                                    <div class="flex flex-wrap gap-2 mt-4">
                                        <span v-for="tag in project.tags" :key="tag"
                                            class="font-sans text-[9px] tracking-[0.18em] uppercase text-[var(--muted)] border border-[var(--border-subtle)] px-2 py-0.5">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>

                                <div
                                    class="flex md:flex-col items-baseline md:items-end justify-between gap-2 font-sans text-[10px] tracking-[0.2em] uppercase text-[var(--muted)]">
                                    <span>{{ project.category }}</span>
                                    <span class="tabular-nums">{{ project.year }}</span>
                                </div>
                            </div>
                        </div>
                    </TransitionGroup>
                </div>
            </div>
        </section>

        <!-- Contact Section: Oversized Editorial Statement -->
        <section
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-24 sm:py-40 border-t border-[var(--border-subtle)] flex flex-col items-center justify-center text-center overflow-hidden"
            id="contact">
            <p class="font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase mb-8 reveal">
                04 / GET IN TOUCH
            </p>
            <a href="mailto:naufaltsq333@gmail.com"
                class="text-[14vw] md:text-[11vw] font-black uppercase tracking-tighter leading-none hover:text-[var(--accent-blue)] transition-colors reveal display-font">
                LET'S TALK
            </a>
            <p class="mt-8 font-sans text-xs tracking-[0.2em] text-[var(--muted)] uppercase reveal">
                naufaltsq333@gmail.com
            </p>
        </section>
    </div>
</template>

<script setup>
import {
    computed,
    nextTick,
    onBeforeUnmount,
    onMounted,
    ref,
    watch,
} from "vue";
import FooterBar from "./components/FooterBar.vue";
import HeaderBar from "./components/HeaderBar.vue";

const cursorRef = ref(null);
const heroH1Ref = ref(null);
const followerDotRef = ref(null);
const followerState = { x: -200, y: -200 };
const followerOffset = { x: 22, y: 22 };
let observer;
let rafId;
let greetingTimer = null;

const greetings = [
    "WELCOME",
    "SELAMAT DATANG",
    "BIENVENUE",
    "WILLKOMMEN",
    "BIENVENIDO",
    "欢迎",
    "ようこそ",
    "환영합니다",
    "BENVENUTO",
    "BEM-VINDO",
    "MERHABA",
];
const currentGreetingIdx = ref(0);

// ── Hero font-size: auto-fit to viewport ──────────────────────────────────────
const rollerRef = ref(null);
const heroFontSize = ref("16vw");

const syncFontSize = () => {
    const text = greetings[currentGreetingIdx.value];

    // Step 1: fast character-weight estimate
    let w = 0;
    for (const ch of text) {
        if (/[\u3040-\u30ff\u4e00-\u9fff\uac00-\ud7af]/.test(ch))
            w += 1.0; // CJK/Hangul
        else if (ch === " ") w += 0.35;
        else w += 0.58; // condensed uppercase Latin
    }
    const estVw = parseFloat(Math.min(16, 88 / w).toFixed(2));
    heroFontSize.value = estVw + "vw";

    // Step 2: validate against the real rendered width after layout
    nextTick(() => {
        requestAnimationFrame(() => {
            if (!rollerRef.value) return;
            const el = heroH1Ref.value ?? rollerRef.value;
            const elWidth = el.offsetWidth;
            const maxWidth = window.innerWidth * 0.9;
            if (elWidth > maxWidth) {
                const corrected = parseFloat(
                    (estVw * (maxWidth / elWidth) * 0.97).toFixed(2),
                );
                heroFontSize.value = corrected + "vw";
            }
        });
    });
};

watch(currentGreetingIdx, syncFontSize);

let resizeTick = false;
const handleResize = () => {
    if (resizeTick) return;
    resizeTick = true;
    requestAnimationFrame(() => {
        syncFontSize();
        resizeTick = false;
    });
};

const stackGroups = [
    {
        title: "Programming",
        items: [
            {
                name: "C#",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/csharp/csharp-original.svg",
            },
            {
                name: "C++",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/cplusplus/cplusplus-original.svg",
            },
            {
                name: "JavaScript",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg",
            },
            {
                name: "PHP",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg",
            },
            {
                name: "HTML",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg",
            },
            {
                name: "CSS",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg",
            },
        ],
    },
    {
        title: "Framework",
        items: [
            {
                name: "Vue.js",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg",
            },
            {
                name: "Laravel",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg",
            },
            {
                name: "Tailwind CSS",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg",
            },
            {
                name: "Unity",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/unity/unity-original.svg",
            },
        ],
    },
    {
        title: "Database",
        items: [
            {
                name: "MySQL",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg",
            },
        ],
    },
    {
        title: "Tools",
        items: [
            {
                name: "Figma",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/figma/figma-original.svg",
            },
            {
                name: "Git",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg",
            },
            {
                name: "GitHub",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg",
            },
            {
                name: "VS Code",
                iconUrl:
                    "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vscode/vscode-original.svg",
            },
        ],
    },
];

const projectCategories = ["All", "Website", "Unity"];
const activeCategory = ref("All");

const projects = [
    {
        title: "Nopal.Dev",
        category: "Website",
        year: "2025",
        desc: "Minimalist portfolio website built with Vue.js and Laravel.",
        tags: ["Vue.js", "Laravel", "Tailwind"],
    },
    {
        title: "TaskFlow",
        category: "Website",
        year: "2024",
        desc: "Collaborative project management app with real-time task tracking.",
        tags: ["Vue.js", "Laravel", "MySQL"],
    },
    {
        title: "ShopSphere",
        category: "Website",
        year: "2024",
        desc: "Full-stack e-commerce platform with inventory and order management.",
        tags: ["Laravel", "Tailwind", "MySQL"],
    },
    {
        title: "Void Walker",
        category: "Unity",
        year: "2024",
        desc: "3D action platformer with fluid movement and physics-based combat.",
        tags: ["Unity", "C#", "Blender"],
    },
    {
        title: "Neon Grid",
        category: "Unity",
        year: "2023",
        desc: "Retro-futuristic arcade puzzle game with neon aesthetic and chiptune audio.",
        tags: ["Unity", "C#"],
    },
    {
        title: "EchoScape",
        category: "Unity",
        year: "2025",
        desc: "Atmospheric first-person horror experience with procedural sound design.",
        tags: ["Unity", "C#", "Blender"],
    },
];

const filteredProjects = computed(() =>
    activeCategory.value === "All"
        ? projects
        : projects.filter((p) => p.category === activeCategory.value),
);

const mousePos = { x: -100, y: -100 };
const cursorState = { x: -100, y: -100 };
const interactiveSelector = 'a, button, [role="button"], .cursor-pointer';

const handleMouseMove = (e) => {
    mousePos.x = e.clientX;
    mousePos.y = e.clientY;
};

const handlePointerOver = (e) => {
    if (e.target.closest(interactiveSelector)) {
        if (cursorRef.value) cursorRef.value.classList.add("is-interactive");
    }
};

const handlePointerOut = (e) => {
    if (e.target.closest(interactiveSelector)) {
        if (cursorRef.value) cursorRef.value.classList.remove("is-interactive");
    }
};

const animateDot = () => {
    const arrowLerp = 0.3;
    cursorState.x += (mousePos.x - cursorState.x) * arrowLerp;
    cursorState.y += (mousePos.y - cursorState.y) * arrowLerp;

    if (cursorRef.value) {
        cursorRef.value.style.transform = `translate3d(${cursorState.x}px, ${cursorState.y}px, 0)`;
    }

    const targetX = mousePos.x + followerOffset.x;
    const targetY = mousePos.y + followerOffset.y;
    const followerLerp = 0.12;
    followerState.x += (targetX - followerState.x) * followerLerp;
    followerState.y += (targetY - followerState.y) * followerLerp;
    if (followerDotRef.value) {
        followerDotRef.value.style.transform = `translate3d(${followerState.x}px, ${followerState.y}px, 0)`;
    }

    rafId = requestAnimationFrame(animateDot);
};

onMounted(async () => {
    window.addEventListener("mousemove", handleMouseMove);
    document.addEventListener("mouseover", handlePointerOver);
    document.addEventListener("mouseout", handlePointerOut);
    animateDot();

    greetingTimer = setInterval(() => {
        currentGreetingIdx.value =
            (currentGreetingIdx.value + 1) % greetings.length;
    }, 2500);

    await document.fonts.ready;
    syncFontSize();
    window.addEventListener("resize", handleResize);
    const elements = Array.from(document.querySelectorAll(".reveal"));
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;

    if (prefersReducedMotion) {
        elements.forEach((el) => el.classList.add("is-visible"));
        return;
    }

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: "0px 0px -10% 0px" },
    );

    elements.forEach((el) => observer.observe(el));
});

onBeforeUnmount(() => {
    window.removeEventListener("mousemove", handleMouseMove);
    document.removeEventListener("mouseover", handlePointerOver);
    document.removeEventListener("mouseout", handlePointerOut);
    window.removeEventListener("resize", handleResize);
    if (rafId) cancelAnimationFrame(rafId);
    if (greetingTimer) clearInterval(greetingTimer);
    if (observer) {
        observer.disconnect();
    }
});
</script>
