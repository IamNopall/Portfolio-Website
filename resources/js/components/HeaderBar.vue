<template>
    <header class="fixed top-0 left-0 right-0 z-40 pointer-events-none inverted-chrome">
        <div
            class="px-4 sm:px-8 pt-5 sm:pt-6 pb-4 flex items-center justify-between w-full text-[11px] tracking-[0.18em] font-sans chrome-font uppercase">
            <div class="flex items-center gap-6 sm:gap-[12vw] md:gap-[18vw]">
                <a href="#top" class="hidden sm:inline-block pointer-events-auto cursor-pointer"
                    @click.prevent="scrollToSection('#top')">
                    Portfolio
                </a>
                <button
                    type="button"
                    class="pointer-events-auto cursor-pointer"
                    :aria-pressed="isLightMode"
                    @click="toggleLightMode"
                >
                    <Transition name="menu-label" mode="out-in">
                        <span :key="themeLabel" class="menu-label">{{ themeLabel }}</span>
                    </Transition>
                </button>
            </div>
            <div class="flex items-center gap-6 sm:gap-[12vw] md:gap-[18vw]">
                <button type="button" class="menu-toggle pointer-events-auto cursor-pointer"
                    :aria-expanded="menuOpen" aria-controls="menu-overlay" @click="toggleMenu"
                    @mouseenter="isMenuHover = true" @mouseleave="isMenuHover = false">
                    <Transition name="menu-label" mode="out-in">
                        <span :key="menuLabel" class="menu-label">{{ menuLabel }}</span>
                    </Transition>
                </button>
                <a href="#contact" class="hidden sm:inline-block pointer-events-auto cursor-pointer"
                    @click.prevent="scrollToSection('#contact')">
                    Let's Talk!
                </a>
            </div>
        </div>
    </header>

    <Transition name="menu-clip">
        <div v-if="menuOpen" id="menu-overlay" class="menu-overlay fixed inset-0 z-30 bg-[var(--bg)] text-[var(--text)]">
            <div class="h-full px-4 sm:px-8 pt-20 sm:pt-28 pb-12 sm:pb-20">
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-16">
                    <div class="space-y-8">
                        <a href="#top"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#top')">
                            Home
                        </a>
                        <a href="#profile"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#profile')">
                            Profile
                        </a>
                        <a href="#about"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#about')">
                            About
                        </a>
                        <a href="#projects"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#projects')">
                            Projects
                        </a>
                    </div>
                    <div class="space-y-8">
                        <a href="#contact"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
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

const menuOpen = ref(false);
const isLightMode = ref(false);
const isMenuHover = ref(false);
const menuLabel = computed(() => (menuOpen.value ? 'CLOSE' : (isMenuHover.value ? 'OPEN' : 'MENU')));
const themeLabel = computed(() => (isLightMode.value ? 'DARK MODE' : 'LIGHT MODE'));

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
};

const closeMenu = () => {
    menuOpen.value = false;
};

const scrollToSection = (selector) => {
    closeMenu();

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

const applyTheme = () => {
    document.documentElement.classList.toggle('light-mode', isLightMode.value);
    localStorage.setItem('theme', isLightMode.value ? 'light' : 'dark');
};

const toggleLightMode = () => {
    isLightMode.value = !isLightMode.value;
    applyTheme();
};

onMounted(() => {
    isLightMode.value = localStorage.getItem('theme') === 'light';
    applyTheme();
});

watch(menuOpen, (isOpen) => {
    document.body.style.overflow = isOpen ? 'hidden' : '';
});

onBeforeUnmount(() => {
    document.body.style.overflow = '';
    document.documentElement.classList.remove('light-mode');
});
</script>
