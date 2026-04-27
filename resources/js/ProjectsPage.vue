<template>
    <div id="top" class="projects-page">
        <header class="projects-topbar">
            <a href="/" class="projects-mark" aria-label="Back to home">
                <span>NP</span>
            </a>

            <nav class="projects-nav" aria-label="Projects navigation">
                <a href="/#profile">Talents</a>
                <a href="/projects" class="is-active">Projects</a>
                <a href="/#about">Services</a>
                <a href="/#profile">Insights</a>
                <a href="/#contact">Contact</a>
            </nav>
        </header>

        <main class="projects-stage">
            <Projects />
        </main>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted } from 'vue';
import Projects from './pages/Projects.vue';

onMounted(() => {
    document.body.style.overflow = 'auto';
    document.documentElement.classList.add('projects-native-cursor');
    document.body.classList.add('projects-native-cursor');
});

onBeforeUnmount(() => {
    document.body.style.overflow = '';
    document.documentElement.classList.remove('projects-native-cursor');
    document.body.classList.remove('projects-native-cursor');
});
</script>

<style scoped>
.projects-page {
    min-height: 100vh;
    background: radial-gradient(circle at 88% 20%, rgba(239, 166, 180, 0.34), transparent 44%),
        radial-gradient(circle at 72% 78%, rgba(176, 166, 206, 0.24), transparent 46%),
        #efefef;
    color: #101010;
    overflow: hidden;
}

.projects-topbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 40;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.2rem;
    padding: 1.2rem clamp(1rem, 2.4vw, 2.4rem) 1rem;
}

.projects-mark {
    width: 2.8rem;
    aspect-ratio: 1;
    border-radius: 999px;
    border: 1.5px solid rgba(16, 16, 16, 0.7);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Barlow', ui-sans-serif, system-ui, sans-serif;
    font-size: 0.63rem;
    font-weight: 700;
    letter-spacing: 0.17em;
    text-transform: uppercase;
    color: #111111;
    background: rgba(255, 255, 255, 0.58);
    backdrop-filter: blur(10px);
    transition: transform 0.22s ease;
}

.projects-mark:hover {
    transform: translateY(-1px);
}

.projects-nav {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: clamp(1rem, 4.8vw, 5.2rem);
    width: 100%;
    font-family: 'Barlow', ui-sans-serif, system-ui, sans-serif;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
}

.projects-nav a {
    color: rgba(20, 20, 20, 0.72);
    transition: color 0.2s ease, opacity 0.2s ease;
}

.projects-nav a:hover,
.projects-nav a.is-active {
    color: #080808;
}

.projects-stage {
    height: 100vh;
    box-sizing: border-box;
    padding-top: 4.7rem;
    padding-bottom: 1.2rem;
    overflow: hidden;
}

:global(html.projects-native-cursor),
:global(body.projects-native-cursor),
:global(body.projects-native-cursor *) {
    cursor: default;
}

@media (max-width: 900px) {
    .projects-topbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.7rem;
        padding-top: 0.9rem;
    }

    .projects-nav {
        width: 100%;
        overflow-x: auto;
        justify-content: flex-start;
        padding-bottom: 0.35rem;
    }

    .projects-stage {
        padding-top: 5.8rem;
    }
}

@media (max-width: 640px) {
    .projects-mark {
        width: 2.45rem;
    }

    .projects-nav {
        gap: 1.3rem;
        font-size: 0.62rem;
    }
}
</style>
