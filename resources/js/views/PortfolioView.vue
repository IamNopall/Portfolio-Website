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
                class="absolute bottom-16 sm:bottom-12 left-4 sm:left-8 right-4 sm:right-8 flex justify-between items-end text-[9px] sm:text-[10px] tracking-[0.2em] uppercase font-sans text-[var(--muted)] pointer-events-none">
                <div>
                    <span class="block text-[var(--text)] font-semibold mb-0.5 sm:mb-1">NAUFAL TSAQIF</span>
                    <span class="hidden sm:inline-block">INFORMATICS · GAME DEV · FRONTEND</span>
                </div>
                <div class="text-right">
                    <span class="hidden sm:inline">EXPLORE BELOW </span>
                    <span
                        class="inline-block text-[var(--text)] font-semibold text-xs sm:text-base leading-none">↓</span>
                </div>
            </div>
        </section>

        <!-- Portfolio Profile Section: Typography-Driven Editorial Layout with Backlit Character Silhouette -->
        <section
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-20 sm:py-32 border-t border-[var(--border-subtle)] overflow-hidden"
            id="profile">

            <div class="max-w-7xl mx-auto relative">
                <!-- Relative Wrapper to constrain the standee background to this sub-section -->
                <div class="relative w-full">
                    <!-- Atmospheric Central Backlight & Silhouette Character -->
                    <div ref="standeeContainerRef"
                        class="standee-container absolute bottom-0 left-0 right-0 pointer-events-none hidden lg:flex items-center justify-center z-0 overflow-hidden h-[750px] reveal"
                        :style="silhouetteParallaxStyle">
                        <!-- Radial Spotlight Glow -->
                        <div
                            class="absolute w-[900px] h-[900px] rounded-full bg-[radial-gradient(circle,rgba(255,255,255,0.22)_0%,rgba(0,0,0,0)_70%)] light-mode:bg-[radial-gradient(circle,rgba(0,0,0,0.08)_0%,rgba(0,0,0,0)_70%)] blur-3xl opacity-80">
                        </div>



                        <!-- Ground Lighting Floor Oval -->
                        <div
                            class="absolute bottom-[100px] w-[680px] h-[90px] rounded-[100%] bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.3)_0%,rgba(255,255,255,0.1)_40%,transparent_75%)] light-mode:bg-[radial-gradient(ellipse_at_center,rgba(0,0,0,0.12)_0%,rgba(0,0,0,0.03)_40%,transparent_75%)] blur-xl opacity-90">
                        </div>

                        <!-- Ambient Feet Floor Shadow -->
                        <div
                            class="absolute bottom-[102px] w-[360px] h-[18px] rounded-[100%] bg-black/60 light-mode:bg-black/45 blur-md z-0">
                        </div>

                        <!-- Tight Ground Contact Shoe Sole Shadows -->
                        <div
                            class="absolute bottom-[100px] w-[260px] h-[10px] rounded-[100%] bg-black/80 blur-[3px] z-0 hidden light-mode:block">
                        </div>

                        <!-- Dark Mode Silhouette Standee -->
                        <img src="../../images/profile-silhouette.png" alt="Naufal Tsaqif Silhouette"
                            class="standee-dark h-[88%] max-h-[750px] w-auto object-contain object-bottom contrast-125 filter drop-shadow-[0_0_40px_rgba(255,255,255,0.25)] brightness-110 z-10" />

                        <!-- Light Mode Backlit Body Silhouette Shadow -->
                        <img src="../../images/profile-silhouette.png" alt="Naufal Tsaqif Shadow Backing"
                            class="standee-light-shadow h-[88%] max-h-[750px] w-auto object-contain object-bottom filter blur-[10px] opacity-0 z-0 pointer-events-none" />

                        <!-- Light Mode Color Standee -->
                        <img src="../../images/profile-color.png" alt="Naufal Tsaqif Color Portrait"
                            class="standee-light h-[88%] max-h-[750px] w-auto object-contain object-bottom filter drop-shadow-[0_0_35px_rgba(0,0,0,0.14)] z-10" />
                    </div>

                    <!-- Section Header / Meta Anchor -->
                    <div
                        class="flex justify-between items-baseline mb-12 sm:mb-20 font-sans text-[10px] sm:text-[11px] tracking-[0.25em] text-[var(--muted)] uppercase reveal relative z-10">
                        <p>01 / INDEX &amp; PROFILE</p>
                        <p class="hidden sm:block">BASED IN INDONESIA · AVAILABLE FOR PROJECTS</p>
                    </div>

                    <!-- 3-Column Spatial Grid (Left: Big Display Type, Center: Character Void, Right: Concise Editorial Copy) -->
                    <div
                        class="grid grid-cols-1 lg:grid-cols-[1.1fr_0.85fr_1fr] gap-8 lg:gap-16 items-end pb-16 sm:pb-24 reveal relative z-10">
                        <!-- Left Column: Giant Display Typography & Inline Metadata -->
                        <div>
                            <h2
                                class="text-[14vw] sm:text-[10vw] lg:text-[5.2rem] xl:text-[6.2rem] font-black uppercase leading-[0.84] tracking-tighter display-font text-[var(--heading)] mb-10">
                                CODE<br />INTO<br />REALITIES.
                            </h2>

                            <!-- Inline Metadata Block -->
                            <div
                                class="pt-6 border-t border-[var(--border-subtle)] grid grid-cols-2 gap-6 text-[10px] sm:text-[11px] tracking-[0.2em] font-sans uppercase text-[var(--muted)]">
                                <div>
                                    <span class="block text-[var(--text-soft)] font-medium mb-1">FIELD</span>
                                    <span class="text-[var(--heading)] font-semibold">INFORMATICS ENGINEERING</span>
                                </div>
                                <div>
                                    <span class="block text-[var(--text-soft)] font-medium mb-1">PRIMARY FOCUS</span>
                                    <span class="text-[var(--heading)] font-semibold">UNITY 3D &amp; FRONTEND</span>
                                </div>
                            </div>
                        </div>

                        <!-- Middle Column: Spacing Void for Character Silhouette -->
                        <div class="hidden lg:block min-w-[200px]"></div>

                        <!-- Right Column: Concise Editorial Narrative -->
                        <div class="flex flex-col justify-between h-full pt-4">
                            <div class="space-y-6 max-w-[38ch]">
                                <p
                                    class="text-xl sm:text-2xl lg:text-[1.8rem] leading-[1.25] font-light tracking-tight text-[var(--heading)] display-font">
                                    Naufal Tsaqif — Informatics student focused on interactive systems, 3D development,
                                    and
                                    modern web technologies.
                                </p>
                                <p class="text-xs sm:text-sm leading-relaxed text-[var(--text-soft)] font-light">
                                    Specializing in Unity 3D (C#) and modern web stacks with Vue.js &amp; Laravel.
                                    Building
                                    performance-driven mechanics, fluid UI interactions, and refined typography.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Capabilities & Tools -->
                <div class="pt-20 sm:pt-28 reveal relative z-10" id="about">
                    <div class="flex justify-between items-end mb-12 sm:mb-16">
                        <div>
                            <p class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase mb-3">
                                02 / CAPABILITIES &amp; TOOLKIT
                            </p>
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

                    <div class="border-t border-[var(--border-subtle)]">
                        <div v-for="(group, idx) in stackGroups" :key="group.title"
                            class="grid grid-cols-1 md:grid-cols-[0.25fr_0.75fr] gap-6 py-8 sm:py-10 border-b border-[var(--border-subtle)] items-start">

                            <div
                                class="flex items-center gap-3 font-sans text-[10px] tracking-[0.22em] text-[var(--muted)] uppercase">
                                <span class="text-[var(--text)] font-mono font-semibold">0{{ idx + 1 }}</span>
                                <span class="w-4 h-[1px] bg-[var(--border-subtle)]"></span>
                                <span>{{ group.title }}</span>
                            </div>

                            <div class="flex flex-wrap gap-x-8 gap-y-4 items-center">
                                <div v-for="item in group.items" :key="item.name"
                                    class="group/item flex items-center gap-2.5 cursor-pointer">
                                    <img :src="item.iconUrl ?? `https://cdn.simpleicons.org/${item.icon}`"
                                        :alt="`${item.name} icon`"
                                        class="w-3.5 h-3.5 opacity-60 grayscale group-hover/item:opacity-100 group-hover/item:grayscale-0 transition-all duration-300"
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

        <!-- Projects Section: Classic Editorial Typography Showcase -->
        <section
            class="w-full bg-[var(--bg)] text-[var(--text)] px-4 sm:px-8 py-20 sm:py-32 border-t border-[var(--border-subtle)]"
            id="projects">
            <div class="max-w-7xl mx-auto">
                <!-- Section Meta Anchor -->
                <div
                    class="flex justify-between items-baseline mb-8 sm:mb-12 font-sans text-[10px] sm:text-[11px] tracking-[0.25em] text-[var(--muted)] uppercase reveal">
                    <p>03 / SELECTED WORKS CATALOGUE</p>
                    <p class="font-sans tracking-widest tabular-nums">{{ filteredProjects.length }} OF {{
                        projects.length }} WORKS INDEXED</p>
                </div>

                <!-- Headline & Editorial Intro -->
                <div
                    class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 sm:mb-16 pb-8 border-b border-[var(--border-subtle)] reveal">
                    <div>
                        <h2 class="display-font font-black uppercase leading-[0.88] tracking-tighter text-[var(--heading)]"
                            style="font-size: clamp(3rem, 7.5vw, 6rem);">
                            SELECTED WORKS.
                        </h2>
                        <p
                            class="font-sans text-xs sm:text-sm text-[var(--text-soft)] mt-3 max-w-xl font-light leading-relaxed">
                            List karya yang pernah saya buat
                        </p>
                    </div>

                    <!-- Filter & Search Controls (Classic Minimalist) -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 shrink-0">
                        <!-- Minimalist Search Input -->
                        <div class="relative min-w-[200px] sm:min-w-[240px]">
                            <input v-model="projectSearch" type="text" placeholder="FILTER ARCHIVE..."
                                class="w-full bg-transparent border-b border-[var(--border-subtle)] focus:border-[var(--heading)] px-2 py-2 text-xs font-sans text-[var(--heading)] placeholder:text-[var(--muted)]/60 focus:outline-none transition-colors uppercase tracking-[0.15em]" />
                            <button v-if="projectSearch" @click="projectSearch = ''"
                                class="absolute inset-y-0 right-0 pr-1 flex items-center text-xs text-[var(--muted)] hover:text-[var(--heading)]">
                                ✕
                            </button>
                        </div>

                        <!-- View Switcher (Classic Tabs) -->
                        <div
                            class="flex items-center gap-4 text-[10px] tracking-[0.2em] font-sans uppercase text-[var(--muted)] pt-1 sm:pt-0">
                            <button @click="viewMode = 'grid'" class="transition-colors pb-0.5"
                                :class="viewMode === 'grid' ? 'text-[var(--heading)] font-bold border-b border-[var(--heading)]' : 'hover:text-[var(--heading)]'">
                                GRID
                            </button>
                            <span class="opacity-30">/</span>
                            <button @click="viewMode = 'list'" class="transition-colors pb-0.5"
                                :class="viewMode === 'list' ? 'text-[var(--heading)] font-bold border-b border-[var(--heading)]' : 'hover:text-[var(--heading)]'">
                                LIST
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Classic Category Filter Line -->
                <div
                    class="flex items-center gap-6 sm:gap-10 overflow-x-auto pb-4 mb-10 sm:mb-14 scrollbar-none border-b border-[var(--border-subtle)]/60 reveal">
                    <button v-for="cat in projectCategories" :key="cat"
                        class="font-sans text-[11px] tracking-[0.2em] uppercase py-2 transition-colors relative whitespace-nowrap"
                        :class="activeCategory === cat
                            ? 'text-[var(--heading)] font-bold'
                            : 'text-[var(--muted)] hover:text-[var(--heading)]'
                            " @click="activeCategory = cat">
                        <span>{{ cat }}</span>
                        <span class="ml-1 text-[9px] tabular-nums opacity-60">
                            ({{
                                cat === 'All'
                                    ? projects.length
                                    : projects.filter((p) => p.category === cat).length
                            }})
                        </span>
                        <!-- Active Hairline Underline -->
                        <span v-if="activeCategory === cat"
                            class="absolute bottom-0 left-0 right-0 h-[2px] bg-[var(--heading)]"></span>
                    </button>
                </div>

                <!-- Empty State -->
                <div v-if="filteredProjects.length === 0"
                    class="py-24 text-center border border-[var(--border-subtle)] p-8">
                    <p class="display-font text-3xl sm:text-4xl font-black uppercase text-[var(--muted)] mb-2">NO WORKS
                        FOUND</p>
                    <p class="font-sans text-xs text-[var(--muted)] max-w-sm mx-auto mb-6">
                        Tidak ada karya yang cocok dengan kata kunci pencarian.
                    </p>
                    <button @click="resetFilters"
                        class="font-sans text-[10px] tracking-[0.2em] uppercase px-5 py-2.5 border border-[var(--border-subtle)] hover:border-[var(--heading)] text-[var(--heading)] font-bold transition-colors">
                        RESET FILTER
                    </button>
                </div>

                <!-- 1. CLASSIC EDITORIAL GRID VIEW -->
                <div v-else-if="viewMode === 'grid'">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                        <div v-for="(project, i) in filteredProjects" :key="project.id ?? project.title"
                            @click="openProjectDetail(project)"
                            class="group relative flex flex-col justify-between border border-[var(--border-subtle)] hover:border-[var(--heading)] bg-[var(--bg)] p-7 sm:p-8 transition-all duration-300 cursor-pointer">

                            <!-- Card Header Metadata -->
                            <div>
                                <div
                                    class="flex items-baseline justify-between gap-2 pb-4 mb-6 border-b border-[var(--border-subtle)] text-[10px] tracking-[0.2em] font-sans text-[var(--muted)] uppercase">
                                    <span class="font-semibold text-[var(--heading)]">INDEX / 0{{ i + 1 }}</span>
                                    <span>{{ project.category }} · {{ project.year }}</span>
                                </div>

                                <!-- Classic Typographic Gallery Plate or Uploaded Image Preview -->
                                <div
                                    class="relative h-48 w-full bg-[var(--hover-bg)] border border-[var(--border-subtle)]/60 mb-6 flex flex-col items-center justify-center group-hover:border-[var(--border-subtle)] transition-colors overflow-hidden">
                                    <!-- Delicate Corner Crosshairs -->
                                    <span
                                        class="absolute top-2 left-2 text-[10px] text-[var(--muted)]/40 font-mono z-10">+</span>
                                    <span
                                        class="absolute top-2 right-2 text-[10px] text-[var(--muted)]/40 font-mono z-10">+</span>
                                    <span
                                        class="absolute bottom-2 left-2 text-[10px] text-[var(--muted)]/40 font-mono z-10">+</span>
                                    <span
                                        class="absolute bottom-2 right-2 text-[10px] text-[var(--muted)]/40 font-mono z-10">+</span>

                                    <!-- Render Image if available -->
                                    <template v-if="project.image">
                                        <img :src="project.image" :alt="project.title"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 filter contrast-105"
                                            loading="lazy" />
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none opacity-40 group-hover:opacity-10 transition-opacity">
                                        </div>
                                    </template>

                                    <!-- Otherwise Fallback to Roman Numeral / Typographic Monogram Watermark -->
                                    <template v-else>
                                        <span
                                            class="display-font text-5xl sm:text-6xl font-black uppercase tracking-tighter text-[var(--heading)] opacity-30 group-hover:opacity-60 transition-opacity select-none">
                                            {{ getRomanNumeral(i + 1) }}
                                        </span>
                                        <span
                                            class="font-sans text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase mt-1">
                                            CATALOGUE ENTRY
                                        </span>
                                    </template>
                                </div>

                                <!-- Title & Summary -->
                                <h3
                                    class="display-font font-black uppercase text-3xl sm:text-4xl text-[var(--heading)] group-hover:text-[var(--text-soft)] transition-colors leading-[0.88] tracking-tight mb-3">
                                    {{ project.title }}
                                </h3>
                                <p
                                    class="font-sans text-xs text-[var(--muted)] leading-relaxed line-clamp-3 font-light mb-6">
                                    {{ project.desc }}
                                </p>
                            </div>

                            <!-- Card Footer: Elegant Typographic Stack & Link -->
                            <div
                                class="pt-5 border-t border-[var(--border-subtle)] flex items-center justify-between gap-4 mt-auto">
                                <div
                                    class="font-sans text-[10px] tracking-[0.15em] text-[var(--muted)] uppercase truncate">
                                    <span>{{ (project.tags ?? []).join(' · ') }}</span>
                                </div>
                                <span
                                    class="font-sans text-xs font-semibold text-[var(--heading)] group-hover:translate-x-1 transition-transform shrink-0">
                                    →
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. CLASSIC EDITORIAL LIST VIEW -->
                <div v-else
                    class="divide-y divide-[var(--border-subtle)] border-t border-b border-[var(--border-subtle)]">
                    <div v-for="(project, i) in filteredProjects" :key="project.id ?? project.title"
                        @click="openProjectDetail(project)"
                        class="group relative py-8 sm:py-10 px-2 sm:px-4 transition-colors hover:bg-[var(--hover-bg)] cursor-pointer flex flex-col md:flex-row md:items-baseline justify-between gap-6">

                        <div class="flex items-baseline gap-6 md:gap-10 flex-1 min-w-0">
                            <span class="font-sans text-xs text-[var(--muted)] tracking-[0.2em] uppercase shrink-0">
                                0{{ i + 1 }}
                            </span>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline gap-4 mb-2 flex-wrap">
                                    <h3
                                        class="display-font font-black uppercase text-3xl sm:text-5xl text-[var(--heading)] group-hover:text-[var(--text-soft)] transition-colors tracking-tight leading-none">
                                        {{ project.title }}
                                    </h3>
                                    <span class="font-sans text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        / {{ project.category }}
                                    </span>
                                </div>
                                <p
                                    class="font-sans text-xs sm:text-sm text-[var(--muted)] line-clamp-1 max-w-2xl font-light leading-relaxed">
                                    {{ project.desc }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between md:justify-end gap-8 shrink-0 pt-2 md:pt-0 font-sans text-xs tracking-[0.15em] uppercase text-[var(--muted)]">
                            <span class="hidden lg:inline">{{ (project.tags ?? []).slice(0, 3).join(' · ') }}</span>
                            <span class="tabular-nums">{{ project.year }}</span>
                            <span
                                class="font-bold text-[var(--heading)] group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Quick-Detail Modal (Classic Exhibition Sheet) -->
            <Teleport to="body">
                <Transition name="modal-fade">
                    <div v-if="selectedProject"
                        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-8 bg-black/80 backdrop-blur-md overflow-y-auto"
                        @click="closeProjectDetail">

                        <div class="relative w-full max-w-2xl bg-[var(--bg)] text-[var(--text)] border border-[var(--heading)] shadow-2xl overflow-hidden my-auto p-6 sm:p-12"
                            @click.stop>

                            <!-- Modal Top Bar -->
                            <div
                                class="flex items-center justify-between pb-6 mb-8 border-b border-[var(--border-subtle)] font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase">
                                <span>CATALOGUE // {{ selectedProject.category }}</span>
                                <button @click="closeProjectDetail"
                                    class="hover:text-[var(--heading)] transition-colors cursor-pointer">
                                    [ CLOSE ✕ ]
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="space-y-8 max-h-[70vh] overflow-y-auto pr-1">
                                <!-- Modal Hero Image if available -->
                                <div v-if="selectedProject.image"
                                    class="w-full h-56 sm:h-72 bg-[var(--hover-bg)] border border-[var(--border-subtle)] overflow-hidden">
                                    <img :src="selectedProject.image" :alt="selectedProject.title"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div>
                                    <span
                                        class="font-sans text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-2">
                                        RELEASE {{ selectedProject.year }}
                                    </span>
                                    <h2
                                        class="display-font text-4xl sm:text-6xl font-black uppercase text-[var(--heading)] leading-[0.88] tracking-tighter">
                                        {{ selectedProject.title }}
                                    </h2>
                                </div>

                                <!-- Deep Description -->
                                <div class="pt-6 border-t border-[var(--border-subtle)]">
                                    <h4
                                        class="font-sans text-[10px] tracking-[0.25em] uppercase text-[var(--muted)] mb-3">
                                        OVERVIEW &amp; CONTEXT
                                    </h4>
                                    <p
                                        class="font-sans text-sm sm:text-base leading-relaxed text-[var(--text-soft)] font-light">
                                        {{ selectedProject.desc }}
                                    </p>
                                </div>

                                <!-- Stack Breakdown -->
                                <div v-if="selectedProject.tags && selectedProject.tags.length > 0"
                                    class="pt-6 border-t border-[var(--border-subtle)]">
                                    <h4
                                        class="font-sans text-[10px] tracking-[0.25em] uppercase text-[var(--muted)] mb-3">
                                        TECHNOLOGIES &amp; TOOLS
                                    </h4>
                                    <div
                                        class="flex flex-wrap gap-x-6 gap-y-2 font-sans text-xs sm:text-sm tracking-[0.12em] uppercase text-[var(--heading)]">
                                        <span v-for="tag in selectedProject.tags" :key="tag"
                                            class="flex items-center gap-2">
                                            <span class="text-[var(--muted)]">—</span>
                                            <span>{{ tag }}</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Footer Action -->
                                <div
                                    class="pt-8 border-t border-[var(--border-subtle)] flex items-center justify-between">
                                    <span class="font-sans text-[10px] tracking-[0.2em] uppercase text-[var(--muted)]">
                                        INDEX ARCHIVE // #{{ selectedProject.id ?? '01' }}
                                    </span>
                                    <button @click="closeProjectDetail"
                                        class="font-sans text-xs tracking-[0.2em] uppercase px-6 py-3 bg-[var(--heading)] text-[var(--bg)] font-bold hover:opacity-90 transition-opacity cursor-pointer">
                                        RETURN TO CATALOGUE
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </Transition>
            </Teleport>
        </section>

        <!-- Contact Section -->
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
import FooterBar from "../components/FooterBar.vue";
import HeaderBar from "../components/HeaderBar.vue";

const heroH1Ref = ref(null);
let observer;
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

const rollerRef = ref(null);
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
const viewMode = ref("grid"); // 'grid' | 'list'
const selectedProject = ref(null);

const fetchProjects = async () => {
    try {
        const res = await fetch("/api/projects");
        const json = await res.json();
        if (json.success) {
            projects.value = json.data;
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

const resetFilters = () => {
    activeCategory.value = "All";
    projectSearch.value = "";
};

const openProjectDetail = (proj) => {
    selectedProject.value = proj;
};

const closeProjectDetail = () => {
    selectedProject.value = null;
};

const getRomanNumeral = (num) => {
    const romanMap = [
        [10, "X"],
        [9, "IX"],
        [5, "V"],
        [4, "IV"],
        [1, "I"],
    ];
    let result = "";
    for (const [val, roman] of romanMap) {
        while (num >= val) {
            result += roman;
            num -= val;
        }
    }
    return result || "I";
};

const standeeContainerRef = ref(null);
const silhouetteOffsetY = ref(0);

const silhouetteParallaxStyle = computed(() => {
    return {
        transform: `translateY(${silhouetteOffsetY.value}px)`,
        transition: "transform 0.1s cubic-bezier(0, 0, 0.2, 1)"
    };
});

const handleScrollParallax = () => {
    if (!standeeContainerRef.value) return;
    const rect = standeeContainerRef.value.getBoundingClientRect();
    const windowHeight = window.innerHeight;

    // Check if within visible viewport range
    if (rect.top < windowHeight && rect.bottom > 0) {
        const scrollCenterOffset = (rect.top + rect.height / 2) - (windowHeight / 2);
        // Subtle floating movement proportional to scroll position (-25px to +25px)
        silhouetteOffsetY.value = Math.max(-35, Math.min(35, scrollCenterOffset * -0.06));
    }
};

const mousePos = { x: -100, y: -100 };
onMounted(async () => {
    fetchProjects();

    greetingTimer = setInterval(() => {
        currentGreetingIdx.value =
            (currentGreetingIdx.value + 1) % greetings.length;
    }, 2500);

    await document.fonts.ready;
    syncFontSize();
    window.addEventListener("resize", handleResize);
    window.addEventListener("scroll", handleScrollParallax, { passive: true });

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
    window.removeEventListener("resize", handleResize);
    window.removeEventListener("scroll", handleScrollParallax);
    if (greetingTimer) clearInterval(greetingTimer);
    if (observer) {
        observer.disconnect();
    }
});
</script>
