<template>
    <div class="min-h-[100dvh] bg-[var(--bg)] text-[var(--text)] selection:bg-[var(--heading)] selection:text-[var(--bg)] font-sans antialiased">
        <!-- Floating Editorial Header (Fully Responsive) -->
        <header class="sticky top-0 z-40 bg-[var(--bg)]/90 backdrop-blur-md border-b border-[var(--border-subtle)] px-3 sm:px-8 py-2.5 sm:py-3.5 transition-colors duration-300">
            <div class="max-w-6xl mx-auto flex items-center justify-between gap-2 sm:gap-4">
                <!-- Back Link -->
                <button
                    type="button"
                    @click="handleBackToDashboard"
                    class="font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.2em] uppercase text-[var(--muted)] hover:text-[var(--heading)] transition-colors inline-flex items-center gap-1.5 sm:gap-2 cursor-pointer font-semibold shrink-0 py-1"
                >
                    <span class="text-sm leading-none">←</span>
                    <span class="hidden xs:inline">DASHBOARD</span>
                    <span class="xs:hidden">BACK</span>
                </button>

                <!-- Center Minimal Status (Hidden on Mobile) -->
                <div class="hidden md:flex items-center gap-2.5 font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase truncate">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                    <span class="text-[var(--text-soft)] truncate">{{ isEditMode ? 'PROJECT #' + route.params.id : 'NEW CASE STUDY' }}</span>
                    <span class="opacity-30">/</span>
                    <span class="truncate">{{ form.category || 'DRAFT' }}</span>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <button
                        type="button"
                        @click="handleBackToDashboard"
                        class="font-sans text-[10px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase px-2.5 sm:px-4 py-1.5 sm:py-2 text-[var(--muted)] hover:text-[var(--heading)] transition-colors font-semibold cursor-pointer"
                    >
                        DISCARD
                    </button>
                    <button
                        type="button"
                        @click="saveProject"
                        :disabled="isSaving"
                        class="font-sans text-[10px] sm:text-xs tracking-[0.18em] sm:tracking-[0.2em] uppercase px-3.5 sm:px-6 py-1.5 sm:py-2.5 bg-[var(--heading)] text-[var(--bg)] font-bold hover:opacity-90 active:scale-[0.98] transition-all cursor-pointer shadow-sm disabled:opacity-50 flex items-center gap-1.5 sm:gap-2"
                    >
                        <span>{{ isSaving ? 'SAVING...' : (isEditMode ? 'SAVE CHANGES' : 'PUBLISH') }}</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Form Container -->
        <main class="max-w-5xl mx-auto px-3 sm:px-8 py-6 sm:py-14">
            <!-- Loading Indicator -->
            <div v-if="isLoadingData" class="py-20 sm:py-28 text-center space-y-4">
                <div class="inline-block w-7 h-7 sm:w-8 sm:h-8 border border-[var(--heading)] border-t-transparent rounded-full animate-spin"></div>
                <p class="font-mono text-[11px] sm:text-xs uppercase tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)]">
                    LOADING PROJECT DATA...
                </p>
            </div>

            <div v-else class="space-y-6 sm:space-y-10">
                <!-- Page Title Area -->
                <div class="space-y-2 sm:space-y-3 pb-6 sm:pb-8 border-b border-[var(--border-subtle)]">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase">
                            {{ isEditMode ? 'PROJECT ARCHIVE EDITOR' : 'NEW CASE STUDY' }}
                        </span>
                        <span class="font-mono text-[9px] sm:text-[10px] text-[var(--muted)] uppercase tracking-widest hidden sm:inline">
                            {{ liveTime }}
                        </span>
                    </div>
                    <h1 class="display-font text-3xl sm:text-5xl md:text-6xl font-black uppercase tracking-tight text-[var(--heading)] leading-[0.95] sm:leading-[0.9] break-words">
                        {{ isEditMode ? (form.title || 'UNTITLED PROJECT') : 'CREATE CASE STUDY' }}
                    </h1>
                </div>

                <!-- Minimalist Tab Navigation Bar (Smooth Horizontal Scroll on Mobile) -->
                <div class="border-b border-[var(--border-subtle)] -mx-3 sm:mx-0 px-3 sm:px-0">
                    <div class="flex items-center gap-1 sm:gap-2 overflow-x-auto font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase scrollbar-none pb-px">
                        <button
                            type="button"
                            v-for="tab in formTabs"
                            :key="tab.id"
                            @click="activeTab = tab.id"
                            class="px-3 sm:px-5 py-2.5 sm:py-3 transition-all whitespace-nowrap cursor-pointer font-semibold border-b-2 -mb-px shrink-0"
                            :class="activeTab === tab.id
                                ? 'border-[var(--heading)] text-[var(--heading)]'
                                : 'border-transparent text-[var(--muted)] hover:text-[var(--text-soft)]'"
                        >
                            {{ tab.label }}
                        </button>
                    </div>
                </div>

                <!-- Form Chapters -->
                <form @submit.prevent="saveProject" class="space-y-8 sm:space-y-10">
                    <!-- 01. GENERAL METADATA & HERO -->
                    <div v-show="activeTab === 'general'" class="space-y-6 sm:space-y-8">
                        <div class="space-y-5 sm:space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                                <!-- Project Title -->
                                <div class="sm:col-span-2 space-y-1.5 sm:space-y-2">
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        PROJECT TITLE *
                                    </label>
                                    <input
                                        v-model="form.title"
                                        type="text"
                                        required
                                        placeholder="e.g. AQUAVERSE"
                                        class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2.5 sm:py-3 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold"
                                    />
                                </div>

                                <!-- Release Year -->
                                <div class="space-y-1.5 sm:space-y-2">
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        RELEASE YEAR *
                                    </label>
                                    <input
                                        v-model="form.year"
                                        type="text"
                                        required
                                        placeholder="2026"
                                        class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2.5 sm:py-3 font-mono text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-medium"
                                    />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Custom Slug -->
                                <div class="space-y-1.5 sm:space-y-2">
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        URL SLUG (OPTIONAL)
                                    </label>
                                    <input
                                        v-model="form.slug"
                                        type="text"
                                        placeholder="e.g. aquaverse"
                                        class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2.5 sm:py-3 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors"
                                    />
                                </div>

                                <!-- Role -->
                                <div class="space-y-1.5 sm:space-y-2">
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        YOUR ROLE / SCOPE
                                    </label>
                                    <input
                                        v-model="form.role"
                                        type="text"
                                        placeholder="e.g. Lead Developer & Architect"
                                        class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2.5 sm:py-3 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-normal"
                                    />
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="space-y-2 sm:space-y-3">
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                    CATEGORY *
                                </label>
                                <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                    <button
                                        type="button"
                                        v-for="cat in presetCategories"
                                        :key="cat"
                                        @click="form.category = cat"
                                        class="font-mono text-[9px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.18em] uppercase px-2.5 sm:px-3.5 py-1 sm:py-1.5 border transition-all cursor-pointer font-medium"
                                        :class="form.category === cat ? 'bg-[var(--heading)] text-[var(--bg)] border-[var(--heading)]' : 'border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--border)]'"
                                    >
                                        {{ cat }}
                                    </button>
                                </div>
                                <input
                                    v-model="form.category"
                                    type="text"
                                    required
                                    placeholder="Or custom category..."
                                    class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2 sm:py-2.5 font-sans text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider"
                                />
                            </div>

                            <!-- Tagline / Summary -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                    SUMMARY / TAGLINE *
                                </label>
                                <textarea
                                    v-model="form.desc"
                                    required
                                    rows="3"
                                    placeholder="Concise overview of the project and core achievements..."
                                    class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] p-3 sm:p-4 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"
                                ></textarea>
                            </div>

                            <!-- Hero Image -->
                            <div class="pt-2">
                                <ImageDropzone
                                    v-model="form.image"
                                    label="HERO COVER VISUAL"
                                />
                            </div>

                            <!-- External Links -->
                            <div class="pt-5 sm:pt-6 border-t border-[var(--border-subtle)] space-y-3 sm:space-y-4">
                                <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                    EXTERNAL REFERENCES
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                                    <div class="space-y-1">
                                        <label class="block font-mono text-[8px] sm:text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase">GITHUB URL</label>
                                        <input
                                            v-model="form.github_url"
                                            type="url"
                                            placeholder="https://github.com/..."
                                            class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                        />
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block font-mono text-[8px] sm:text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase">LIVE DEMO URL</label>
                                        <input
                                            v-model="form.live_url"
                                            type="url"
                                            placeholder="https://..."
                                            class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                        />
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block font-mono text-[8px] sm:text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase">DOCUMENTATION URL</label>
                                        <input
                                            v-model="form.documentation_url"
                                            type="url"
                                            placeholder="https://docs..."
                                            class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 02. CASE STUDY NARRATIVE -->
                    <div v-show="activeTab === 'narrative'" class="space-y-6 sm:space-y-8">
                        <div class="space-y-5 sm:space-y-6">
                            <!-- Full Project Overview -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                    PROJECT OVERVIEW &amp; VISION
                                </label>
                                <textarea
                                    v-model="form.overview"
                                    rows="4"
                                    placeholder="Contextual narrative explaining why this project was built, its technical scope, and core goals..."
                                    class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] p-3 sm:p-4 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"
                                ></textarea>
                            </div>

                            <!-- Problem vs Solution Split -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <div class="space-y-1.5 sm:space-y-2 p-4 sm:p-5 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20">
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-red-400 uppercase font-semibold">
                                        CHALLENGE / PROBLEM
                                    </label>
                                    <textarea
                                        v-model="form.problem"
                                        rows="4"
                                        placeholder="What specific problem or bottleneck did this project address?"
                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-red-400 p-2.5 sm:p-3 text-xs sm:text-sm font-sans text-[var(--heading)] focus:outline-none leading-relaxed"
                                    ></textarea>
                                </div>
                                <div class="space-y-1.5 sm:space-y-2 p-4 sm:p-5 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20">
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-emerald-400 uppercase font-semibold">
                                        ENGINEERED SOLUTION
                                    </label>
                                    <textarea
                                        v-model="form.solution"
                                        rows="4"
                                        placeholder="How did your architecture and design solve this challenge?"
                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-emerald-400 p-2.5 sm:p-3 text-xs sm:text-sm font-sans text-[var(--heading)] focus:outline-none leading-relaxed"
                                    ></textarea>
                                </div>
                            </div>

                            <!-- Personal Contribution -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                    PERSONAL CONTRIBUTION &amp; ARCHITECTURE
                                </label>
                                <textarea
                                    v-model="form.contribution"
                                    rows="4"
                                    placeholder="Detail the exact subsystems, algorithms, shaders, or features you authored personally..."
                                    class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] p-3 sm:p-4 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 03. TECH & KEY FEATURES -->
                    <div v-show="activeTab === 'features'" class="space-y-6 sm:space-y-8">
                        <!-- Tech Stack Input -->
                        <div class="space-y-1.5 sm:space-y-2">
                            <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                TECHNOLOGIES &amp; MODULES (COMMA SEPARATED)
                            </label>
                            <input
                                v-model="tagsInput"
                                type="text"
                                placeholder="Unity 3D, C#, OpenXR, Meta Quest 2, Shader Graph"
                                class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2.5 sm:py-3 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider"
                            />

                            <div v-if="parsedTags.length > 0" class="flex flex-wrap gap-1.5 sm:gap-2 pt-2">
                                <span
                                    v-for="tag in parsedTags"
                                    :key="tag"
                                    class="font-mono text-[8px] sm:text-[9px] tracking-wider uppercase px-2.5 py-1 border border-[var(--border-subtle)] text-[var(--text-soft)] bg-[var(--hover-bg)]/40"
                                >
                                    {{ tag }}
                                </span>
                            </div>
                        </div>

                        <!-- Key Features Repeater -->
                        <div class="pt-6 sm:pt-8 border-t border-[var(--border-subtle)] space-y-4 sm:space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <h3 class="display-font text-xl sm:text-2xl font-bold uppercase text-[var(--heading)]">
                                        KEY FEATURES ({{ form.features.length }})
                                    </h3>
                                    <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        HIGHLIGHT SPECIFIC MODULES &amp; SYSTEMS
                                    </span>
                                </div>
                                <button
                                    type="button"
                                    @click="addFeature"
                                    class="font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase px-3.5 sm:px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer self-start sm:self-auto"
                                >
                                    + ADD FEATURE
                                </button>
                            </div>

                            <div v-if="form.features.length === 0" class="p-6 sm:p-8 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                NO FEATURES ADDED YET. CLICK "+ ADD FEATURE" TO ADD A HIGHLIGHT.
                            </div>

                            <div v-else class="space-y-4 sm:space-y-6">
                                <div
                                    v-for="(feat, idx) in form.features"
                                    :key="idx"
                                    class="p-4 sm:p-6 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 space-y-4"
                                >
                                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2.5">
                                        <span class="font-mono text-xs font-semibold text-[var(--heading)]">
                                            FEATURE {{ feat.number || (idx + 1) }}
                                        </span>
                                        <button
                                            type="button"
                                            @click="removeFeature(idx)"
                                            class="text-red-400 hover:text-red-300 text-xs font-mono font-medium cursor-pointer"
                                        >
                                            REMOVE ✕
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 sm:gap-4">
                                        <div>
                                            <label class="block font-mono text-[8px] sm:text-[9px] text-[var(--muted)] uppercase mb-1">INDEX NUMBER</label>
                                            <input
                                                v-model="feat.number"
                                                type="text"
                                                placeholder="01"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                            />
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label class="block font-mono text-[8px] sm:text-[9px] text-[var(--muted)] uppercase mb-1">FEATURE TITLE</label>
                                            <input
                                                v-model="feat.title"
                                                type="text"
                                                placeholder="e.g. FISHING & HARVESTING SYSTEM"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-sans text-[var(--heading)] uppercase font-semibold focus:outline-none"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block font-mono text-[8px] sm:text-[9px] text-[var(--muted)] uppercase mb-1">TECHNICAL SPECS / SUBTITLE</label>
                                        <input
                                            v-model="feat.tech"
                                            type="text"
                                            placeholder="e.g. Physics Raycasting · State Machine"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--muted)] focus:outline-none"
                                        />
                                    </div>

                                    <div>
                                        <label class="block font-mono text-[8px] sm:text-[9px] text-[var(--muted)] uppercase mb-1">DESCRIPTION</label>
                                        <textarea
                                            v-model="feat.description"
                                            rows="2"
                                            placeholder="Explain the mechanics, architectural design, and optimization..."
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] p-2.5 sm:p-3 text-xs font-sans text-[var(--heading)] leading-relaxed focus:outline-none"
                                        ></textarea>
                                    </div>

                                    <div>
                                        <ImageDropzone
                                            v-model="feat.image"
                                            :label="'FEATURE ' + (feat.number || (idx + 1)) + ' VISUAL'"
                                            compact
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 04. RESULTS & GALLERY -->
                    <div v-show="activeTab === 'results'" class="space-y-6 sm:space-y-10">
                        <!-- Outcome Statement -->
                        <div class="space-y-3 sm:space-y-4">
                            <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                OUTCOME &amp; IMPACT
                            </span>
                            <div class="space-y-1">
                                <label class="block font-mono text-[8px] sm:text-[9px] text-[var(--muted)] uppercase">RESULT HEADLINE</label>
                                <input
                                    v-model="form.result_headline"
                                    type="text"
                                    placeholder="e.g. STANDALONE PERFORMANCE & ENGAGEMENT"
                                    class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm font-sans text-[var(--heading)] uppercase font-semibold focus:outline-none"
                                />
                            </div>
                            <div class="space-y-1">
                                <label class="block font-mono text-[8px] sm:text-[9px] text-[var(--muted)] uppercase">RESULT SUMMARY</label>
                                <textarea
                                    v-model="form.result_summary"
                                    rows="3"
                                    placeholder="Delivered 72+ FPS experience directly on standalone Meta Quest 2..."
                                    class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] p-3 sm:p-4 text-xs sm:text-sm font-sans text-[var(--heading)] leading-relaxed focus:outline-none"
                                ></textarea>
                            </div>
                        </div>

                        <!-- Metrics Repeater -->
                        <div class="pt-6 sm:pt-8 border-t border-[var(--border-subtle)] space-y-4 sm:space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <h3 class="display-font text-xl sm:text-2xl font-bold uppercase text-[var(--heading)]">
                                        METRICS ({{ form.result_metrics.length }})
                                    </h3>
                                    <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        NUMERICAL KEY RESULTS
                                    </span>
                                </div>
                                <button
                                    type="button"
                                    @click="addMetric"
                                    class="font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase px-3.5 sm:px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer self-start sm:self-auto"
                                >
                                    + ADD METRIC
                                </button>
                            </div>

                            <div v-if="form.result_metrics.length === 0" class="p-4 sm:p-6 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                NO METRICS ADDED YET. CLICK "+ ADD METRIC" TO HIGHLIGHT NUMERICAL GAINS.
                            </div>

                            <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div
                                    v-for="(metric, idx) in form.result_metrics"
                                    :key="idx"
                                    class="p-3 sm:p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 flex items-center gap-3 sm:gap-4"
                                >
                                    <div class="flex-1 space-y-1.5 sm:space-y-2">
                                        <input
                                            v-model="metric.value"
                                            type="text"
                                            placeholder="Value (e.g. 72 FPS)"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 sm:px-3 py-1.5 text-xs font-mono text-[var(--heading)] font-bold focus:outline-none"
                                        />
                                        <input
                                            v-model="metric.label"
                                            type="text"
                                            placeholder="Label (e.g. Framerate on Quest 2)"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 sm:px-3 py-1.5 text-xs font-sans text-[var(--muted)] focus:outline-none"
                                        />
                                    </div>
                                    <button
                                        type="button"
                                        @click="removeMetric(idx)"
                                        class="text-red-400 hover:text-red-300 font-mono text-xs p-1.5 sm:p-2 cursor-pointer font-bold shrink-0"
                                    >
                                        ✕
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery Repeater -->
                        <div class="pt-6 sm:pt-8 border-t border-[var(--border-subtle)] space-y-4 sm:space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <h3 class="display-font text-xl sm:text-2xl font-bold uppercase text-[var(--heading)]">
                                        GALLERY ({{ form.gallery.length }})
                                    </h3>
                                    <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        SHOWCASE FRAMES &amp; SCREENSHOTS
                                    </span>
                                </div>
                                <button
                                    type="button"
                                    @click="addGalleryItem"
                                    class="font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase px-3.5 sm:px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer self-start sm:self-auto"
                                >
                                    + ADD FRAME
                                </button>
                            </div>

                            <div v-if="form.gallery.length === 0" class="p-6 sm:p-8 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                NO GALLERY FRAMES ADDED YET. CLICK "+ ADD FRAME" TO SHOWCASE IN-GAME / UI SCREENSHOTS.
                            </div>

                            <div v-else class="space-y-4 sm:space-y-6">
                                <div
                                    v-for="(item, idx) in form.gallery"
                                    :key="idx"
                                    class="p-4 sm:p-5 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 space-y-3 sm:space-y-4"
                                >
                                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                                        <span class="font-mono text-xs font-semibold text-[var(--heading)]">
                                            FRAME 0{{ idx + 1 }}
                                        </span>
                                        <button
                                            type="button"
                                            @click="removeGalleryItem(idx)"
                                            class="text-red-400 hover:text-red-300 font-mono text-xs cursor-pointer font-bold"
                                        >
                                            REMOVE ✕
                                        </button>
                                    </div>

                                    <ImageDropzone
                                        v-model="item.url"
                                        label="FRAME IMAGE"
                                        compact
                                    />

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 pt-2">
                                        <div>
                                            <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FRAME TITLE</label>
                                            <input
                                                v-model="item.title"
                                                type="text"
                                                placeholder="Title (e.g. Research Laboratory)"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 sm:px-3 py-1.5 sm:py-2 text-xs font-sans text-[var(--heading)] focus:outline-none"
                                            />
                                        </div>
                                        <div>
                                            <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">CAPTION</label>
                                            <input
                                                v-model="item.caption"
                                                type="text"
                                                placeholder="Caption / explanation"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 sm:px-3 py-1.5 sm:py-2 text-xs font-sans text-[var(--muted)] focus:outline-none"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Controls (Responsive Flow) -->
                    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-6 sm:pt-8 border-t border-[var(--border-subtle)]">
                        <button
                            type="button"
                            @click="handleBackToDashboard"
                            class="font-sans text-[11px] sm:text-xs tracking-[0.18em] sm:tracking-[0.2em] uppercase px-5 sm:px-6 py-3 border border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)] transition-colors font-semibold cursor-pointer text-center"
                        >
                            DISCARD &amp; RETURN
                        </button>
                        <button
                            type="submit"
                            :disabled="isSaving"
                            class="font-sans text-[11px] sm:text-xs tracking-[0.2em] sm:tracking-[0.22em] uppercase px-6 sm:px-8 py-3.5 bg-[var(--heading)] text-[var(--bg)] font-bold hover:opacity-90 transition-all disabled:opacity-50 cursor-pointer shadow-md text-center active:scale-[0.98]"
                        >
                            {{ isSaving ? 'SAVING...' : (isEditMode ? 'SAVE CHANGES' : 'PUBLISH PROJECT') }}
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Classic Toast HUD & SweetAlert Confirmation Modal -->
        <AdminToast ref="toastRef" />
        <AdminConfirmModal ref="confirmRef" />
    </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import ImageDropzone from '../components/ImageDropzone.vue';
import AdminToast from '../components/AdminToast.vue';
import AdminConfirmModal from '../components/AdminConfirmModal.vue';

const route = useRoute();
const router = useRouter();

const isEditMode = computed(() => !!route.params.id);
const activeTab = ref('general');
const isSaving = ref(false);
const isLoadingData = ref(false);
const toastRef = ref(null);
const confirmRef = ref(null);
const liveTime = ref('');

watch(
    () => [isEditMode.value, form.value.title],
    ([editMode, title]) => {
        document.title = editMode
            ? `${title || 'Edit Project'} - Admin Console`
            : 'New Case Study - Admin Console';
    },
    { immediate: true }
);

let clockTimer = null;

const presetCategories = ['VR Development', 'Unity', 'Website', 'Mobile', 'Design'];

const formTabs = [
    { id: 'general', label: '01. General & Hero' },
    { id: 'narrative', label: '02. Narrative' },
    { id: 'features', label: '03. Tech & Features' },
    { id: 'results', label: '04. Results & Gallery' },
];

const form = ref({
    title: '',
    slug: '',
    category: 'VR Development',
    year: new Date().getFullYear().toString(),
    desc: '',
    role: '',
    image: '',
    overview: '',
    problem: '',
    solution: '',
    contribution: '',
    features: [
        { number: '01', title: '', tech: '', description: '', image: '' }
    ],
    result_headline: '',
    result_summary: '',
    result_metrics: [
        { value: '', label: '' }
    ],
    gallery: [],
    github_url: '',
    live_url: '',
    documentation_url: '',
});

const tagsInput = ref('');

const parsedTags = computed(() => {
    return tagsInput.value
        .split(',')
        .map(t => t.trim())
        .filter(t => t.length > 0);
});

// Dynamic Repeater Handlers
const addFeature = () => {
    const nextNum = (form.value.features.length + 1).toString().padStart(2, '0');
    form.value.features.push({
        number: nextNum,
        title: '',
        tech: '',
        description: '',
        image: ''
    });
};

const removeFeature = (index) => {
    form.value.features.splice(index, 1);
};

const addMetric = () => {
    form.value.result_metrics.push({
        value: '',
        label: ''
    });
};

const removeMetric = (index) => {
    form.value.result_metrics.splice(index, 1);
};

const addGalleryItem = () => {
    form.value.gallery.push({
        url: '',
        title: '',
        caption: ''
    });
};

const removeGalleryItem = (index) => {
    form.value.gallery.splice(index, 1);
};

const updateClock = () => {
    const now = new Date();
    liveTime.value = now.toLocaleTimeString('en-US', {
        hour12: false,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    }) + ' LOCAL';
};

const checkAuth = () => {
    const token = sessionStorage.getItem('admin_token');
    if (!token) {
        router.push('/adminnopal');
    }
};

const loadProjectData = async () => {
    if (!isEditMode.value) return;

    isLoadingData.value = true;
    try {
        const res = await fetch(`/api/projects/${route.params.id}`);
        const json = await res.json();
        if (json.success && json.data) {
            const proj = json.data;
            form.value = {
                title: proj.title || '',
                slug: proj.slug || '',
                category: proj.category || 'Website',
                year: proj.year || new Date().getFullYear().toString(),
                desc: proj.desc || '',
                role: proj.role || '',
                image: proj.image || '',
                overview: proj.overview || '',
                problem: proj.problem || '',
                solution: proj.solution || '',
                contribution: proj.contribution || '',
                features: Array.isArray(proj.features) ? JSON.parse(JSON.stringify(proj.features)) : [],
                result_headline: proj.result_headline || '',
                result_summary: proj.result_summary || '',
                result_metrics: Array.isArray(proj.result_metrics) ? JSON.parse(JSON.stringify(proj.result_metrics)) : [],
                gallery: Array.isArray(proj.gallery) ? JSON.parse(JSON.stringify(proj.gallery)) : [],
                github_url: proj.github_url || '',
                live_url: proj.live_url || '',
                documentation_url: proj.documentation_url || '',
            };
            tagsInput.value = Array.isArray(proj.tags) ? proj.tags.join(', ') : '';
        } else {
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: 'RECORD NOT FOUND',
                    message: 'Could not load the requested project from database.',
                    type: 'error',
                    code: 'ERR_404',
                    category: 'DATABASE // SYNC'
                });
            }
        }
    } catch (err) {
        console.error('Failed to load project details:', err);
    } finally {
        isLoadingData.value = false;
    }
};

const handleBackToDashboard = async () => {
    if (confirmRef.value) {
        const confirmed = await confirmRef.value.ask({
            title: 'RETURN TO DASHBOARD',
            message: 'Any unsaved case study modifications will be discarded. Are you sure you want to exit?',
            confirmText: 'DISCARD & EXIT',
            cancelText: 'CONTINUE EDITING',
            type: 'warning',
            code: 'NAV_DISCARD_REQ',
            category: 'NAVIGATION // WORKSPACE'
        });
        if (confirmed) {
            router.push('/adminnopal');
        }
    } else {
        router.push('/adminnopal');
    }
};

const saveProject = async () => {
    isSaving.value = true;

    const payload = {
        title: form.value.title,
        slug: form.value.slug || undefined,
        category: form.value.category,
        year: form.value.year,
        desc: form.value.desc,
        role: form.value.role || null,
        image: form.value.image || null,
        overview: form.value.overview || null,
        problem: form.value.problem || null,
        solution: form.value.solution || null,
        contribution: form.value.contribution || null,
        result_headline: form.value.result_headline || null,
        result_summary: form.value.result_summary || null,
        github_url: form.value.github_url || null,
        live_url: form.value.live_url || null,
        documentation_url: form.value.documentation_url || null,
        tags: parsedTags.value,
        features: form.value.features,
        result_metrics: form.value.result_metrics,
        gallery: form.value.gallery,
    };

    try {
        const url = isEditMode.value ? `/api/projects/${route.params.id}` : '/api/projects';
        const method = isEditMode.value ? 'PUT' : 'POST';

        const res = await fetch(url, {
            method: method,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        });

        const json = await res.json();

        if (res.ok && json.success) {
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: isEditMode.value ? 'CASE STUDY UPDATED' : 'CASE STUDY CREATED',
                    message: 'Record successfully saved and committed to database.',
                    type: 'success',
                    code: '200_OK',
                    category: 'DATABASE // STORE'
                });
            }
            setTimeout(() => {
                router.push('/adminnopal');
            }, 900);
        } else {
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: 'SUBMISSION REJECTED',
                    message: json.message || 'Server rejected the case study data.',
                    type: 'error',
                    code: 'ERR_422',
                    category: 'TRANSACTION // FAULT'
                });
            }
        }
    } catch (err) {
        if (toastRef.value) {
            toastRef.value.addToast({
                title: 'NETWORK EXCEPTION',
                message: 'An error occurred while saving the case study.',
                type: 'error',
                code: 'NET_FAIL',
                category: 'PROTOCOL // ERROR'
            });
        }
    } finally {
        isSaving.value = false;
    }
};

onMounted(() => {
    checkAuth();
    updateClock();
    clockTimer = setInterval(updateClock, 1000);
    loadProjectData();
});

onBeforeUnmount(() => {
    if (clockTimer) clearInterval(clockTimer);
});
</script>
