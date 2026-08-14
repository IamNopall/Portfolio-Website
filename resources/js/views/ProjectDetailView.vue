<template>
    <div class="page min-h-[100dvh] bg-[var(--bg)] text-[var(--text)] selection:bg-white selection:text-black">
        <!-- Floating Ambient Top Bar (Editorial Header) -->
        <header class="fixed top-0 left-0 right-0 z-40 bg-[var(--bg)]/85 backdrop-blur-md border-b border-[var(--border-subtle)] transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-8 h-16 sm:h-20 flex items-center justify-between font-sans text-[10px] sm:text-[11px] tracking-[0.2em] uppercase">
                <!-- Back Link -->
                <router-link to="/#projects"
                    class="group flex items-center gap-2.5 text-[var(--muted)] hover:text-[var(--heading)] transition-colors cursor-pointer font-medium">
                    <span class="inline-block transform group-hover:-translate-x-1 transition-transform">←</span>
                    <span>ALL WORKS</span>
                </router-link>

                <!-- Project Breadcrumb (Desktop) -->
                <div v-if="project" class="hidden md:flex items-center gap-3 text-[var(--muted)]">
                    <span class="text-[var(--text-soft)] font-mono font-semibold">0{{ project.id ?? '1' }}</span>
                    <span class="w-3 h-[1px] bg-[var(--border-subtle)]"></span>
                    <span class="text-[var(--heading)] font-semibold truncate max-w-[240px]">{{ project.title }}</span>
                    <span class="text-[9px] opacity-60">/ {{ project.category }}</span>
                </div>

                <!-- Action Links or Contact -->
                <div class="flex items-center gap-4 sm:gap-6">
                    <a v-if="project?.liveUrl" :href="project.liveUrl" target="_blank" rel="noopener noreferrer"
                        class="hidden sm:inline-flex items-center gap-1.5 text-[var(--heading)] hover:text-[var(--accent-blue)] transition-colors">
                        <span>LIVE DEMO</span>
                        <span class="text-xs">↗</span>
                    </a>
                    <a href="mailto:naufaltsq333@gmail.com"
                        class="text-[var(--heading)] hover:text-[var(--accent-blue)] transition-colors font-semibold">
                        LET'S TALK
                    </a>
                </div>
            </div>
        </header>

        <!-- Loading State -->
        <div v-if="isLoading" class="min-h-[100dvh] flex items-center justify-center pt-20">
            <div class="text-center space-y-4">
                <span class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tight text-[var(--heading)] animate-pulse">
                    LOADING CASE STUDY...
                </span>
                <p class="font-sans text-xs tracking-[0.25em] text-[var(--muted)] uppercase">FETCHING DATA &amp; ASSETS</p>
            </div>
        </div>

        <!-- 404 / Project Not Found State -->
        <div v-else-if="!project" class="min-h-[100dvh] flex flex-col justify-center items-center px-4 sm:px-8 pt-20 pb-16 text-center">
            <div class="max-w-xl space-y-6">
                <span class="font-sans text-[10px] tracking-[0.3em] uppercase text-[var(--muted)]">404 // CASE STUDY ARCHIVE</span>
                <h1 class="display-font text-6xl sm:text-8xl font-black uppercase tracking-tighter text-[var(--heading)] leading-none">
                    PROJECT NOT FOUND
                </h1>
                <p class="font-sans text-xs sm:text-sm text-[var(--muted)] font-light leading-relaxed max-w-md mx-auto">
                    The requested project case study could not be located in our archive. It may have been moved, renamed, or is currently under revision.
                </p>
                <div class="pt-4 flex items-center justify-center gap-4">
                    <router-link to="/"
                        class="font-sans text-xs tracking-[0.2em] uppercase px-6 py-3 bg-[var(--heading)] text-[var(--bg)] font-bold hover:opacity-90 transition-opacity">
                        RETURN TO PORTFOLIO
                    </router-link>
                </div>
            </div>
        </div>

        <!-- MAIN PROJECT CONTENT -->
        <main v-else class="pt-24 sm:pt-32">
            <!-- ========================================== -->
            <!-- 01. HERO SECTION                           -->
            <!-- ========================================== -->
            <section class="max-w-7xl mx-auto px-4 sm:px-8 pb-16 sm:pb-28">
                <!-- Metadata Eyebrow Header -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-8 mb-8 sm:mb-12 border-b border-[var(--border-subtle)] font-sans text-[10px] sm:text-[11px] tracking-[0.25em] text-[var(--muted)] uppercase">
                    <div class="flex items-center gap-3">
                        <span class="text-[var(--heading)] font-mono font-semibold">PROJECT ARCHIVE // {{ project.year }}</span>
                        <span class="w-4 h-[1px] bg-[var(--border-subtle)]"></span>
                        <span class="text-[var(--text-soft)]">{{ project.category }}</span>
                    </div>
                    <div v-if="project.role" class="text-right">
                        <span>ROLE: </span>
                        <span class="text-[var(--heading)] font-semibold">{{ project.role }}</span>
                    </div>
                </div>

                <!-- Giant Display Project Title & Tagline -->
                <div class="mb-10 sm:mb-16">
                    <h1 class="display-font font-black uppercase text-[15vw] sm:text-[11vw] lg:text-[8.5rem] leading-[0.84] tracking-tighter text-[var(--heading)] mb-6 select-none">
                        {{ project.title }}
                    </h1>
                    <p class="font-sans text-base sm:text-xl lg:text-2xl text-[var(--text-soft)] max-w-3xl font-light leading-relaxed">
                        {{ project.shortDescription }}
                    </p>

                    <!-- Action Links (GitHub, Demo, Docs) -->
                    <div class="flex flex-wrap items-center gap-4 sm:gap-6 pt-8 mt-8 border-t border-[var(--border-subtle)] font-sans text-xs tracking-[0.18em] uppercase">
                        <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" rel="noopener noreferrer"
                            class="group inline-flex items-center gap-2 px-5 py-2.5 bg-[var(--hover-bg)] hover:bg-[var(--heading)] hover:text-[var(--bg)] border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--heading)] transition-all font-semibold cursor-pointer">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                            <span>VIEW REPOSITORY</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">↗</span>
                        </a>

                        <a v-if="project.liveUrl" :href="project.liveUrl" target="_blank" rel="noopener noreferrer"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-white text-black hover:bg-neutral-200 font-black transition-all cursor-pointer shadow-xl active:scale-[0.98]">
                            <span class="text-black font-black">LAUNCH EXPERIENCE</span>
                            <span class="text-xs text-black font-black group-hover:translate-x-0.5 transition-transform">↗</span>
                        </a>

                        <a v-if="project.documentationUrl" :href="project.documentationUrl" target="_blank" rel="noopener noreferrer"
                            class="group inline-flex items-center gap-2 px-5 py-2.5 bg-transparent border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--heading)] transition-all font-semibold cursor-pointer">
                            <span>DOCUMENTATION</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">↗</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Visual (Large, Dominant Cinematic Frame) -->
                <div v-if="project.heroImage" class="relative w-full aspect-[16/9] sm:aspect-[21/9] bg-[var(--hover-bg)] border border-[var(--border-subtle)] overflow-hidden shadow-2xl group">
                    <img :src="project.heroImage" :alt="project.title + ' Hero Visual'"
                        class="w-full h-full object-cover transform group-hover:scale-[1.02] transition-transform duration-1000 ease-out"
                        loading="eager" />
                    <!-- Ambient Inner Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[var(--bg)]/70 via-transparent to-transparent pointer-events-none opacity-60"></div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 02. OVERVIEW & PROBLEM/SOLUTION             -->
            <!-- ========================================== -->
            <section class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-32">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-[0.35fr_0.65fr] gap-12 lg:gap-20">
                        <!-- Left Sticky Section Header -->
                        <div>
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-3">
                                01 // CONTEXT &amp; PURPOSE
                            </span>
                            <h2 class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.9]">
                                PROJECT<br />OVERVIEW.
                            </h2>
                        </div>

                        <!-- Right Editorial Narrative Content -->
                        <div class="space-y-10">
                            <div>
                                <h3 class="font-sans text-xs tracking-[0.2em] uppercase text-[var(--heading)] font-semibold mb-4">
                                    THE VISION &amp; OBJECTIVE
                                </h3>
                                <p class="font-sans text-base sm:text-lg text-[var(--text-soft)] font-light leading-relaxed">
                                    {{ project.overview }}
                                </p>
                            </div>

                            <!-- Problem & Solution Split -->
                            <div v-if="project.problemSolution" class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-[var(--border-subtle)]">
                                <div class="space-y-3 p-6 bg-[var(--hover-bg)]/50 border border-[var(--border-subtle)]">
                                    <span class="font-mono text-[9px] tracking-[0.2em] text-red-400 uppercase font-semibold">
                                        CHALLENGE // PROBLEM
                                    </span>
                                    <p class="font-sans text-xs sm:text-sm text-[var(--text-soft)] font-light leading-relaxed">
                                        {{ project.problemSolution.problem }}
                                    </p>
                                </div>

                                <div class="space-y-3 p-6 bg-[var(--hover-bg)]/50 border border-[var(--border-subtle)]">
                                    <span class="font-mono text-[9px] tracking-[0.2em] text-emerald-400 uppercase font-semibold">
                                        ENGINEERED SOLUTION
                                    </span>
                                    <p class="font-sans text-xs sm:text-sm text-[var(--text-soft)] font-light leading-relaxed">
                                        {{ project.problemSolution.solution }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 03. MY CONTRIBUTION                        -->
            <!-- ========================================== -->
            <section class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-32">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-[0.35fr_0.65fr] gap-12 lg:gap-20">
                        <div>
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-3">
                                02 // PERSONAL IMPACT
                            </span>
                            <h2 class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.9]">
                                MY<br />CONTRIBUTION.
                            </h2>
                        </div>

                        <div class="space-y-8">
                            <div class="p-6 sm:p-8 border border-[var(--heading)]/20 bg-[var(--hover-bg)]/30">
                                <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-2">
                                    CORE RESPONSIBILITY &amp; SCOPE
                                </span>
                                <p class="font-sans text-base sm:text-xl text-[var(--heading)] font-normal leading-relaxed">
                                    {{ project.contribution }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 04. TECH STACK (Minimalist Typographic)    -->
            <!-- ========================================== -->
            <section class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-28">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-4 mb-10 pb-6 border-b border-[var(--border-subtle)]">
                        <div>
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-2">
                                03 // SYSTEMS ARCHITECTURE
                            </span>
                            <h2 class="display-font text-3xl sm:text-5xl font-black uppercase tracking-tighter text-[var(--heading)]">
                                TECHNOLOGIES &amp; TOOLKIT
                            </h2>
                        </div>
                        <span class="font-mono text-xs tracking-widest text-[var(--muted)] uppercase tabular-nums">
                            {{ project.technologies?.length || 0 }} MODULES
                        </span>
                    </div>

                    <!-- Minimalist Modern Tag / Badge Flow -->
                    <div class="flex flex-wrap gap-3 sm:gap-4">
                        <div v-for="tech in (project.technologies || [])" :key="tech"
                            class="px-4 sm:px-5 py-2.5 sm:py-3 bg-[var(--hover-bg)] border border-[var(--border-subtle)] hover:border-[var(--heading)] transition-colors flex items-center gap-3 group cursor-default">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--heading)]/40 group-hover:bg-[var(--heading)] transition-colors"></span>
                            <span class="font-sans text-xs sm:text-sm tracking-[0.15em] uppercase text-[var(--text-soft)] group-hover:text-[var(--heading)] transition-colors font-medium">
                                {{ tech }}
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 05. KEY FEATURES SHOWCASE (Visual Dominant) -->
            <!-- ========================================== -->
            <section v-if="project.features && project.features.length > 0"
                class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-24 sm:py-36">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-16 sm:mb-24 pb-8 border-b border-[var(--border-subtle)]">
                        <div>
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-3">
                                04 // FEATURE BREAKDOWN
                            </span>
                            <h2 class="display-font text-5xl sm:text-7xl font-black uppercase tracking-tighter text-[var(--heading)] leading-none">
                                KEY FEATURES.
                            </h2>
                        </div>
                        <p class="font-sans text-xs sm:text-sm text-[var(--muted)] max-w-sm font-light">
                            Detailed architectural inspection of implemented gameplay mechanics, UI layers, and system loops.
                        </p>
                    </div>

                    <!-- Editorial Feature List (Editorial Asymmetric Showcase) -->
                    <div class="space-y-24 sm:space-y-36">
                        <div v-for="feature in project.features" :key="feature.number"
                            class="group grid grid-cols-1 lg:grid-cols-[0.4fr_0.6fr] gap-8 lg:gap-16 items-center">
                            <!-- Feature Context / Explanatory Text -->
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <span class="display-font text-5xl sm:text-6xl font-black text-[var(--heading)] opacity-30 select-none">
                                        {{ feature.number }}
                                    </span>
                                    <span class="w-8 h-[1px] bg-[var(--border-subtle)]"></span>
                                    <span v-if="feature.tech" class="font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        {{ feature.tech }}
                                    </span>
                                </div>

                                <h3 class="display-font text-3xl sm:text-5xl font-black uppercase text-[var(--heading)] tracking-tight leading-[0.9]">
                                    {{ feature.title }}
                                </h3>

                                <p class="font-sans text-sm sm:text-base text-[var(--text-soft)] font-light leading-relaxed">
                                    {{ feature.description }}
                                </p>
                            </div>

                            <!-- Large Prominent Feature Visual -->
                            <div class="relative w-full aspect-[16/10] bg-[var(--hover-bg)] border border-[var(--border-subtle)] group-hover:border-[var(--border)] overflow-hidden shadow-xl transition-all duration-500">
                                <img v-if="feature.image" :src="feature.image" :alt="feature.title"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                                    loading="lazy" />
                                <div v-else class="w-full h-full flex items-center justify-center p-8 text-center bg-gradient-to-br from-white/[0.02] to-transparent">
                                    <span class="display-font text-5xl font-black uppercase text-[var(--muted)] opacity-20">
                                        FEATURE {{ feature.number }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 06. RESULT & IMPACT METRICS                -->
            <!-- ========================================== -->
            <section v-if="project.result" class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-32">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-[0.35fr_0.65fr] gap-12 lg:gap-20">
                        <div>
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-3">
                                05 // OUTCOME &amp; PERFORMANCE
                            </span>
                            <h2 class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.9]">
                                MEASURABLE<br />RESULTS.
                            </h2>
                        </div>

                        <div class="space-y-12">
                            <div>
                                <h3 class="font-sans text-xs tracking-[0.2em] uppercase text-[var(--heading)] font-semibold mb-3">
                                    {{ project.result.headline }}
                                </h3>
                                <p class="font-sans text-base sm:text-lg text-[var(--text-soft)] font-light leading-relaxed">
                                    {{ project.result.summary }}
                                </p>
                            </div>

                            <!-- Big Typographic Metrics Grid -->
                            <div v-if="project.result.metrics && project.result.metrics.length > 0"
                                class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 pt-8 border-t border-[var(--border-subtle)]">
                                <div v-for="metric in project.result.metrics" :key="metric.label" class="space-y-2">
                                    <div class="display-font text-4xl sm:text-5xl lg:text-6xl font-black text-[var(--heading)] tracking-tighter leading-none">
                                        {{ metric.value }}
                                    </div>
                                    <div class="font-sans text-[10px] sm:text-[11px] tracking-[0.18em] uppercase text-[var(--muted)] font-medium leading-tight">
                                        {{ metric.label }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 07. GALLERY & VISUAL SHOWCASE               -->
            <!-- ========================================== -->
            <section v-if="project.gallery && project.gallery.length > 0"
                class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-32">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-4 mb-12 sm:mb-16 pb-6 border-b border-[var(--border-subtle)]">
                        <div>
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-2">
                                06 // VISUAL EXHIBITION
                            </span>
                            <h2 class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tighter text-[var(--heading)]">
                                PROJECT GALLERY.
                            </h2>
                        </div>
                        <span class="font-mono text-xs tracking-widest text-[var(--muted)] uppercase">
                            {{ project.gallery.length }} FRAMES
                        </span>
                    </div>

                    <!-- Dynamic Gallery Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10">
                        <div v-for="(item, idx) in project.gallery" :key="idx"
                            @click="openLightbox(item.url)"
                            class="group relative flex flex-col justify-between border border-[var(--border-subtle)] hover:border-[var(--heading)] bg-[var(--hover-bg)]/30 p-4 sm:p-6 transition-all duration-300 cursor-zoom-in">
                            <div class="relative aspect-[16/10] w-full bg-[var(--hover-bg)] overflow-hidden mb-4">
                                <img :src="item.url" :alt="item.title || ('Gallery Image ' + (idx + 1))"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                                    loading="lazy" />
                            </div>

                            <div v-if="item.title || item.caption" class="pt-3 border-t border-[var(--border-subtle)]">
                                <h4 v-if="item.title" class="font-sans text-xs font-semibold tracking-wider text-[var(--heading)] uppercase mb-1">
                                    {{ item.title }}
                                </h4>
                                <p v-if="item.caption" class="font-sans text-xs text-[var(--muted)] font-light leading-relaxed">
                                    {{ item.caption }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Lightbox Modal -->
            <Teleport to="body">
                <Transition name="modal-fade">
                    <div v-if="activeLightboxImage"
                        class="fixed inset-0 z-[120] flex items-center justify-center p-4 sm:p-10 bg-black/90 backdrop-blur-xl"
                        @click="activeLightboxImage = null">
                        <div class="relative max-w-6xl max-h-[90vh] w-full flex flex-col items-center justify-center" @click.stop>
                            <button @click="activeLightboxImage = null"
                                class="absolute -top-12 right-0 font-sans text-xs tracking-[0.2em] uppercase text-[var(--muted)] hover:text-white transition-colors cursor-pointer flex items-center gap-1.5">
                                <span>CLOSE</span>
                                <span>✕</span>
                            </button>
                            <img :src="activeLightboxImage" alt="Expanded Visual"
                                class="max-w-full max-h-[82vh] object-contain border border-[var(--border)] shadow-2xl" />
                        </div>
                    </div>
                </Transition>
            </Teleport>

            <!-- ========================================== -->
            <!-- 08. PROJECT NAVIGATION (PREV / NEXT)        -->
            <!-- ========================================== -->
            <section class="w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-28">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-[var(--border-subtle)] border border-[var(--border-subtle)]">
                        <!-- PREVIOUS PROJECT -->
                        <router-link v-if="adjacent.prev" :to="'/projects/' + adjacent.prev.slug"
                            class="group p-8 sm:p-12 hover:bg-[var(--hover-bg)] transition-colors flex flex-col justify-between cursor-pointer">
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase mb-6 flex items-center gap-2">
                                <span class="transform group-hover:-translate-x-1 transition-transform">←</span>
                                <span>PREVIOUS WORK</span>
                            </span>
                            <div>
                                <span class="font-mono text-[9px] tracking-wider text-[var(--muted)] uppercase block mb-1">
                                    {{ adjacent.prev.category }}
                                </span>
                                <h3 class="display-font text-3xl sm:text-5xl font-black uppercase text-[var(--heading)] group-hover:text-[var(--text-soft)] transition-colors leading-[0.9] tracking-tight">
                                    {{ adjacent.prev.title }}
                                </h3>
                            </div>
                        </router-link>
                        <div v-else class="p-8 sm:p-12 opacity-30 flex items-center">
                            <span class="font-sans text-xs tracking-widest text-[var(--muted)] uppercase">FIRST WORK IN ARCHIVE</span>
                        </div>

                        <!-- NEXT PROJECT -->
                        <router-link v-if="adjacent.next" :to="'/projects/' + adjacent.next.slug"
                            class="group p-8 sm:p-12 hover:bg-[var(--hover-bg)] transition-colors flex flex-col justify-between text-right cursor-pointer">
                            <span class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase mb-6 flex items-center justify-end gap-2">
                                <span>NEXT WORK</span>
                                <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                            <div>
                                <span class="font-mono text-[9px] tracking-wider text-[var(--muted)] uppercase block mb-1">
                                    {{ adjacent.next.category }}
                                </span>
                                <h3 class="display-font text-3xl sm:text-5xl font-black uppercase text-[var(--heading)] group-hover:text-[var(--text-soft)] transition-colors leading-[0.9] tracking-tight">
                                    {{ adjacent.next.title }}
                                </h3>
                            </div>
                        </router-link>
                        <div v-else class="p-8 sm:p-12 opacity-30 flex items-center justify-end text-right">
                            <span class="font-sans text-xs tracking-widest text-[var(--muted)] uppercase">LAST WORK IN ARCHIVE</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <FooterBar />
    </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import FooterBar from '../components/FooterBar.vue';
import { getAdjacentProjects, resolveProjectData } from '../data/projectsData.js';

const props = defineProps({
    slug: {
        type: String,
        default: ''
    }
});

const route = useRoute();
const currentSlug = computed(() => props.slug || route.params.slug);

const isLoading = ref(true);
const apiProjects = ref([]);
const project = ref(null);
const activeLightboxImage = ref(null);

const fetchProjectsAndHydrate = async () => {
    isLoading.value = true;
    try {
        const res = await fetch('/api/projects');
        const json = await res.json();
        if (json.success && Array.isArray(json.data)) {
            apiProjects.value = json.data;
        }
    } catch (err) {
        console.error('Failed to fetch API projects:', err);
    } finally {
        project.value = resolveProjectData(currentSlug.value, apiProjects.value);
        isLoading.value = false;
    }
};

const adjacent = computed(() => {
    return getAdjacentProjects(currentSlug.value, apiProjects.value);
});

const openLightbox = (url) => {
    activeLightboxImage.value = url;
};

// Re-fetch / resolve when route slug changes
watch(
    () => route.params.slug,
    (newSlug) => {
        if (newSlug) {
            project.value = resolveProjectData(newSlug, apiProjects.value);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
);

onMounted(() => {
    fetchProjectsAndHydrate();
    window.scrollTo({ top: 0 });
});
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}
</style>
