<template>
    <!-- Loading State -->
    <div v-if="isLoading" class="min-h-[100dvh] flex items-center justify-center bg-[var(--bg)] text-[var(--text)]">
        <div class="text-center space-y-4">
            <span
                class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tight text-[var(--heading)] animate-pulse">
                LOADING CASE STUDY...
            </span>
            <p class="font-mono text-xs tracking-[0.25em] text-[var(--muted)] uppercase">FETCHING DATA &amp; ASSETS</p>
        </div>
    </div>

    <!-- 404 / Project Not Found State (using standard NotFoundView) -->
    <NotFoundView v-else-if="!project" />

    <!-- MAIN PROJECT CASE STUDY CONTENT -->
    <div v-else ref="caseStudyRef"
        class="page min-h-[100dvh] bg-[var(--bg)] text-[var(--text)] selection:bg-white selection:text-black relative">
        <!--
        THESIS: Transforms standard linear project case studies into an asymmetrical architectural blueprint dossier—combining a sticky wayfinding telemetry rail (TOC, reading progress, live actions) with deep engineering problem-solution breakdowns and metrics.
        OWN-WORLD: Obsidian backdrop (#0d0d0d), zinc-800 architectural hairlines, pure white display typography, cobalt focal accents (#3b82f6), and tactile glass telemetry cards.
        STORY: Technical recruiters and engineering leads explore deep architectural decisions with instant section jumping, reading progress tracking, and 1-click access to live deployments and source code repositories.
        FIRST VIEWPORT: Top floating header with breadcrumbs and live demo link; Hero with giant display title, technical metadata badges, action pill cluster, and 21:9 cinematic visual container.
        FORM: Technical Architectural Blueprint Dossier with Sticky TOC Rail, seed 0904e589.
        FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance.
        -->

        <!-- Floating Ambient Top Bar (Editorial Header) -->
        <header
            class="fixed top-0 left-0 right-0 z-40 bg-[var(--bg)]/85 backdrop-blur-md border-b border-[var(--border-subtle)] transition-all duration-300">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-8 h-16 sm:h-20 flex items-center justify-between font-mono text-[10px] sm:text-[11px] tracking-[0.2em] uppercase">
                <!-- Back Link -->
                <router-link to="/#projects"
                    class="group flex items-center gap-2.5 text-[var(--muted)] hover:text-[var(--heading)] transition-colors cursor-pointer font-medium">
                    <span class="inline-block transform group-hover:-translate-x-1 transition-transform">←</span>
                    <span>ALL WORKS</span>
                </router-link>

                <!-- Project Breadcrumb (Desktop) -->
                <div class="hidden md:flex items-center gap-3 text-[var(--muted)]">
                    <span class="text-[var(--text-soft)] font-mono font-semibold">0{{ project.id ?? '1' }}</span>
                    <span class="w-3 h-[1px] bg-[var(--border-subtle)]"></span>
                    <span class="text-[var(--heading)] font-semibold truncate max-w-[240px]">{{ project.title }}</span>
                    <span class="text-[9px] opacity-60">/ {{ project.category }}</span>
                </div>

                <!-- Action Links or Contact -->
                <div class="flex items-center gap-3 sm:gap-5">
                    <a v-if="project.liveUrl" :href="project.liveUrl" target="_blank" rel="noopener noreferrer"
                        class="hidden sm:inline-flex items-center gap-1.5 text-black bg-white px-3.5 py-1.5 rounded-full font-bold text-[10px] hover:opacity-90 transition-opacity">
                        <span class="text-black">LIVE DEMO</span>
                        <span class="text-xs text-black">↗</span>
                    </a>

                    <!-- Social Icons: GitHub & LinkedIn -->
                    <div class="flex items-center gap-2.5 text-[var(--muted)]">
                        <a href="https://github.com/IamNopall" target="_blank" rel="noopener noreferrer"
                            class="p-1 hover:text-[var(--heading)] transition-colors inline-flex items-center"
                            title="GitHub" aria-label="GitHub Profile">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/in/naufal-tsaqif-athala-irchamto" target="_blank"
                            rel="noopener noreferrer"
                            class="p-1 hover:text-[var(--heading)] transition-colors inline-flex items-center"
                            title="LinkedIn" aria-label="LinkedIn Profile">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                    </div>

                    <a href="mailto:naufaltsq333@gmail.com"
                        class="text-[var(--heading)] hover:text-[var(--accent-blue)] transition-colors font-semibold">
                        LET'S TALK
                    </a>
                </div>
            </div>

            <!-- Reading Progress Bar -->
            <div class="w-full h-[2px] bg-[var(--border-subtle)] overflow-hidden">
                <div class="h-full bg-blue-500 transition-all duration-150 ease-out"
                    :style="{ width: `${scrollProgress}%` }"></div>
            </div>
        </header>

        <!-- MAIN PROJECT CONTENT -->
        <main class="pt-24 sm:pt-32">
            <!-- ========================================== -->
            <!-- HERO SECTION                               -->
            <!-- ========================================== -->
            <section class="cs-hero max-w-7xl mx-auto px-4 sm:px-8 pb-16 sm:pb-24">
                <!-- Metadata Eyebrow Header -->
                <div
                    class="cs-hero-meta flex flex-wrap items-center justify-between gap-4 pb-6 mb-8 sm:mb-12 border-b border-[var(--border-subtle)] font-mono text-[10px] sm:text-[11px] tracking-[0.2em] text-[var(--muted)] uppercase">
                    <div class="flex items-center gap-3">
                        <span class="text-[var(--heading)] font-semibold">PROJECT ARCHIVE // {{ project.year || '2026'
                            }}</span>
                        <span class="w-4 h-[1px] bg-[var(--border-subtle)]"></span>
                        <span class="text-[var(--text-soft)]">{{ project.category }}</span>
                    </div>
                    <div v-if="project.role" class="flex items-center gap-2">
                        <span class="text-[var(--muted)]">ROLE:</span>
                        <span class="text-[var(--heading)] font-semibold">{{ project.role }}</span>
                    </div>
                </div>

                <!-- Giant Display Project Title & Tagline -->
                <div class="mb-10 sm:mb-16">
                    <h1
                        class="cs-hero-title display-font font-black uppercase text-[14vw] sm:text-[10vw] lg:text-[7.5rem] xl:text-[8.5rem] leading-[0.84] tracking-tighter text-[var(--heading)] mb-6 select-none">
                        {{ project.title }}
                    </h1>
                    <p
                        class="cs-hero-desc font-sans text-base sm:text-xl lg:text-2xl text-[var(--text-soft)] max-w-3xl font-light leading-relaxed">
                        {{ project.shortDescription }}
                    </p>

                    <!-- Action Links (GitHub, Demo, Docs) -->
                    <div
                        class="cs-hero-actions flex flex-wrap items-center gap-4 sm:gap-6 pt-8 mt-8 border-t border-[var(--border-subtle)] font-mono text-xs tracking-[0.18em] uppercase">
                        <a v-if="project.liveUrl" :href="project.liveUrl" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-3 px-6 py-3.5 rounded-full bg-white text-black font-bold hover:opacity-90 transition-all active:scale-[0.98] group shadow-lg">
                            <span class="text-black">LAUNCH EXPERIENCE</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform text-black">↗</span>
                        </a>

                        <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--heading)] hover:bg-white/[0.04] transition-all font-semibold cursor-pointer">
                            <svg class="w-4 h-4 fill-current transition-colors" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                            </svg>
                            <span>VIEW REPOSITORY</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">↗</span>
                        </a>

                        <a v-if="project.documentationUrl" :href="project.documentationUrl" target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--heading)] hover:bg-white/[0.04] transition-all font-semibold cursor-pointer">
                            <span>DOCUMENTATION</span>
                            <span class="text-xs group-hover:translate-x-0.5 transition-transform">↗</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Visual (Large Cinematic 21:9 Container) -->
                <div v-if="project.heroImage"
                    class="cs-hero-frame relative w-full aspect-[16/9] sm:aspect-[21/9] bg-[#121316] border border-white/10 rounded-2xl overflow-hidden shadow-2xl group">
                    <img :src="project.heroImage" :alt="project.title + ' Hero Visual'"
                        class="w-full h-full object-cover transform group-hover:scale-[1.02] transition-transform duration-1000 ease-out"
                        loading="eager" />
                    <!-- Ambient Inner Gradient -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[var(--bg)]/80 via-transparent to-black/30 pointer-events-none">
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- ASYMMETRICAL 2-COLUMN TECHNICAL DOSSIER     -->
            <!-- ========================================== -->
            <div
                class="max-w-7xl mx-auto px-4 sm:px-8 pb-24 sm:pb-36 border-t border-[var(--border-subtle)] pt-16 sm:pt-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                    <!-- STICKY LEFT WAYFINDING & TELEMETRY RAIL (4 Cols on Desktop) -->
                    <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-8">
                        <!-- Table of Contents Navigation Card -->
                        <div class="p-6 rounded-2xl bg-white/[0.02] border border-[var(--border-subtle)] space-y-5">
                            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                                <span
                                    class="font-mono text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase font-semibold">
                                    DOSSIER INDEX
                                </span>
                                <span class="font-mono text-[10px] text-blue-400 font-bold tabular-nums">
                                    {{ scrollProgress }}% READ
                                </span>
                            </div>

                            <nav class="space-y-1 font-mono text-[11px] tracking-wider uppercase">
                                <button @click="scrollToSection('overview')"
                                    :class="['w-full text-left py-2 px-3 rounded-lg transition-all flex items-center justify-between cursor-pointer', activeSection === 'overview' ? 'bg-white/10 text-white font-bold pl-4' : 'text-[var(--muted)] hover:text-[var(--heading)] hover:bg-white/[0.03]']">
                                    <span>CONTEXT &amp; PURPOSE</span>
                                    <span v-if="activeSection === 'overview'"
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </button>

                                <button v-if="project.contribution" @click="scrollToSection('contribution')"
                                    :class="['w-full text-left py-2 px-3 rounded-lg transition-all flex items-center justify-between cursor-pointer', activeSection === 'contribution' ? 'bg-white/10 text-white font-bold pl-4' : 'text-[var(--muted)] hover:text-[var(--heading)] hover:bg-white/[0.03]']">
                                    <span>PERSONAL IMPACT</span>
                                    <span v-if="activeSection === 'contribution'"
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </button>

                                <button v-if="project.technologies?.length" @click="scrollToSection('technologies')"
                                    :class="['w-full text-left py-2 px-3 rounded-lg transition-all flex items-center justify-between cursor-pointer', activeSection === 'technologies' ? 'bg-white/10 text-white font-bold pl-4' : 'text-[var(--muted)] hover:text-[var(--heading)] hover:bg-white/[0.03]']">
                                    <span>SYSTEMS &amp; TOOLKIT</span>
                                    <span v-if="activeSection === 'technologies'"
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </button>

                                <button v-if="project.features?.length" @click="scrollToSection('features')"
                                    :class="['w-full text-left py-2 px-3 rounded-lg transition-all flex items-center justify-between cursor-pointer', activeSection === 'features' ? 'bg-white/10 text-white font-bold pl-4' : 'text-[var(--muted)] hover:text-[var(--heading)] hover:bg-white/[0.03]']">
                                    <span>FEATURE BREAKDOWN</span>
                                    <span v-if="activeSection === 'features'"
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </button>

                                <button v-if="project.result" @click="scrollToSection('results')"
                                    :class="['w-full text-left py-2 px-3 rounded-lg transition-all flex items-center justify-between cursor-pointer', activeSection === 'results' ? 'bg-white/10 text-white font-bold pl-4' : 'text-[var(--muted)] hover:text-[var(--heading)] hover:bg-white/[0.03]']">
                                    <span>MEASURABLE RESULTS</span>
                                    <span v-if="activeSection === 'results'"
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </button>

                                <button v-if="project.gallery?.length" @click="scrollToSection('gallery')"
                                    :class="['w-full text-left py-2 px-3 rounded-lg transition-all flex items-center justify-between cursor-pointer', activeSection === 'gallery' ? 'bg-white/10 text-white font-bold pl-4' : 'text-[var(--muted)] hover:text-[var(--heading)] hover:bg-white/[0.03]']">
                                    <span>PROJECT GALLERY</span>
                                    <span v-if="activeSection === 'gallery'"
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                </button>
                            </nav>
                        </div>

                        <!-- Technical Specification Meta Card -->
                        <div
                            class="p-6 rounded-2xl bg-white/[0.02] border border-[var(--border-subtle)] space-y-4 font-mono text-[10px] tracking-wider uppercase">
                            <span
                                class="block text-[var(--muted)] tracking-[0.2em] font-semibold border-b border-[var(--border-subtle)] pb-2">
                                ARCHITECTURE METADATA
                            </span>
                            <div class="space-y-3 text-[var(--text-soft)]">
                                <div class="flex justify-between items-center">
                                    <span class="text-[var(--muted)]">YEAR</span>
                                    <span class="text-[var(--heading)] font-semibold">{{ project.year || '2026'
                                    }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[var(--muted)]">CATEGORY</span>
                                    <span class="text-[var(--heading)] font-semibold">{{ project.category }}</span>
                                </div>
                                <div v-if="project.role" class="flex justify-between items-center">
                                    <span class="text-[var(--muted)]">ROLE</span>
                                    <span class="text-[var(--heading)] font-semibold">{{ project.role }}</span>
                                </div>
                                <div v-if="project.technologies" class="flex justify-between items-center">
                                    <span class="text-[var(--muted)]">STACK MODULES</span>
                                    <span class="text-[var(--heading)] font-semibold">{{ project.technologies.length }}
                                        MODULES</span>
                                </div>
                            </div>
                        </div>

                        <!-- Persistent Quick Actions -->
                        <div class="space-y-3 pt-2">
                            <a v-if="project.liveUrl" :href="project.liveUrl" target="_blank" rel="noopener noreferrer"
                                class="w-full inline-flex items-center justify-center gap-2.5 px-5 py-3 rounded-xl bg-white text-black font-bold font-mono text-xs tracking-wider uppercase hover:opacity-90 transition-opacity">
                                <span class="text-black">LAUNCH EXPERIENCE</span>
                                <span class="text-black">↗</span>
                            </a>
                            <a v-if="project.githubUrl" :href="project.githubUrl" target="_blank"
                                rel="noopener noreferrer"
                                class="w-full inline-flex items-center justify-center gap-2.5 px-5 py-3 rounded-xl border border-[var(--border-subtle)] hover:border-white text-white font-mono text-xs tracking-wider uppercase hover:bg-white/[0.03] transition-all">
                                <span>SOURCE REPOSITORY</span>
                                <span>↗</span>
                            </a>
                        </div>
                    </aside>

                    <!-- DEEP-DIVE TECHNICAL CONTENT (8 Cols on Desktop) -->
                    <div class="lg:col-span-8 space-y-24 sm:space-y-32">

                        <!-- 01. CONTEXT & PROBLEM-SOLUTION -->
                        <section id="overview" class="cs-section-overview space-y-10 scroll-mt-32">
                            <div>
                                <h2
                                    class="display-font text-3xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.9] mb-6">
                                    PROJECT<br />OVERVIEW.
                                </h2>
                                <p
                                    class="font-sans text-base sm:text-lg lg:text-xl text-[var(--text-soft)] font-light leading-relaxed">
                                    {{ project.overview }}
                                </p>
                            </div>

                            <!-- Problem & Solution Blueprint Cards -->
                            <div v-if="project.problemSolution" class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                                <div class="space-y-3 p-6 rounded-2xl bg-red-950/10 border border-red-500/20">
                                    <span
                                        class="font-mono text-[10px] tracking-[0.2em] text-red-400 uppercase font-semibold flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        <span>CHALLENGE &amp; CONSTRAINT</span>
                                    </span>
                                    <p
                                        class="font-sans text-xs sm:text-sm text-[var(--text-soft)] font-light leading-relaxed">
                                        {{ project.problemSolution.problem }}
                                    </p>
                                </div>

                                <div class="space-y-3 p-6 rounded-2xl bg-emerald-950/10 border border-emerald-500/20">
                                    <span
                                        class="font-mono text-[10px] tracking-[0.2em] text-emerald-400 uppercase font-semibold flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>ENGINEERED ARCHITECTURE</span>
                                    </span>
                                    <p
                                        class="font-sans text-xs sm:text-sm text-[var(--text-soft)] font-light leading-relaxed">
                                        {{ project.problemSolution.solution }}
                                    </p>
                                </div>
                            </div>
                        </section>

                        <!-- 02. PERSONAL IMPACT -->
                        <section v-if="project.contribution" id="contribution"
                            class="cs-section-contrib space-y-6 pt-12 border-t border-[var(--border-subtle)] scroll-mt-32">
                            <div>
                                <h2
                                    class="display-font text-3xl sm:text-5xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.9] mb-4">
                                    PERSONAL IMPACT.
                                </h2>
                            </div>

                            <div class="p-6 sm:p-8 rounded-2xl border border-white/10 bg-white/[0.02] space-y-2">
                                <span
                                    class="font-mono text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block">
                                    CORE RESPONSIBILITY &amp; SCOPE
                                </span>
                                <p
                                    class="font-sans text-base sm:text-xl text-[var(--heading)] font-normal leading-relaxed">
                                    {{ project.contribution }}
                                </p>
                            </div>
                        </section>

                        <!-- 03. TECH STACK & ARCHITECTURAL MODULES -->
                        <section v-if="project.technologies && project.technologies.length > 0" id="technologies"
                            class="cs-section-tech space-y-8 pt-12 border-t border-[var(--border-subtle)] scroll-mt-32">
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-4">
                                <div>
                                    <h2
                                        class="display-font text-3xl sm:text-5xl font-black uppercase tracking-tighter text-[var(--heading)]">
                                        SYSTEMS &amp; TOOLKIT.
                                    </h2>
                                </div>
                                <span
                                    class="font-mono text-xs tracking-widest text-[var(--muted)] uppercase tabular-nums">
                                    {{ project.technologies.length }} INTEGRATED MODULES
                                </span>
                            </div>

                            <!-- Minimalist Modern Tag / Badge Flow -->
                            <div class="cs-tech-badges flex flex-wrap gap-3 sm:gap-4">
                                <div v-for="tech in project.technologies" :key="tech"
                                    class="cs-tech-badge px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-white/[0.02] border border-[var(--border-subtle)] hover:border-[var(--heading)] transition-all flex items-center gap-3 group cursor-default">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-blue-500 group-hover:scale-125 transition-transform"></span>
                                    <span
                                        class="font-mono text-xs sm:text-sm tracking-[0.15em] uppercase text-[var(--text-soft)] group-hover:text-[var(--heading)] transition-colors font-medium">
                                        {{ tech }}
                                    </span>
                                </div>
                            </div>
                        </section>

                        <!-- 04. KEY FEATURES SHOWCASE -->
                        <section v-if="project.features && project.features.length > 0" id="features"
                            class="cs-section-features space-y-16 pt-12 border-t border-[var(--border-subtle)] scroll-mt-32">
                            <div>
                                <h2
                                    class="display-font text-4xl sm:text-6xl font-black uppercase tracking-tighter text-[var(--heading)] leading-none mb-3">
                                    KEY FEATURES.
                                </h2>
                                <p class="font-sans text-xs sm:text-sm text-[var(--muted)] max-w-xl font-light">
                                    Detailed architectural inspection of implemented gameplay mechanics, UI layers, and
                                    system loops.
                                </p>
                            </div>

                            <!-- Asymmetric Feature List -->
                            <div class="space-y-20">
                                <div v-for="feature in project.features" :key="feature.number"
                                    class="cs-feature-card group space-y-6">
                                    <div class="flex items-center gap-4">
                                        <span
                                            class="display-font text-4xl sm:text-5xl font-black text-[var(--heading)] opacity-30 select-none">
                                            {{ feature.number }}
                                        </span>
                                        <span class="w-8 h-[1px] bg-[var(--border-subtle)]"></span>
                                        <span v-if="feature.tech"
                                            class="font-mono text-[10px] tracking-[0.2em] text-blue-400 uppercase">
                                            {{ feature.tech }}
                                        </span>
                                    </div>

                                    <h3
                                        class="display-font text-2xl sm:text-4xl font-black uppercase text-[var(--heading)] tracking-tight leading-[0.9]">
                                        {{ feature.title }}
                                    </h3>

                                    <p
                                        class="font-sans text-sm sm:text-base text-[var(--text-soft)] font-light leading-relaxed max-w-3xl">
                                        {{ feature.description }}
                                    </p>

                                    <!-- Large Prominent Feature Visual -->
                                    <div
                                        class="relative w-full aspect-[16/10] bg-[#121316] rounded-2xl border border-[var(--border-subtle)] group-hover:border-[var(--border)] overflow-hidden shadow-xl transition-all duration-500">
                                        <img v-if="feature.image" :src="feature.image" :alt="feature.title"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                                            loading="lazy" />
                                        <div v-else
                                            class="w-full h-full flex items-center justify-center p-8 text-center bg-gradient-to-br from-white/[0.02] to-transparent">
                                            <span
                                                class="display-font text-5xl font-black uppercase text-[var(--muted)] opacity-20">
                                                FEATURE {{ feature.number }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 05. MEASURABLE RESULTS -->
                        <section v-if="project.result" id="results"
                            class="cs-section-results space-y-10 pt-12 border-t border-[var(--border-subtle)] scroll-mt-32">
                            <div>
                                <h2
                                    class="display-font text-3xl sm:text-5xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.9] mb-4">
                                    MEASURABLE RESULTS.
                                </h2>
                                <h3
                                    class="font-mono text-xs tracking-[0.2em] uppercase text-[var(--heading)] font-semibold mb-2">
                                    {{ project.result.headline }}
                                </h3>
                                <p
                                    class="font-sans text-base sm:text-lg text-[var(--text-soft)] font-light leading-relaxed">
                                    {{ project.result.summary }}
                                </p>
                            </div>

                            <!-- Big Typographic Metrics Grid -->
                            <div v-if="project.result.metrics && project.result.metrics.length > 0"
                                class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-6 border-t border-[var(--border-subtle)]">
                                <div v-for="metric in project.result.metrics" :key="metric.label"
                                    class="p-4 rounded-xl bg-white/[0.02] border border-[var(--border-subtle)] space-y-2">
                                    <div
                                        class="display-font text-3xl sm:text-4xl lg:text-5xl font-black text-[var(--heading)] tracking-tighter leading-none">
                                        {{ metric.value }}
                                    </div>
                                    <div
                                        class="font-mono text-[9px] sm:text-[10px] tracking-[0.18em] uppercase text-[var(--muted)] font-medium leading-tight">
                                        {{ metric.label }}
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- 06. PROJECT GALLERY -->
                        <section v-if="project.gallery && project.gallery.length > 0" id="gallery"
                            class="cs-section-gallery space-y-10 pt-12 border-t border-[var(--border-subtle)] scroll-mt-32">
                            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-4">
                                <div>
                                    <h2
                                        class="display-font text-3xl sm:text-5xl font-black uppercase tracking-tighter text-[var(--heading)]">
                                        PROJECT GALLERY.
                                    </h2>
                                </div>
                                <span class="font-mono text-xs tracking-widest text-[var(--muted)] uppercase">
                                    {{ project.gallery.length }} FRAMES
                                </span>
                            </div>

                            <!-- Dynamic Gallery Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div v-for="(item, idx) in project.gallery" :key="idx" @click="openLightbox(item.url)"
                                    class="cs-gallery-item group relative flex flex-col justify-between rounded-2xl border border-[var(--border-subtle)] hover:border-white/30 bg-white/[0.02] p-4 transition-all duration-300 cursor-zoom-in overflow-hidden">
                                    <div
                                        class="relative aspect-[16/10] w-full rounded-xl bg-[#121316] overflow-hidden mb-4">
                                        <img :src="item.url" :alt="item.title || ('Gallery Image ' + (idx + 1))"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                                            loading="lazy" />
                                    </div>

                                    <div v-if="item.title || item.caption" class="pt-2">
                                        <h4 v-if="item.title"
                                            class="font-mono text-xs font-semibold tracking-wider text-[var(--heading)] uppercase mb-1">
                                            {{ item.title }}
                                        </h4>
                                        <p v-if="item.caption"
                                            class="font-sans text-xs text-[var(--muted)] font-light leading-relaxed">
                                            {{ item.caption }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- PREV / NEXT PROJECT NAVIGATION             -->
            <!-- ========================================== -->
            <section class="cs-section-nav w-full bg-[var(--bg)] border-t border-[var(--border-subtle)] py-20 sm:py-28">
                <div class="max-w-7xl mx-auto px-4 sm:px-8">
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-[var(--border-subtle)] border border-[var(--border-subtle)] rounded-2xl overflow-hidden">
                        <!-- PREVIOUS PROJECT -->
                        <router-link v-if="adjacent.prev" :to="'/projects/' + adjacent.prev.slug"
                            class="group p-8 sm:p-12 hover:bg-white/[0.02] transition-colors flex flex-col justify-between cursor-pointer">
                            <span
                                class="font-mono text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase mb-6 flex items-center gap-2">
                                <span class="transform group-hover:-translate-x-1 transition-transform">←</span>
                                <span>PREVIOUS WORK</span>
                            </span>
                            <div>
                                <span class="font-mono text-[10px] tracking-wider text-blue-400 uppercase block mb-1">
                                    {{ adjacent.prev.category }}
                                </span>
                                <h3
                                    class="display-font text-3xl sm:text-5xl font-black uppercase text-[var(--heading)] group-hover:text-white transition-colors leading-[0.9] tracking-tight">
                                    {{ adjacent.prev.title }}
                                </h3>
                            </div>
                        </router-link>
                        <div v-else class="p-8 sm:p-12 opacity-30 flex items-center">
                            <span class="font-mono text-xs tracking-widest text-[var(--muted)] uppercase">FIRST WORK IN
                                ARCHIVE</span>
                        </div>

                        <!-- NEXT PROJECT -->
                        <router-link v-if="adjacent.next" :to="'/projects/' + adjacent.next.slug"
                            class="group p-8 sm:p-12 hover:bg-white/[0.02] transition-colors flex flex-col justify-between text-right cursor-pointer">
                            <span
                                class="font-mono text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase mb-6 flex items-center justify-end gap-2">
                                <span>NEXT WORK</span>
                                <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                            <div>
                                <span class="font-mono text-[10px] tracking-wider text-blue-400 uppercase block mb-1">
                                    {{ adjacent.next.category }}
                                </span>
                                <h3
                                    class="display-font text-3xl sm:text-5xl font-black uppercase text-[var(--heading)] group-hover:text-white transition-colors leading-[0.9] tracking-tight">
                                    {{ adjacent.next.title }}
                                </h3>
                            </div>
                        </router-link>
                        <div v-else class="p-8 sm:p-12 opacity-30 flex items-center justify-end text-right">
                            <span class="font-mono text-xs tracking-widest text-[var(--muted)] uppercase">LAST WORK IN
                                ARCHIVE</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Lightbox Modal -->
        <Teleport to="body">
            <Transition name="modal-fade">
                <div v-if="activeLightboxImage"
                    class="fixed inset-0 z-[120] flex items-center justify-center p-4 sm:p-10 bg-black/95 backdrop-blur-xl"
                    @click="activeLightboxImage = null">
                    <div class="relative max-w-6xl max-h-[90vh] w-full flex flex-col items-center justify-center"
                        @click.stop>
                        <button @click="activeLightboxImage = null"
                            class="absolute -top-12 right-0 font-mono text-xs tracking-[0.2em] uppercase text-[var(--muted)] hover:text-white transition-colors cursor-pointer flex items-center gap-1.5">
                            <span>CLOSE</span>
                            <span>✕</span>
                        </button>
                        <img :src="activeLightboxImage" alt="Expanded Visual"
                            class="max-w-full max-h-[82vh] object-contain rounded-xl border border-white/20 shadow-2xl" />
                    </div>
                </div>
            </Transition>
        </Teleport>

        <FooterBar />
    </div>
</template>

<script setup>
import { computed, nextTick, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import FooterBar from '../components/FooterBar.vue';
import NotFoundView from './NotFoundView.vue';
import { getAdjacentProjects, resolveProjectData } from '../data/projectsData.js';
import { useGsap } from '../composables/useGsap';

const props = defineProps({
    slug: {
        type: String,
        default: ''
    }
});

const route = useRoute();
const currentSlug = computed(() => props.slug || route.params.slug);
const { gsap, ScrollTrigger, prefersReducedMotion } = useGsap();

const isLoading = ref(true);
const apiProjects = ref([]);
const project = ref(null);
const activeLightboxImage = ref(null);
const caseStudyRef = ref(null);

const scrollProgress = ref(0);
const activeSection = ref('overview');

let gsapContext = null;

const updateScrollMetrics = () => {
    const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
    if (totalHeight > 0) {
        const current = Math.min(100, Math.max(0, Math.round((window.scrollY / totalHeight) * 100)));
        scrollProgress.value = current;
    }

    const sections = ['overview', 'contribution', 'technologies', 'features', 'results', 'gallery'];
    for (let i = sections.length - 1; i >= 0; i--) {
        const el = document.getElementById(sections[i]);
        if (el) {
            const rect = el.getBoundingClientRect();
            if (rect.top <= 200) {
                activeSection.value = sections[i];
                break;
            }
        }
    }
};

const scrollToSection = (id) => {
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        activeSection.value = id;
    }
};

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
        await nextTick();
        initCaseStudyAnimations();
    }
};

const adjacent = computed(() => {
    return getAdjacentProjects(currentSlug.value, apiProjects.value);
});

const openLightbox = (url) => {
    activeLightboxImage.value = url;
};

const initCaseStudyAnimations = () => {
    if (gsapContext) gsapContext.revert();
    if (!caseStudyRef.value) return;

    if (prefersReducedMotion()) {
        gsap.set(['.cs-hero-meta', '.cs-hero-title', '.cs-hero-desc', '.cs-hero-actions', '.cs-hero-frame', '.cs-tech-badge', '.cs-feature-card', '.cs-gallery-item'], { opacity: 1, y: 0 });
        return;
    }

    gsapContext = gsap.context(() => {
        // Hero Timeline
        const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        heroTl.fromTo(
            '.cs-hero-meta',
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.6 }
        ).fromTo(
            '.cs-hero-title',
            { opacity: 0, y: 40, scale: 0.96 },
            { opacity: 1, y: 0, scale: 1, duration: 0.8 },
            '-=0.3'
        ).fromTo(
            '.cs-hero-desc',
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.6 },
            '-=0.4'
        ).fromTo(
            '.cs-hero-actions',
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.6 },
            '-=0.4'
        ).fromTo(
            '.cs-hero-frame',
            { opacity: 0, y: 50, scale: 0.97 },
            { opacity: 1, y: 0, scale: 1, duration: 1 },
            '-=0.3'
        );

        // Tech Badges Stagger
        const badges = gsap.utils.toArray('.cs-tech-badge');
        if (badges.length > 0) {
            gsap.fromTo(
                badges,
                { opacity: 0, scale: 0.9, y: 15 },
                {
                    opacity: 1,
                    scale: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.04,
                    ease: 'back.out(1.4)',
                    scrollTrigger: {
                        trigger: '.cs-tech-badges',
                        start: 'top 88%',
                        toggleActions: 'play none none none',
                    }
                }
            );
        }

        // Feature cards batch reveal
        ScrollTrigger.batch('.cs-feature-card', {
            start: 'top 85%',
            onEnter: (batch) => {
                gsap.fromTo(
                    batch,
                    { opacity: 0, y: 50 },
                    { opacity: 1, y: 0, duration: 0.8, stagger: 0.15, ease: 'power3.out' }
                );
            }
        });

        // Gallery items batch reveal
        ScrollTrigger.batch('.cs-gallery-item', {
            start: 'top 90%',
            onEnter: (batch) => {
                gsap.fromTo(
                    batch,
                    { opacity: 0, y: 40, scale: 0.98 },
                    { opacity: 1, y: 0, scale: 1, duration: 0.7, stagger: 0.1, ease: 'power3.out' }
                );
            }
        });
    }, caseStudyRef.value);
};

watch(
    () => project.value?.title,
    (title) => {
        if (title) {
            document.title = `${title} - Portfolio`;
        }
    },
    { immediate: true }
);

// Re-fetch / resolve when route slug changes
watch(
    () => route.params.slug,
    async (newSlug) => {
        if (newSlug) {
            project.value = resolveProjectData(newSlug, apiProjects.value);
            window.scrollTo({ top: 0, behavior: 'smooth' });
            await nextTick();
            initCaseStudyAnimations();
        }
    }
);

onMounted(() => {
    fetchProjectsAndHydrate();
    window.addEventListener('scroll', updateScrollMetrics, { passive: true });
    window.scrollTo({ top: 0 });
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', updateScrollMetrics);
    if (gsapContext) gsapContext.revert();
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
