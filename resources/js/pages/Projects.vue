<template>
    <section id="projects" class="projects-showcase" @wheel.prevent="handleSectionWheel">
        <div class="projects-layout">
            <div class="projects-text-column">
                <p class="projects-kicker">[01] Selected Projects</p>

                <div class="projects-list-shell">
                    <div class="projects-focus-line"></div>

                    <div ref="listRef" class="projects-list" @scroll="handleListScroll">
                        <button
                            v-for="(entry, index) in renderedProjects"
                            :key="entry.key"
                            :ref="(element) => setItemRef(element, index)"
                            type="button"
                            class="projects-item"
                            :class="{ 'is-active': activeRenderedIndex === index }"
                            @click="selectProject(entry.sourceIndex)">
                            <span class="projects-item-title">{{ entry.project.title }}</span>
                        </button>
                    </div>
                </div>

                <div class="projects-detail">
                    <p class="projects-preview-category">{{ activeProject.category }}</p>
                    <h2 class="projects-preview-title">{{ activeProject.title }}</h2>
                    <p class="projects-preview-description">{{ activeProject.description }}</p>
                </div>
            </div>

            <aside class="projects-visual-column">
                <ul class="projects-faint-list" aria-hidden="true">
                    <li
                        v-for="project in projects"
                        :key="`faint-${project.title}`"
                        :class="{ 'is-active': project.title === activeProject.title }">
                        {{ project.category }}
                    </li>
                </ul>

                <div class="projects-accent-frame">
                    <Transition name="visual-swap" mode="out-in">
                        <img
                            :key="activeProject.accentImage"
                            :src="activeProject.accentImage"
                            :alt="`${activeProject.title} accent`"
                            class="projects-accent-image"
                            loading="lazy"
                            decoding="async">
                    </Transition>
                </div>

                <div class="projects-main-frame">
                    <Transition name="visual-swap" mode="out-in">
                        <img
                            :key="activeProject.image"
                            :src="activeProject.image"
                            :alt="activeProject.title"
                            class="projects-main-image"
                            loading="lazy"
                            decoding="async">
                    </Transition>
                </div>
            </aside>
        </div>
    </section>
</template>

<script setup>
import { computed, nextTick, onBeforeUnmount, onMounted, ref } from 'vue';

const projects = [
    {
        title: 'DIOR ADDICT',
        category: 'Luxury Content Factory',
        description: 'Direction, editing, and delivery pipeline for product-first social campaigns in high cadence.',
        image: '/img/project-ecommerce.png',
        accentImage: '/img/project-mobile.png',
    },
    {
        title: 'DIOR SAUVAGE',
        category: 'Global Product Reveal',
        description: 'Hero landing + paid campaign visuals with storytelling rhythm tailored for cross-device launch.',
        image: '/img/project-dashboard.png',
        accentImage: '/img/project-ecommerce.png',
    },
    {
        title: 'DIOR XMAS',
        category: 'Seasonal Experience',
        description: 'Interactive storytelling and motion language for a festive digital flagship moment.',
        image: '/img/project-game.png',
        accentImage: '/img/project-dashboard.png',
    },
    {
        title: 'ROUGE STUDIO',
        category: 'Editorial Interface',
        description: 'Minimal editorial UI that balances product storytelling with ultra-bold typographic anchors.',
        image: '/img/project-mobile.png',
        accentImage: '/img/project-game.png',
    },
    {
        title: 'MIDNIGHT SKIN',
        category: 'Campaign Microsite',
        description: 'Single-purpose product launch page optimized for smooth scroll narrative and fast conversion.',
        image: '/img/project-ecommerce.png',
        accentImage: '/img/project-dashboard.png',
    },
    {
        title: 'NOIR ATELIER',
        category: 'Commerce Experience',
        description: 'High fidelity storefront concept with modular templates for seasonal product drops.',
        image: '/img/project-dashboard.png',
        accentImage: '/img/project-mobile.png',
    },
];

const listRef = ref(null);
const itemRefs = ref([]);
const activeIndex = ref(0);
const activeRenderedIndex = ref(projects.length);
let isTicking = false;
const LOOP_COPIES = 3;
const middleCopyOffset = projects.length;
const renderedProjects = Array.from({ length: LOOP_COPIES }).flatMap((_, copyIndex) =>
    projects.map((project, sourceIndex) => ({
        key: `${copyIndex}-${project.title}-${sourceIndex}`,
        copyIndex,
        sourceIndex,
        project,
    }))
);

const activeProject = computed(() => projects[activeIndex.value]);

const setItemRef = (element, index) => {
    if (element) itemRefs.value[index] = element;
};

const scrollToIndex = (index, behavior = 'smooth') => {
    const renderedIndex = middleCopyOffset + index;
    scrollToRenderedIndex(renderedIndex, behavior);
};

const scrollToRenderedIndex = (renderedIndex, behavior = 'smooth') => {
    const list = listRef.value;
    const item = itemRefs.value[renderedIndex];
    if (!list || !item) return;

    const targetTop = item.offsetTop - list.clientHeight / 2 + item.clientHeight / 2;
    list.scrollTo({ top: targetTop, behavior });
};

const getSegmentHeight = () => {
    const firstItem = itemRefs.value[0];
    const middleItem = itemRefs.value[middleCopyOffset];
    if (!firstItem || !middleItem) return 0;
    return middleItem.offsetTop - firstItem.offsetTop;
};

const normalizeInfiniteScroll = () => {
    const list = listRef.value;
    if (!list) return;

    const segmentHeight = getSegmentHeight();
    if (!segmentHeight) return;

    if (list.scrollTop <= segmentHeight * 0.25) {
        list.scrollTop += segmentHeight;
    } else if (list.scrollTop >= segmentHeight * 1.75) {
        list.scrollTop -= segmentHeight;
    }
};

const updateActiveFromScroll = () => {
    if (!listRef.value) return;

    const listRect = listRef.value.getBoundingClientRect();
    const centerY = listRect.top + listRect.height / 2;
    let closestIndex = activeIndex.value;
    let closestDistance = Number.POSITIVE_INFINITY;

    itemRefs.value.forEach((item, index) => {
        if (!item) return;
        const rect = item.getBoundingClientRect();
        const itemCenter = rect.top + rect.height / 2;
        const distance = Math.abs(centerY - itemCenter);

        if (distance < closestDistance) {
            closestDistance = distance;
            closestIndex = index;
        }
    });

    activeRenderedIndex.value = closestIndex;
    activeIndex.value = renderedProjects[closestIndex]?.sourceIndex ?? 0;
};

const handleListScroll = () => {
    if (isTicking) return;
    isTicking = true;

    requestAnimationFrame(() => {
        normalizeInfiniteScroll();
        updateActiveFromScroll();
        isTicking = false;
    });
};

const selectProject = (index, behavior = 'smooth') => {
    activeIndex.value = index;
    scrollToIndex(index, behavior);
};

const handleSectionWheel = (event) => {
    if (!listRef.value) return;
    listRef.value.scrollTop += event.deltaY;
};

const handleResize = () => {
    scrollToIndex(activeIndex.value, 'auto');
};

onMounted(() => {
    itemRefs.value = [];

    nextTick(() => {
        selectProject(0, 'auto');
        normalizeInfiniteScroll();
        updateActiveFromScroll();
    });

    window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
});
</script>

<style scoped>
.projects-showcase {
    height: 100%;
    min-height: 0;
    overflow: hidden;
    padding: 0 clamp(1rem, 2.3vw, 2.4rem);
}

.projects-layout {
    height: 100%;
    min-height: 0;
    display: grid;
    grid-template-columns: minmax(0, 1.1fr) minmax(290px, 0.9fr);
    gap: clamp(1rem, 2.8vw, 2.8rem);
    align-items: start;
}

.projects-text-column {
    min-width: 0;
    min-height: 0;
    display: flex;
    flex-direction: column;
}

.projects-kicker {
    margin: 0 0 0.6rem;
    font-family: 'Barlow', ui-sans-serif, system-ui, sans-serif;
    font-size: 0.67rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(20, 20, 20, 0.45);
}

.projects-list-shell {
    flex: 1;
    min-height: 0;
    position: relative;
}

.projects-focus-line {
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    border-top: 1px solid rgba(20, 20, 20, 0.2);
    pointer-events: none;
    z-index: 1;
}

.projects-list {
    height: 100%;
    overflow-y: auto;
    padding: 27% 0;
    scroll-snap-type: y proximity;
    scrollbar-width: none;
    overscroll-behavior: none;
}

.projects-list::-webkit-scrollbar {
    display: none;
}

.projects-item {
    width: 100%;
    border: 0;
    background: transparent;
    text-align: left;
    padding: 0.1rem 0;
    display: block;
    scroll-snap-align: center;
    position: relative;
    z-index: 2;
}

.projects-item-title {
    display: block;
    font-family: var(--font-display);
    font-size: clamp(2.4rem, 8.9vw, 8.4rem);
    line-height: 0.82;
    font-weight: 800;
    letter-spacing: 0.01em;
    text-transform: uppercase;
    color: rgba(12, 12, 12, 0.1);
    transition: color 0.28s ease, transform 0.28s ease;
}

.projects-item.is-active {
    color: #0d0d0d;
}

.projects-item.is-active .projects-item-title {
    color: #040404;
    transform: translateX(0.2rem);
}

.projects-item:not(.is-active):hover .projects-item-title {
    color: rgba(10, 10, 10, 0.32);
}

.projects-detail {
    margin-top: 0.65rem;
    max-width: 38rem;
    padding-right: 1rem;
}

.projects-preview-category {
    margin: 0 0 0.45rem;
    font-family: 'Barlow', ui-sans-serif, system-ui, sans-serif;
    font-size: 0.68rem;
    letter-spacing: 0.17em;
    font-weight: 600;
    text-transform: uppercase;
    color: rgba(20, 20, 20, 0.48);
}

.projects-preview-title {
    margin: 0 0 0.4rem;
    font-size: clamp(1.3rem, 2.4vw, 2rem);
    line-height: 0.95;
    font-family: var(--font-display);
    letter-spacing: 0.02em;
    text-transform: uppercase;
}

.projects-preview-description {
    margin: 0;
    max-width: 34rem;
    font-size: 0.91rem;
    line-height: 1.45;
    color: rgba(20, 20, 20, 0.68);
}

.projects-visual-column {
    position: relative;
    justify-self: end;
    width: 100%;
    height: 100%;
    min-height: 0;
    border-left: 1px solid rgba(20, 20, 20, 0.12);
    padding-left: clamp(1rem, 2vw, 1.5rem);
}

.projects-faint-list {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 0.8rem;
    left: clamp(1rem, 2.2vw, 1.6rem);
    display: flex;
    flex-direction: column;
    gap: 4rem;
    z-index: 2;
    font-family: 'Barlow', ui-sans-serif, system-ui, sans-serif;
    font-size: 0.66rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(10, 10, 10, 0.12);
}

.projects-faint-list li {
    transition: color 0.24s ease;
}

.projects-faint-list li.is-active {
    color: rgba(10, 10, 10, 0.62);
}

.projects-accent-frame,
.projects-main-frame {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(12, 12, 12, 0.08);
    background: rgba(255, 255, 255, 0.55);
    box-shadow: 0 30px 70px rgba(15, 12, 17, 0.12);
}

.projects-accent-frame {
    position: absolute;
    top: 0;
    justify-self: end;
    right: 0;
    width: clamp(190px, 72%, 430px);
    aspect-ratio: 1.12;
}

.projects-main-frame {
    position: absolute;
    right: 0;
    bottom: 0;
    width: clamp(260px, 97%, 640px);
    aspect-ratio: 1.22;
}

.projects-accent-image,
.projects-main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: saturate(0.95) contrast(1.03);
}

.visual-swap-enter-active,
.visual-swap-leave-active {
    transition: opacity 0.4s ease, transform 0.4s ease;
}

.visual-swap-enter-from,
.visual-swap-leave-to {
    opacity: 0;
    transform: scale(1.03);
}

@media (max-width: 1024px) {
    .projects-layout {
        grid-template-columns: 1fr;
        gap: 1.1rem;
    }

    .projects-showcase {
        padding-bottom: 1rem;
    }

    .projects-list-shell {
        min-height: min(48vh, 460px);
    }

    .projects-visual-column {
        min-height: min(48vh, 420px);
        border-left: 0;
        padding-left: 0;
    }

    .projects-faint-list {
        left: 0.6rem;
        gap: 1.25rem;
        top: 0;
        font-size: 0.61rem;
    }
}

@media (max-width: 640px) {
    .projects-showcase {
        padding-inline: 0.8rem;
    }

    .projects-list {
        padding-block: 34%;
    }

    .projects-item-title {
        font-size: clamp(2.25rem, 14.5vw, 4.6rem);
    }

    .projects-detail {
        margin-top: 0.5rem;
    }

    .projects-faint-list {
        display: none;
    }

    .projects-accent-frame {
        width: 72%;
    }

    .projects-main-frame {
        width: 97%;
    }
}
</style>
