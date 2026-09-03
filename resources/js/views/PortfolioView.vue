<template>
    <div class="page" ref="pageRef">
        <!--
        THESIS: Replaces the hollow cutout standee slot with an architectural monograph dossier—pairing real mountain summit portraiture with technical telemetry, live availability signals, and kinetic parallax hierarchy, refusing generic cookie-cutter portfolio cards.
        OWN-WORLD: Obsidian backdrop (#09090b), zinc-800 architectural hairlines, pure white display typography, cobalt focal accents (#2563eb), and tactile glass telemetry cards with subtle border glow.
        STORY: Visitors immediately grasp Naufal's persona as an engineering craftsman: viewing real summit photography framed by geographic coordinates, technical discipline badges, and living availability status before reading the core mission statement.
        FIRST VIEWPORT: Left: Monumental display statement ('ARCHITECTING SYSTEMS INTO REALITIES') with live coordinate badge; Center/Right: Architectural vertical dossier frame housing guwe.jpeg with parallax depth scrub and floating telemetry tags; Right/Bottom: Concise engineering manifesto and direct project index anchors.
        FORM: Editorial Architectural Monograph Dossier with kinetic scrub, seed 0904e589.
        FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance.
        -->
        <HeaderBar />
        <FooterBar />

        <!-- Hero Section: Editorial Typography Anchor -->
        <section ref="heroSectionRef"
            class="hero-section relative min-h-[100dvh] w-full flex items-center justify-center bg-[var(--bg)] text-[var(--text)] overflow-hidden px-4 sm:px-8"
            id="top">
            <div ref="heroGridLinesRef" class="hero-grid-lines absolute inset-0 pointer-events-none opacity-20"></div>

            <!-- Center Massive Display Typography -->
            <div ref="heroContentRef"
                class="w-full flex flex-col items-center justify-center relative z-10 select-none">
                <h1 ref="heroH1Ref"
                    class="font-black tracking-tighter leading-none uppercase text-center display-font whitespace-nowrap flex items-baseline select-none"
                    :style="{
                        fontSize: heroFontSize,
                    }">
                    <span class="greeting-roller" ref="rollerRef">
                        <Transition name="greeting-roll">
                            <span :key="currentGreetingIdx" class="greeting-word">{{
                                greetings[currentGreetingIdx]
                            }}</span>
                        </Transition>
                    </span>
                </h1>
            </div>

            <!-- Structural Metadata Overlay (Editorial Touch) -->
            <div ref="heroMetaRef"
                class="absolute bottom-16 sm:bottom-12 left-4 sm:left-8 right-4 sm:right-8 flex justify-between items-end text-[9px] sm:text-[10px] tracking-[0.2em] uppercase font-sans text-[var(--muted)] pointer-events-none z-10">
                <div class="hero-meta-left">
                    <span class="block text-[var(--text)] font-semibold mb-0.5 sm:mb-1">NAUFAL TSAQIF</span>
                </div>
                <div class="hero-meta-right text-right">
                    <span class="hidden sm:inline">EXPLORE BELOW </span>
                    <span
                        class="inline-block text-[var(--text)] font-semibold text-xs sm:text-base leading-none">↓</span>
                </div>
            </div>
        </section>

        <!-- Portfolio Profile Section: Editorial Architectural Monograph Dossier -->
        <section ref="profileSectionRef"
            class="profile-section w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 xl:px-12 py-20 sm:py-32 border-t border-[var(--border-subtle)] relative overflow-hidden"
            id="profile">

            <!-- Ambient Atmospheric Background Glow -->
            <div
                class="pointer-events-none absolute inset-0 flex items-center justify-center overflow-hidden opacity-30">
                <div
                    class="w-[900px] h-[600px] rounded-full bg-[radial-gradient(circle,rgba(37,99,235,0.12)_0%,rgba(0,0,0,0)_70%)] blur-3xl">
                </div>
            </div>

            <div class="max-w-7xl mx-auto relative z-10">
                <!-- Telemetry & Status Anchor Bar (Clean functional metadata, no artificial kickers) -->
                <div
                    class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-12 sm:mb-16 border-b border-[var(--border-subtle)] font-mono text-[10px] sm:text-[11px] tracking-[0.2em] text-[var(--muted)] uppercase">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-2 text-emerald-400 font-medium">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            AVAILABLE FOR SELECT ROLES &amp; CLIENT PROJECTS
                        </span>
                    </div>
                </div>

                <!-- Main Editorial Spread: Asymmetrical 2-Column Architectural Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                    <!-- Left Column: Monumental Headline, Mission Manifesto & Domain Matrix (7 Cols) -->
                    <div class="lg:col-span-7 flex flex-col justify-between">
                        <div>
                            <h2
                                class="profile-title text-[13vw] sm:text-[9vw] lg:text-[4.8rem] xl:text-[5.4rem] font-black uppercase leading-[0.86] tracking-tighter display-font text-[var(--heading)] mb-8">
                                ARCHITECTING<br />SYSTEMS INTO<br />REALITIES.
                            </h2>

                            <!-- Editorial Narrative / Manifesto -->
                            <div class="space-y-4 max-w-[52ch] mb-10 text-[var(--text-soft)]">
                                <p
                                    class="text-lg sm:text-xl lg:text-2xl leading-snug font-normal text-[var(--heading)]">
                                    Naufal Tsaqif - Informatics Engineer bridging low-level system mechanics, 3D
                                    interactive graphics, and tactile web interfaces.
                                </p>
                                <p class="text-xs sm:text-sm leading-relaxed font-light">
                                    Specializing in Unity 3D (C#), spatial mechanics, and robust web architectures with
                                    Vue 3 and Laravel. Crafting high-performance engineering logic paired with fluid,
                                    kinetic interaction design.
                                </p>
                            </div>
                        </div>

                        <!-- Technical Domains & Engineering Telemetry Grid -->
                        <div
                            class="pt-8 border-t border-[var(--border-subtle)] grid grid-cols-1 sm:grid-cols-2 gap-4 font-sans text-xs tracking-wider uppercase mb-8">
                            <div
                                class="space-y-1.5 p-4 rounded-xl bg-white/[0.02] border border-[var(--border-subtle)]">
                                <span class="block text-[10px] tracking-[0.2em] text-[var(--muted)] font-mono">CORE
                                    DISCIPLINE</span>
                                <span class="block text-[var(--heading)] font-semibold text-sm">INFORMATICS
                                    ENGINEERING</span>
                                <span
                                    class="block text-[11px] text-[var(--text-soft)] normal-case tracking-normal">Distributed
                                    logic, relational schema &amp; spatial computing</span>
                            </div>
                            <div
                                class="space-y-1.5 p-4 rounded-xl bg-white/[0.02] border border-[var(--border-subtle)]">
                                <span class="block text-[10px] tracking-[0.2em] text-[var(--muted)] font-mono">PRIMARY
                                    ENGINES</span>
                                <span class="block text-[var(--heading)] font-semibold text-sm">UNITY 3D &amp; MODERN
                                    WEB</span>
                                <span class="block text-[11px] text-[var(--text-soft)] normal-case tracking-normal">C#,
                                    OpenXR, Vue 3, Tailwind CSS &amp; Laravel</span>
                            </div>
                        </div>

                        <!-- Direct Navigation Actions -->
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="#projects"
                                class="inline-flex items-center gap-3 px-6 py-3.5 rounded-full bg-white text-black font-bold text-xs tracking-wider uppercase hover:opacity-90 transition-all hover:gap-4 group shadow-md">
                                <span class="text-black">EXPLORE CASE STUDIES</span>
                                <span class="text-black transition-transform group-hover:translate-y-0.5">↓</span>
                            </a>
                            <a href="https://github.com/IamNopall" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-[var(--border-subtle)] text-[var(--heading)] text-xs font-semibold tracking-wider uppercase hover:border-[var(--heading)] hover:bg-white/[0.03] transition-all">
                                <span>GITHUB ARCHIVE</span>
                                <span class="text-xs">↗</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Architectural Photographic Dossier Frame (5 Cols) -->
                    <div class="lg:col-span-5 flex flex-col items-center lg:items-end">
                        <div
                            class="relative w-full max-w-[460px] aspect-[4/5] rounded-2xl overflow-hidden border border-white/10 shadow-2xl shadow-black/60 bg-[#121316] group">

                            <!-- guwe.jpeg Image with GSAP Differential Parallax Scrub -->
                            <img ref="standeeImgRef" src="../../images/guwe.jpeg" alt="Naufal Tsaqif summit portrait"
                                class="dossier-photo w-full h-[120%] -top-[10%] absolute object-cover object-[center_35%] will-change-transform transition-transform duration-700 ease-out group-hover:scale-105" />

                            <!-- Gradient Overlays for Cinematic Atmosphere -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-black/30 pointer-events-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Capabilities & Tools -->
                <div ref="techSectionRef" class="pt-24 sm:pt-32 relative z-10" id="about">
                    <div class="tech-header flex justify-between items-end mb-12 sm:mb-16">
                        <div>
                            <h3
                                class="text-[10vw] sm:text-[6vw] lg:text-[4rem] font-black uppercase leading-[0.88] tracking-tighter display-font text-[var(--heading)]">
                                TECHNICAL INDEX
                            </h3>
                        </div>
                        <span
                            class="hidden sm:inline-block font-sans text-[10px] tracking-[0.2em] uppercase text-[var(--muted)]">
                            SYSTEMS &amp; STACK
                        </span>
                    </div>

                    <div class="tech-stack-list border-t border-[var(--border-subtle)]">
                        <div v-for="(group, idx) in stackGroups" :key="group.title"
                            class="tech-group-row grid grid-cols-1 md:grid-cols-[0.25fr_0.75fr] gap-6 py-8 sm:py-10 border-b border-[var(--border-subtle)] items-start">

                            <div
                                class="flex items-center gap-3 font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase">
                                <span class="text-[var(--text)] font-mono font-semibold">0{{ idx + 1 }}</span>
                                <span class="w-4 h-[1px] bg-[var(--border-subtle)]"></span>
                                <span>{{ group.title }}</span>
                            </div>

                            <div class="tech-badges-wrap flex flex-wrap gap-x-8 gap-y-4 items-center">
                                <div v-for="item in group.items" :key="item.name"
                                    class="tech-badge-item group/item flex items-center gap-2.5 cursor-pointer">
                                    <img :src="item.iconUrl ?? `https://cdn.simpleicons.org/${item.icon}`"
                                        :alt="`${item.name} icon`"
                                        class="w-3.5 h-3.5 opacity-60 grayscale group-hover/item:opacity-100 group-hover/item:grayscale-0 transition-all duration-300 transform group-hover/item:scale-110"
                                        loading="lazy" />
                                    <span
                                        class="font-sans text-xs sm:text-sm tracking-[0.12em] uppercase text-[var(--text-soft)] group-hover/item:text-[var(--heading)] transition-colors">
                                        {{ item.name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section: Minimalist Editorial Showcase -->
        <section ref="projectsSectionRef"
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 xl:px-12 py-24 sm:py-36 border-t border-[var(--border-subtle)] overflow-hidden"
            id="projects">
            <div class="w-full max-w-[1560px] mx-auto">
                <!-- Section Header / Meta -->
                <div
                    class="projects-header-meta flex justify-between items-baseline mb-10 sm:mb-14 font-sans text-[10px] sm:text-[11px] tracking-[0.25em] text-[var(--muted)] uppercase">
                    <p>03 / SELECTED WORKS</p>
                    <p class="tracking-widest tabular-nums">{{ filteredProjects.length }} OF {{ projects.length }} WORKS
                    </p>
                </div>

                <!-- Headline & Controls -->
                <div
                    class="projects-controls-bar flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-12 sm:mb-16 pb-8 border-b border-[var(--border-subtle)]">
                    <div>
                        <h2 class="display-font font-black uppercase leading-[0.88] tracking-tighter text-[var(--heading)]"
                            style="font-size: clamp(2.75rem, 6.5vw, 5.5rem);">
                            SELECTED WORKS.
                        </h2>
                        <p
                            class="font-sans text-xs sm:text-sm text-[var(--text-soft)] mt-3 max-w-lg font-light leading-relaxed">
                            Curated portfolio of interactive experiences, game mechanics, and web applications.
                        </p>
                    </div>

                    <!-- Filter & Search Controls (Minimalist Toolbar) -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6 shrink-0">
                        <!-- Minimalist Search Input -->
                        <div class="relative min-w-[200px] sm:min-w-[260px]">
                            <input v-model="projectSearch" type="text" placeholder="SEARCH WORK..."
                                class="w-full bg-transparent border-b border-[var(--border-subtle)] focus:border-[var(--heading)] px-1 py-2 text-xs font-sans text-[var(--heading)] placeholder:text-[var(--muted)]/50 focus:outline-none transition-colors uppercase tracking-[0.18em]" />
                            <button v-if="projectSearch" @click="projectSearch = ''"
                                class="absolute inset-y-0 right-0 pr-1 flex items-center text-xs text-[var(--muted)] hover:text-[var(--heading)] transition-colors">
                                ✕
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category Filter Line (Minimalist Clean Navigation) -->
                <div
                    class="projects-category-bar flex items-center gap-6 sm:gap-8 overflow-x-auto pb-4 mb-12 sm:mb-16 scrollbar-none border-b border-[var(--border-subtle)]/50">
                    <button v-for="cat in projectCategories" :key="cat"
                        class="font-sans text-[11px] tracking-[0.2em] uppercase py-2 transition-all relative whitespace-nowrap cursor-pointer"
                        :class="activeCategory === cat
                            ? 'text-[var(--heading)] font-bold'
                            : 'text-[var(--muted)] hover:text-[var(--heading)]'
                            " @click="selectCategory(cat)">
                        <span>{{ cat }}</span>
                        <span class="ml-1 text-[9px] tabular-nums opacity-60">
                            ({{
                                cat === 'All'
                                    ? projects.length
                                    : projects.filter((p) => p.category === cat).length
                            }})
                        </span>
                        <span v-if="activeCategory === cat"
                            class="absolute bottom-0 left-0 right-0 h-[2px] bg-[var(--heading)] transition-all"></span>
                    </button>
                </div>

                <!-- Empty State -->
                <div v-if="filteredProjects.length === 0"
                    class="py-24 text-center border border-[var(--border-subtle)]/60 p-8">
                    <p class="display-font text-3xl sm:text-4xl font-black uppercase text-[var(--muted)] mb-2">NO WORKS
                        FOUND</p>
                    <p class="font-sans text-xs text-[var(--muted)] max-w-sm mx-auto mb-6">
                        No projects match your current filter or search criteria.
                    </p>
                    <button @click="resetFilters"
                        class="font-sans text-[10px] tracking-[0.2em] uppercase px-6 py-2.5 border border-[var(--heading)] text-[var(--heading)] font-bold hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors cursor-pointer">
                        RESET FILTER
                    </button>
                </div>

                <!-- EDITORIAL 3-COLUMN CENTRAL-MEDIA SHOWCASE (Matching Reference Image) -->
                <div v-else class="relative w-full border-t border-[var(--border-subtle)]">
                    <!-- Desktop Editorial View (>= lg) -->
                    <div class="hidden lg:block relative min-h-[580px]">
                        <!-- Center Floating Visual Preview Container (Natural Sizing without Forced Crop) -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 px-4">
                            <div
                                class="relative max-w-[460px] xl:max-w-[560px] 2xl:max-w-[620px] max-h-[560px] xl:max-h-[620px] flex items-center justify-center">
                                <div
                                    class="relative overflow-hidden border border-[var(--border-subtle)] bg-[var(--hover-bg)] shadow-2xl">
                                    <img ref="centerImageRef"
                                        :src="activeProject?.image || '/images/projects/aquaverse-hero.jpg'"
                                        :alt="activeProject?.title"
                                        class="max-w-full max-h-[540px] xl:max-h-[600px] w-auto h-auto object-contain select-none transition-transform duration-500" />
                                    <!-- Ambient Vignette Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-40 pointer-events-none">
                                    </div>
                                    <!-- Bottom Badge Info -->
                                    <div
                                        class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-[9px] tracking-[0.2em] font-sans uppercase text-white/90 z-20 pointer-events-none">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rows Split Left & Right across Center Void -->
                        <div class="divide-y divide-[var(--border-subtle)] border-b border-[var(--border-subtle)]">
                            <div v-for="(project, i) in filteredProjects" :key="project.id ?? project.title"
                                @mouseenter="setHoveredProject(project)" @click="openProjectDetail(project)"
                                class="project-row group grid grid-cols-[1fr_460px_1fr] xl:grid-cols-[1fr_560px_1fr] 2xl:grid-cols-[1fr_620px_1fr] items-center py-7 xl:py-9 px-2 sm:px-4 cursor-pointer transition-all duration-300 relative z-20"
                                :class="activeProject?.title === project.title ? 'is-active-project opacity-100' : 'is-inactive-project opacity-35 hover:opacity-85'">

                                <!-- Left Column: [Year] -->
                                <div class="font-mono text-xs xl:text-sm tracking-[0.22em] transition-colors duration-300"
                                    :class="activeProject?.title === project.title ? 'text-[var(--heading)] font-bold' : 'text-[var(--muted)]/50 group-hover:text-[var(--heading)]'">
                                    <span>[{{ project.year || '2026' }}]</span>
                                </div>

                                <!-- Center Column Void for Visual Preview -->
                                <div class="pointer-events-none h-full"></div>

                                <!-- Right Column: [Category] + Title -->
                                <div class="text-right flex flex-col items-end">
                                    <span
                                        class="font-mono text-[9px] xl:text-[10.5px] tracking-[0.22em] uppercase transition-colors duration-300 mb-1"
                                        :class="activeProject?.title === project.title ? 'text-[var(--text-soft)] font-medium' : 'text-[var(--muted)]/50 group-hover:text-[var(--text-soft)]'">
                                        [{{ (project.category || 'CASE STUDY').toUpperCase() }}]
                                    </span>
                                    <h3 class="display-font font-black uppercase text-2xl sm:text-3xl xl:text-[2.75rem] tracking-tight leading-none transition-colors duration-300"
                                        :class="activeProject?.title === project.title ? 'text-[var(--heading)]' : 'text-[var(--muted)]/40 group-hover:text-[var(--heading)]'">
                                        {{ project.title }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile & Tablet Responsive Editorial List (< lg) -->
                    <div
                        class="lg:hidden divide-y divide-[var(--border-subtle)] border-b border-[var(--border-subtle)]">
                        <div v-for="(project, i) in filteredProjects" :key="'mob-' + (project.id ?? project.title)"
                            @click="openProjectDetail(project)"
                            class="project-row py-8 px-2 flex flex-col gap-4 cursor-pointer group">

                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs tracking-[0.2em] text-[var(--muted)]">
                                    [{{ project.year || '2026' }}]
                                </span>
                                <span class="font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                    [{{ (project.category || 'CASE STUDY').toUpperCase() }}]
                                </span>
                            </div>

                            <!-- Mobile Image Preview -->
                            <div
                                class="relative w-full aspect-[16/10] bg-[var(--hover-bg)] border border-[var(--border-subtle)] overflow-hidden">
                                <img :src="project.image || '/images/projects/aquaverse-hero.jpg'" :alt="project.title"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy" />
                            </div>

                            <div class="flex items-center justify-between">
                                <h3
                                    class="display-font font-black uppercase text-3xl tracking-tight leading-none text-[var(--heading)]">
                                    {{ project.title }}
                                </h3>
                                <span
                                    class="text-xs font-mono tracking-widest text-[var(--heading)] group-hover:translate-x-1 transition-transform">
                                    VIEW ↗
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section ref="contactSectionRef"
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-24 sm:py-40 border-t border-[var(--border-subtle)] flex flex-col items-center justify-center text-center overflow-hidden"
            id="contact">
            <p class="contact-eyebrow font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase mb-8">
                04 / GET IN TOUCH
            </p>
            <a href="mailto:naufaltsq333@gmail.com"
                class="contact-title text-[14vw] md:text-[11vw] font-black uppercase tracking-tighter leading-none hover:text-[var(--accent-blue)] transition-colors display-font inline-block">
                LET'S TALK
            </a>
            <p class="contact-email mt-8 font-sans text-xs tracking-[0.2em] text-[var(--muted)] uppercase">
                naufaltsq333@gmail.com
            </p>

            <!-- Social Links: GitHub & LinkedIn -->
            <div class="contact-socials mt-8 flex items-center justify-center gap-4">
                <a href="https://github.com/IamNopall" target="_blank" rel="noopener noreferrer"
                    class="p-2.5 border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--muted)] hover:text-[var(--heading)] rounded-full transition-all hover:scale-110 inline-flex items-center justify-center"
                    title="GitHub" aria-label="GitHub Profile">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                    </svg>
                </a>
                <a href="https://www.linkedin.com/in/naufal-tsaqif-athala-irchamto" target="_blank"
                    rel="noopener noreferrer"
                    class="p-2.5 border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--muted)] hover:text-[var(--heading)] rounded-full transition-all hover:scale-110 inline-flex items-center justify-center"
                    title="LinkedIn" aria-label="LinkedIn Profile">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                    </svg>
                </a>
            </div>
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
import { useRouter } from "vue-router";
import FooterBar from "../components/FooterBar.vue";
import HeaderBar from "../components/HeaderBar.vue";
import { slugify } from "../data/projectsData.js";
import { useGsap } from "../composables/useGsap";

const router = useRouter();
const { gsap, ScrollTrigger, prefersReducedMotion } = useGsap();

// Template Refs for GSAP
const pageRef = ref(null);
const heroSectionRef = ref(null);
const heroGridLinesRef = ref(null);
const heroContentRef = ref(null);
const heroH1Ref = ref(null);
const rollerRef = ref(null);
const heroMetaRef = ref(null);

const profileSectionRef = ref(null);
const standeeContainerRef = ref(null);
const spotlightRef = ref(null);
const floorGlowRef = ref(null);
const floorShadowRef = ref(null);
const standeeImgRef = ref(null);

const techSectionRef = ref(null);
const projectsSectionRef = ref(null);
const projectsGridRef = ref(null);
const projectsListRef = ref(null);
const contactSectionRef = ref(null);

let gsapContext = null;
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
const heroFontSize = ref("16vw");

const syncFontSize = () => {
    const text = greetings[currentGreetingIdx.value];

    let w = 0;
    for (const ch of text) {
        if (/[\u3040-\u30ff\u4e00-\u9fff\uac00-\ud7af]/.test(ch))
            w += 1.0;
        else if (ch === " ") w += 0.35;
        else w += 0.58;
    }
    const estVw = parseFloat(Math.min(16, 88 / w).toFixed(2));
    heroFontSize.value = estVw + "vw";

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
        ScrollTrigger.refresh();
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

const projects = ref([]);
const projectSearch = ref("");
const hoveredProject = ref(null);
const centerImageRef = ref(null);

const activeProject = computed(() => {
    return hoveredProject.value || filteredProjects.value[0] || null;
});

const setHoveredProject = (proj) => {
    if (!proj || hoveredProject.value?.title === proj.title) return;
    hoveredProject.value = proj;

    if (centerImageRef.value && !prefersReducedMotion()) {
        gsap.fromTo(
            centerImageRef.value,
            { opacity: 0.5, scale: 0.96 },
            { opacity: 1, scale: 1, duration: 0.35, ease: 'power2.out', overwrite: 'auto' }
        );
    }
};

const fetchProjects = async () => {
    try {
        const res = await fetch("/api/projects");
        const json = await res.json();
        if (json.success && Array.isArray(json.data)) {
            const apiData = json.data.map(p => {
                const slug = slugify(p.title);
                if (!p.image) {
                    if (slug === 'void-walker') p.image = '/images/projects/voidwalker-hero.jpg';
                    else if (slug === 'aquaverse') p.image = '/images/projects/aquaverse-hero.jpg';
                    else if (slug === 'nopal-dev') p.image = '/images/projects/aquaverse-hero.jpg';
                }
                return p;
            });

            const hasAquaverse = apiData.some(p => slugify(p.title) === 'aquaverse');
            if (!hasAquaverse) {
                projects.value = [
                    {
                        id: 99,
                        title: 'AQUAVERSE',
                        category: 'VR Development',
                        year: '2026',
                        desc: 'VR Educational Media for Aquaculture & Deep-Sea Ecosystems built with Unity and OpenXR.',
                        image: '/images/projects/aquaverse-hero.jpg',
                        tags: ['Unity 3D', 'C#', 'OpenXR', 'Meta Quest 2']
                    },
                    ...apiData
                ];
            } else {
                projects.value = apiData;
            }
        }
    } catch (err) {
        console.error("Failed to fetch projects:", err);
    }
};

const projectCategories = computed(() => {
    const cats = new Set(projects.value.map((p) => p.category));
    return ["All", ...Array.from(cats)];
});
const activeCategory = ref("All");

const filteredProjects = computed(() => {
    return projects.value.filter((p) => {
        const matchesCategory =
            activeCategory.value === "All" || p.category === activeCategory.value;
        const q = projectSearch.value.toLowerCase().trim();
        if (!q) return matchesCategory;

        const matchesTitle = p.title?.toLowerCase().includes(q);
        const matchesDesc = p.desc?.toLowerCase().includes(q);
        const matchesTags = Array.isArray(p.tags) && p.tags.some((t) => t.toLowerCase().includes(q));

        return matchesCategory && (matchesTitle || matchesDesc || matchesTags);
    });
});

const animateProjectCards = async () => {
    await nextTick();
    if (prefersReducedMotion()) return;

    const rows = document.querySelectorAll('.project-row');
    if (rows.length === 0) return;

    gsap.fromTo(
        rows,
        { opacity: 0, y: 25 },
        {
            opacity: 1,
            y: 0,
            duration: 0.45,
            stagger: 0.05,
            ease: 'power3.out',
            overwrite: 'auto',
            clearProps: 'opacity',
        }
    );
};

const selectCategory = (cat) => {
    activeCategory.value = cat;
    hoveredProject.value = null;
    animateProjectCards();
};

const resetFilters = () => {
    activeCategory.value = "All";
    projectSearch.value = "";
    hoveredProject.value = null;
    animateProjectCards();
};

watch(projectSearch, () => {
    hoveredProject.value = null;
    animateProjectCards();
});

const openProjectDetail = (proj) => {
    if (!proj) return;
    const slug = proj.slug || slugify(proj.title);
    router.push('/projects/' + slug);
};

const initGsapAnimations = () => {
    if (prefersReducedMotion()) {
        // Fallback for reduced motion
        gsap.set(['.hero-meta-left', '.hero-meta-right', '.profile-header-meta', '.profile-left-col', '.profile-right-col', '.tech-header', '.tech-group-row', '.projects-header-meta', '.projects-controls-bar', '.projects-category-bar', '.project-card', '.contact-eyebrow', '.contact-title', '.contact-email', '.contact-socials'], { opacity: 1, y: 0 });
        if (standeeImgRef.value) gsap.set(standeeImgRef.value, { opacity: 0.9, y: 0, scale: 1 });
        return;
    }

    gsapContext = gsap.context(() => {
        // ==========================================
        // 1. HERO LOAD & SCROLL ANIMATIONS
        // ==========================================
        const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        heroTl.fromTo(
            heroGridLinesRef.value,
            { opacity: 0 },
            { opacity: 0.2, duration: 1.2 }
        ).fromTo(
            '.hero-meta-left, .hero-meta-right',
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.8, stagger: 0.15 },
            '-=0.6'
        );

        // Hero Greeting Scroll Parallax Fade Out (explicitly opacity 1 at scroll 0)
        if (heroContentRef.value) {
            gsap.fromTo(
                heroContentRef.value,
                { opacity: 1, y: 0 },
                {
                    opacity: 0.15,
                    y: -80,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: heroSectionRef.value,
                        start: 'top top',
                        end: 'bottom 40%',
                        scrub: 1,
                        invalidateOnRefresh: true,
                    },
                }
            );
        }

        // ==========================================
        // 2. PROFILE & STANDEE MULTI-PLANE PARALLAX
        // ==========================================
        // Profile Header Meta Reveal
        gsap.fromTo(
            '.profile-header-meta',
            { opacity: 0, y: 25 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.profile-header-meta',
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        );

        // Profile Left Title & Meta Reveal
        gsap.fromTo(
            '.profile-left-col',
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 0.9,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.profile-left-col',
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                },
            }
        );

        // Profile Right Editorial Paragraphs Reveal
        gsap.fromTo(
            '.profile-right-col',
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.9,
                delay: 0.15,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.profile-right-col',
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                },
            }
        );

        // Architectural Dossier Parallax Scrub
        if (standeeImgRef.value && profileSectionRef.value) {
            gsap.to(standeeImgRef.value, {
                yPercent: 14,
                ease: 'none',
                scrollTrigger: {
                    trigger: profileSectionRef.value,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1.2,
                },
            });
        }

        // ==========================================
        // 3. TECHNICAL INDEX / CAPABILITIES STAGGER
        // ==========================================
        gsap.fromTo(
            '.tech-header',
            { opacity: 0, y: 35 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.tech-header',
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        );

        const techRows = gsap.utils.toArray('.tech-group-row');
        techRows.forEach((row, i) => {
            gsap.fromTo(
                row,
                { opacity: 0, y: 30 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: row,
                        start: 'top 88%',
                        toggleActions: 'play none none none',
                    },
                }
            );

            const badges = row.querySelectorAll('.tech-badge-item');
            if (badges.length > 0) {
                gsap.fromTo(
                    badges,
                    { opacity: 0, scale: 0.9, y: 10 },
                    {
                        opacity: 1,
                        scale: 1,
                        y: 0,
                        duration: 0.5,
                        stagger: 0.05,
                        ease: 'back.out(1.4)',
                        scrollTrigger: {
                            trigger: row,
                            start: 'top 85%',
                            toggleActions: 'play none none none',
                        },
                    }
                );
            }
        });

        // ==========================================
        // 4. SELECTED WORKS SHOWCASE STAGGER
        // ==========================================
        gsap.fromTo(
            '.projects-header-meta',
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.projects-header-meta',
                    start: 'top 88%',
                    toggleActions: 'play none none none',
                },
            }
        );

        gsap.fromTo(
            '.projects-controls-bar',
            { opacity: 0, y: 35 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.projects-controls-bar',
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        );

        gsap.fromTo(
            '.projects-category-bar',
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.projects-category-bar',
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        );

        // ScrollTrigger for Project Rows initial view
        ScrollTrigger.batch('.project-row', {
            start: 'top 92%',
            onEnter: (batch) => {
                gsap.fromTo(
                    batch,
                    { opacity: 0, y: 30 },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        stagger: 0.08,
                        ease: 'power3.out',
                        overwrite: 'auto',
                        clearProps: 'opacity',
                    }
                );
            },
        });

        // ==========================================
        // 5. CONTACT SECTION KINETIC REVEAL
        // ==========================================
        const contactTl = gsap.timeline({
            scrollTrigger: {
                trigger: contactSectionRef.value,
                start: 'top 80%',
                toggleActions: 'play none none none',
            },
        });

        contactTl.fromTo(
            '.contact-eyebrow',
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' }
        ).fromTo(
            '.contact-title',
            { opacity: 0, y: 50, scale: 0.92 },
            { opacity: 1, y: 0, scale: 1, duration: 0.9, ease: 'power3.out' },
            '-=0.4'
        ).fromTo(
            '.contact-email',
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' },
            '-=0.4'
        ).fromTo(
            '.contact-socials',
            { opacity: 0, y: 20, scale: 0.95 },
            { opacity: 1, y: 0, scale: 1, duration: 0.6, ease: 'back.out(1.5)' },
            '-=0.3'
        );
    }, pageRef.value);
};

onMounted(async () => {
    await fetchProjects();

    greetingTimer = setInterval(() => {
        currentGreetingIdx.value =
            (currentGreetingIdx.value + 1) % greetings.length;
    }, 2500);

    await document.fonts.ready;
    syncFontSize();
    window.addEventListener("resize", handleResize);

    // Initialize GSAP
    await nextTick();
    initGsapAnimations();
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", handleResize);
    if (greetingTimer) clearInterval(greetingTimer);
    if (gsapContext) gsapContext.revert();
});
</script>
