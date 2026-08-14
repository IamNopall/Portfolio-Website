<template>
    <header class="fixed top-0 left-0 right-0 z-40 pointer-events-none inverted-chrome">
        <div
            class="px-4 sm:px-8 pt-5 sm:pt-6 pb-4 relative flex items-center justify-between w-full text-[11px] tracking-[0.2em] font-sans chrome-font uppercase">
            <!-- Left Edge: Portfolio (Desktop) -->
            <div>
                <a href="#top"
                    class="hidden sm:inline-block pointer-events-auto cursor-pointer hover:opacity-75 transition-opacity"
                    @click.prevent="scrollToSection('#top')">
                    Portfolio
                </a>
            </div>

            <!-- Mobile Top Center Header Text: Portfolio -->
            <div class="sm:hidden absolute left-1/2 -translate-x-1/2 top-5">
                <a href="#top"
                    class="pointer-events-auto cursor-pointer hover:opacity-75 transition-opacity"
                    @click.prevent="scrollToSection('#top')">
                    Portfolio
                </a>
            </div>

            <!-- Center on Desktop, Middle Right Side on Mobile -->
            <div
                class="fixed right-3 sm:right-auto top-1/2 sm:top-auto -translate-y-1/2 sm:translate-y-0 sm:absolute sm:left-1/2 sm:-translate-x-1/2 z-50">
                <button type="button"
                    class="menu-toggle pointer-events-auto cursor-pointer hover:opacity-80 transition-all flex items-center justify-center max-sm:px-2.5 max-sm:py-4 max-sm:border max-sm:border-[var(--border-subtle)] max-sm:bg-[var(--bg)]/90 max-sm:backdrop-blur-xl max-sm:shadow-2xl max-sm:rounded-sm"
                    :aria-expanded="menuOpen" aria-controls="menu-overlay" @click="toggleMenu"
                    @mouseenter="isMenuHover = true" @mouseleave="isMenuHover = false">
                    <Transition name="menu-label" mode="out-in">
                        <span :key="menuLabel"
                            class="menu-label max-sm:[writing-mode:vertical-rl] max-sm:tracking-[0.25em] max-sm:text-[10px] font-mono select-none">{{
                                menuLabel }}</span>
                    </Transition>
                </button>
            </div>

            <!-- Right Edge: Let's Talk! -->
            <div>
                <a href="#contact"
                    class="hidden sm:inline-block pointer-events-auto cursor-pointer hover:opacity-75 transition-opacity"
                    @click.prevent="scrollToSection('#contact')">
                    Let's Talk!
                </a>
            </div>
        </div>
    </header>

    <Transition name="menu-clip">
        <div v-if="menuOpen" id="menu-overlay"
            class="menu-overlay fixed inset-0 z-30 bg-[var(--bg)] text-[var(--text)]">
            <div class="h-full px-4 sm:px-8 pt-20 sm:pt-28 pb-12 sm:pb-20">
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-16">
                    <div class="space-y-8">
                        <a href="#top"
                            class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors"
                            @click.prevent="scrollToSection('#top')">
                            Home
                        </a>
                        <a href="#profile"
                            class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors"
                            @click.prevent="scrollToSection('#profile')">
                            Profile
                        </a>
                        <a href="#about"
                            class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors"
                            @click.prevent="scrollToSection('#about')">
                            Tech Stack
                        </a>
                        <a href="#projects"
                            class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors"
                            @click.prevent="scrollToSection('#projects')">
                            Projects
                        </a>
                    </div>
                    <div class="space-y-8">
                        <a href="#contact"
                            class="menu-link-item block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--accent-blue)] transition-colors"
                            @click.prevent="scrollToSection('#contact')">
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const router = useRouter();
const route = useRoute();

const menuOpen = ref(false);
const isMenuHover = ref(false);
const menuLabel = computed(() => (menuOpen.value ? 'CLOSE' : (isMenuHover.value ? 'OPEN' : 'MENU')));

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
};

const closeMenu = () => {
    menuOpen.value = false;
};

const scrollToSection = (selector) => {
    closeMenu();

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
};

onMounted(() => {
    // Force dark mode
    document.documentElement.classList.remove('light-mode');
    localStorage.setItem('theme', 'dark');
});

watch(menuOpen, (isOpen) => {
    document.body.style.overflow = isOpen ? 'hidden' : '';
});

onBeforeUnmount(() => {
    document.body.style.overflow = '';
    document.documentElement.classList.remove('light-mode');
});
</script>
