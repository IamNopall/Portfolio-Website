<template>
    <header class="fixed top-0 left-0 right-0 z-40 pointer-events-none">
        <div
            class="inverted-chrome px-8 pt-6 pb-4 flex justify-between w-full text-[11px] tracking-[0.18em] font-sans uppercase">
            <div class="flex gap-[18vw]">
                <a href="#top" class="pointer-events-auto cursor-pointer"
                    @click.prevent="scrollToSection('#top')">
                    Nopal Portfolio
                </a>
                <button
                    type="button"
                    class="pointer-events-auto cursor-pointer"
                    :aria-pressed="isLightMode"
                    @click="toggleLightMode"
                >
                    {{ isLightMode ? 'Dark Mode' : 'Light Mode' }}
                </button>
            </div>
            <div class="flex gap-[18vw]">
                <button type="button" class="pointer-events-auto cursor-pointer"
                    :aria-expanded="menuOpen" aria-controls="menu-overlay" @click="toggleMenu">
                    {{ menuOpen ? 'Close' : 'Menu' }}
                </button>
                <a href="#contact" class="pointer-events-auto cursor-pointer"
                    @click.prevent="scrollToSection('#contact')">
                    Let's Talk!
                </a>
            </div>
        </div>
    </header>

    <Transition name="menu-clip">
        <div v-if="menuOpen" id="menu-overlay" class="menu-overlay fixed inset-0 z-30 bg-[var(--bg)] text-[var(--text)]">
            <div class="h-full px-8 pt-28 pb-20">
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16">
                    <div class="space-y-8">
                        <a href="#top"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#top')">
                            Home
                        </a>
                        <a href="#projects"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#projects')">
                            Projects
                        </a>
                        <a href="#case-study"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#case-study')">
                            Case Study
                        </a>
                        <a href="#about"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#about')">
                            About
                        </a>
                    </div>
                    <div class="space-y-8">
                        <a href="#contact"
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font hover:text-[var(--heading)] transition-colors"
                            @click.prevent="scrollToSection('#contact')">
                            Contact
                        </a>
                        <span
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font text-[var(--muted)]">
                            
                        </span>
                        <span
                            class="block text-[12vw] md:text-[6vw] font-black uppercase tracking-tight leading-[0.9] display-font text-[var(--muted)]">
                           
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';

const menuOpen = ref(false);
const isLightMode = ref(false);

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
