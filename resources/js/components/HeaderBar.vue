<template>
    <header class="fixed top-0 left-0 right-0 z-50 pointer-events-none inverted-chrome">
        <div
            class="px-4 sm:px-8 pt-4 sm:pt-6 pb-4 relative flex items-center justify-between w-full text-[11px] tracking-[0.2em] font-sans chrome-font uppercase">
            <!-- Left Edge: Portfolio & Theme Toggle (Desktop) -->
            <div class="flex items-center gap-6 sm:gap-8 pointer-events-auto">
                <a href="#top"
                    class="hidden sm:inline-flex items-center py-2 px-3 -ml-3 cursor-pointer hover:opacity-75 transition-opacity"
                    @click.prevent="scrollToSection('#top')">
                    Portfolio
                </a>
                <button
                    type="button"
                    class="hidden sm:inline-flex items-center py-2 px-3 cursor-pointer hover:opacity-75 transition-opacity select-none"
                    :aria-pressed="isLightMode"
                    @click="toggleTheme"
                >
                    <Transition name="menu-label" mode="out-in">
                        <span :key="themeLabel" class="menu-label">{{ themeLabel }}</span>
                    </Transition>
                </button>
            </div>

            <!-- Mobile Top Center Header Text: Portfolio -->
            <div class="sm:hidden absolute left-1/2 -translate-x-1/2 top-4 flex items-center gap-3">
                <a href="#top"
                    class="inline-flex items-center py-2 px-2 pointer-events-auto cursor-pointer hover:opacity-75 transition-opacity"
                    @click.prevent="scrollToSection('#top')">
                    Portfolio
                </a>
            </div>

            <!-- Center on Desktop, Middle Right Side on Mobile -->
            <div
                class="fixed right-3 sm:right-auto top-1/2 sm:top-auto -translate-y-1/2 sm:translate-y-0 sm:absolute sm:left-1/2 sm:-translate-x-1/2 z-[60]">
                <button type="button"
                    class="menu-toggle pointer-events-auto cursor-pointer hover:opacity-80 transition-all flex items-center justify-center px-4 py-2 sm:px-5 sm:py-2.5 max-sm:px-3 max-sm:py-4 max-sm:border max-sm:border-[var(--border-subtle)] max-sm:bg-[var(--bg)]/90 max-sm:backdrop-blur-xl max-sm:shadow-2xl max-sm:rounded-sm select-none"
                    :aria-expanded="menuOpen" aria-controls="menu-overlay" @click.stop="toggleMenu"
                    @mouseenter="isMenuHover = true" @mouseleave="isMenuHover = false">
                    <Transition name="menu-label" mode="out-in">
                        <span :key="menuLabel"
                            class="menu-label max-sm:[writing-mode:vertical-rl] max-sm:tracking-[0.25em] max-sm:text-[10px] font-mono select-none pointer-events-none">{{
                                menuLabel }}</span>
                    </Transition>
                </button>
            </div>

            <!-- Right Edge: Let's Talk! -->
            <div>
                <a href="#contact"
                    class="hidden sm:inline-flex items-center py-2 px-3 -mr-3 pointer-events-auto cursor-pointer hover:opacity-75 transition-opacity"
                    @click.prevent="scrollToSection('#contact')">
                    Let's Talk!
                </a>
            </div>
        </div>
    </header>

    <!-- Fullscreen Menu Overlay -->
    <div v-show="menuOpen" ref="menuOverlayRef" id="menu-overlay"
        class="menu-overlay fixed inset-0 z-40 bg-[var(--bg)] text-[var(--text)] opacity-0 pointer-events-none">
        <div class="h-full px-4 sm:px-8 pt-20 sm:pt-28 pb-12 sm:pb-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-16">
                <div class="space-y-8">
                    <a href="#top"
                        class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors cursor-pointer pointer-events-auto"
                        @click.prevent="scrollToSection('#top')">
                        Home
                    </a>
                    <a href="#profile"
                        class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors cursor-pointer pointer-events-auto"
                        @click.prevent="scrollToSection('#profile')">
                        Profile
                    </a>
                    <a href="#about"
                        class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors cursor-pointer pointer-events-auto"
                        @click.prevent="scrollToSection('#about')">
                        Tech Stack
                    </a>
                    <a href="#projects"
                        class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors cursor-pointer pointer-events-auto"
                        @click.prevent="scrollToSection('#projects')">
                        Projects
                    </a>
                </div>
                <div class="space-y-8">
                    <a href="#contact"
                        class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors cursor-pointer pointer-events-auto"
                        @click.prevent="scrollToSection('#contact')">
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, nextTick, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useGsap } from '../composables/useGsap';
import { useTheme } from '../composables/useTheme';

const router = useRouter();
const route = useRoute();
const { gsap, prefersReducedMotion } = useGsap();
const { isLightMode, toggleTheme, initTheme } = useTheme();

const menuOpen = ref(false);
const isMenuHover = ref(false);
const menuOverlayRef = ref(null);
const menuLabel = computed(() => (menuOpen.value ? 'CLOSE' : (isMenuHover.value ? 'OPEN' : 'MENU')));
const themeLabel = computed(() => (isLightMode.value ? 'DARK MODE' : 'LIGHT MODE'));

let menuTl = null;

const animateMenuOpen = async () => {
    await nextTick();
    if (!menuOverlayRef.value) return;

    if (prefersReducedMotion()) {
        gsap.set(menuOverlayRef.value, { opacity: 1, pointerEvents: 'auto' });
        return;
    }

    if (menuTl) menuTl.kill();

    const links = menuOverlayRef.value.querySelectorAll('.menu-link-item');
    gsap.set(menuOverlayRef.value, { pointerEvents: 'auto' });

    menuTl = gsap.timeline();
    menuTl.fromTo(
        menuOverlayRef.value,
        { opacity: 0, clipPath: 'polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)' },
        {
            opacity: 1,
            clipPath: 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)',
            duration: 0.5,
            ease: 'power3.inOut',
        }
    ).fromTo(
        links,
        { opacity: 0, y: 35 },
        {
            opacity: 1,
            y: 0,
            duration: 0.4,
            stagger: 0.05,
            ease: 'power3.out',
        },
        '-=0.2'
    );
};

const animateMenuClose = (onCompleteCallback) => {
    if (!menuOverlayRef.value) {
        if (onCompleteCallback) onCompleteCallback();
        return;
    }

    if (prefersReducedMotion()) {
        gsap.set(menuOverlayRef.value, { opacity: 0, pointerEvents: 'none' });
        menuOpen.value = false;
        if (onCompleteCallback) onCompleteCallback();
        return;
    }

    if (menuTl) menuTl.kill();

    const links = menuOverlayRef.value.querySelectorAll('.menu-link-item');

    menuTl = gsap.timeline({
        onComplete: () => {
            gsap.set(menuOverlayRef.value, { pointerEvents: 'none' });
            menuOpen.value = false;
            if (onCompleteCallback) onCompleteCallback();
        }
    });

    menuTl.to(links, {
        opacity: 0,
        y: -15,
        duration: 0.2,
        stagger: 0.02,
        ease: 'power2.in',
    }).to(
        menuOverlayRef.value,
        {
            opacity: 0,
            clipPath: 'polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)',
            duration: 0.35,
            ease: 'power3.inOut',
        },
        '-=0.1'
    );
};

const toggleMenu = () => {
    if (!menuOpen.value) {
        menuOpen.value = true;
        animateMenuOpen();
    } else {
        animateMenuClose();
    }
};

const closeMenu = (callback) => {
    if (menuOpen.value) {
        animateMenuClose(callback);
    } else if (callback) {
        callback();
    }
};

const scrollToSection = (selector) => {
    closeMenu(() => {
        if (route.path !== '/') {
            router.push({ path: '/', hash: selector }).then(() => {
                setTimeout(() => {
                    if (selector === '#top') {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        const el = document.querySelector(selector);
                        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            });
            return;
        }

        if (selector === '#top') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            window.history.replaceState(null, '', selector);
            return;
        }

        const target = document.querySelector(selector);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            window.history.replaceState(null, '', selector);
        }
    });
};

onMounted(() => {
    initTheme();
});

watch(menuOpen, (isOpen) => {
    document.body.style.overflow = isOpen ? 'hidden' : '';
});

onBeforeUnmount(() => {
    document.body.style.overflow = '';
    if (menuTl) menuTl.kill();
});
</script>
