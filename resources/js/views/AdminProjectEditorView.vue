<template>
    <div class="min-h-[100dvh] bg-[var(--bg)] text-[var(--text)] selection:bg-[var(--heading)] selection:text-[var(--bg)] font-sans">
        <!-- Top Sticky Navigation Bar -->
        <header class="sticky top-0 z-40 bg-[var(--bg)]/90 backdrop-blur-md border-b-2 border-[var(--heading)] px-4 sm:px-8 py-3.5 sm:py-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Return Link -->
                <button
                    type="button"
                    @click="handleBackToDashboard"
                    class="font-sans text-xs sm:text-sm tracking-[0.18em] uppercase text-[var(--muted)] hover:text-[var(--heading)] transition-colors inline-flex items-center gap-2 cursor-pointer font-bold shrink-0"
                >
                    <span>←</span> BACK TO DASHBOARD
                </button>

                <!-- Center Workspace Stamp -->
                <div class="hidden md:flex items-center gap-2 font-mono text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>WORKSPACE // CASE STUDY EDITOR</span>
                    <span class="opacity-40">•</span>
                    <span class="text-[var(--heading)] font-semibold">{{ isEditMode ? 'ID #' + route.params.id : 'NEW RECORD' }}</span>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                    <button
                        type="button"
                        @click="handleBackToDashboard"
                        class="font-sans text-[10px] sm:text-xs tracking-[0.18em] uppercase px-4 py-2 border border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)] transition-all font-bold cursor-pointer"
                    >
                        DISCARD
                    </button>
                    <button
                        type="button"
                        @click="saveProject"
                        :disabled="isSaving"
                        class="font-sans text-[10px] sm:text-xs tracking-[0.22em] uppercase px-6 sm:px-8 py-2 sm:py-2.5 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-all cursor-pointer shadow-lg disabled:opacity-50 flex items-center gap-2"
                    >
                        <span>{{ isSaving ? 'SAVING...' : (isEditMode ? 'UPDATE CASE STUDY →' : 'PUBLISH CASE STUDY →') }}</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Form Container -->
        <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-12">
            <!-- Loading Indicator for Edit Mode -->
            <div v-if="isLoadingData" class="py-24 text-center">
                <div class="inline-block w-8 h-8 border-2 border-[var(--heading)] border-t-transparent rounded-full animate-spin mb-4"></div>
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-[var(--muted)]">
                    LOADING CASE STUDY DATA...
                </p>
            </div>

            <div v-else class="space-y-8 sm:space-y-12">
                <!-- Page Title & Header -->
                <div class="border-b-2 border-[var(--heading)] pb-6 sm:pb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 font-mono text-[9px] sm:text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase mb-2">
                            <span>01 // ARCHITECTURAL FORM</span>
                            <span>•</span>
                            <span>{{ isEditMode ? 'EDITING EXISTING ENTRY' : 'INITIALIZING NEW WORK' }}</span>
                        </div>
                        <h1 class="display-font text-3xl sm:text-6xl font-black uppercase tracking-tight text-[var(--heading)] leading-[0.9]">
                            {{ isEditMode ? 'EDIT: ' + (form.title || 'UNTITLED') : 'CREATE NEW CASE STUDY' }}
                        </h1>
                    </div>

                    <div class="font-mono text-xs text-[var(--muted)] shrink-0">
                        <span>LAST SYNC: </span>
                        <span class="text-[var(--heading)]">{{ liveTime }}</span>
                    </div>
                </div>

                <!-- Tabs Navigation Bar -->
                <div class="border-b-2 border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 p-2">
                    <div class="flex items-center gap-2 sm:gap-4 overflow-x-auto font-sans text-xs tracking-[0.18em] uppercase scrollbar-none">
                        <button
                            type="button"
                            v-for="tab in formTabs"
                            :key="tab.id"
                            @click="activeTab = tab.id"
                            class="px-4 sm:px-6 py-3 transition-all whitespace-nowrap cursor-pointer font-bold border-b-2"
                            :class="activeTab === tab.id
                                ? 'border-[var(--heading)] text-[var(--heading)] bg-[var(--hover-bg)] shadow-sm'
                                : 'border-transparent text-[var(--muted)] hover:text-[var(--heading)]'"
                        >
                            {{ tab.label }}
                        </button>
                    </div>
                </div>

                <!-- Form Chapters -->
                <form @submit.prevent="saveProject" class="space-y-8">
                    <!-- CHAPTER 1: GENERAL & HERO -->
                    <div v-show="activeTab === 'general'" class="space-y-8 bg-[var(--bg)] border-2 border-[var(--heading)] p-6 sm:p-10 shadow-2xl">
                        <div class="border-b border-[var(--border-subtle)] pb-4">
                            <span class="font-mono text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-1">CHAPTER 01</span>
                            <h3 class="display-font text-2xl sm:text-3xl font-black uppercase text-[var(--heading)] tracking-tight">
                                GENERAL METADATA &amp; HERO VISUAL
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                            <!-- Project Title -->
                            <div class="md:col-span-2">
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                    PROJECT TITLE *
                                </label>
                                <input
                                    v-model="form.title"
                                    type="text"
                                    required
                                    placeholder="e.g. AQUAVERSE"
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-3 font-sans text-sm sm:text-base text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold"
                                />
                            </div>

                            <!-- Release Year -->
                            <div>
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                    RELEASE YEAR *
                                </label>
                                <input
                                    v-model="form.year"
                                    type="text"
                                    required
                                    placeholder="2026"
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-3 font-mono text-sm sm:text-base text-[var(--heading)] focus:outline-none transition-colors font-bold"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                            <!-- Custom Slug -->
                            <div>
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                    CUSTOM URL SLUG (OPTIONAL - AUTO GENERATED)
                                </label>
                                <input
                                    v-model="form.slug"
                                    type="text"
                                    placeholder="e.g. aquaverse"
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-3 font-mono text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors"
                                />
                            </div>

                            <!-- Role / Personal Responsibility -->
                            <div>
                                <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                    YOUR ROLE / SCOPE
                                </label>
                                <input
                                    v-model="form.role"
                                    type="text"
                                    placeholder="e.g. Lead VR Developer & System Architect"
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-3 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-medium"
                                />
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div>
                            <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                CATEGORY *
                            </label>
                            <div class="flex flex-wrap gap-2.5 mb-3">
                                <button
                                    type="button"
                                    v-for="cat in presetCategories"
                                    :key="cat"
                                    @click="form.category = cat"
                                    class="font-mono text-[9px] sm:text-[10px] tracking-[0.18em] uppercase px-4 py-2 border transition-all cursor-pointer font-bold"
                                    :class="form.category === cat ? 'bg-[var(--heading)] text-[var(--bg)] border-[var(--heading)] shadow-md' : 'border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)]'"
                                >
                                    {{ cat }}
                                </button>
                            </div>
                            <input
                                v-model="form.category"
                                type="text"
                                required
                                placeholder="Or enter custom category..."
                                class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold"
                            />
                        </div>

                        <!-- Short Description / Tagline -->
                        <div>
                            <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                SHORT SUMMARY / TAGLINE (FOR CARDS &amp; HERO) *
                            </label>
                            <textarea
                                v-model="form.desc"
                                required
                                rows="3"
                                placeholder="Concise description of the experience..."
                                class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] p-4 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"
                            ></textarea>
                        </div>

                        <!-- Hero Cover Image via Drag & Drop -->
                        <div>
                            <ImageDropzone
                                v-model="form.image"
                                label="HERO IMAGE / COVER VISUAL"
                            />
                        </div>

                        <!-- Action External Links -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-[var(--border-subtle)]">
                            <div>
                                <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">GITHUB REPO URL</label>
                                <input
                                    v-model="form.github_url"
                                    type="url"
                                    placeholder="https://github.com/..."
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-2.5 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                />
                            </div>
                            <div>
                                <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">LIVE DEMO URL</label>
                                <input
                                    v-model="form.live_url"
                                    type="url"
                                    placeholder="https://..."
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-2.5 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                />
                            </div>
                            <div>
                                <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">DOCUMENTATION URL</label>
                                <input
                                    v-model="form.documentation_url"
                                    type="url"
                                    placeholder="https://docs..."
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-2.5 text-xs font-mono text-[var(--heading)] focus:outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- CHAPTER 2: OVERVIEW & CASE STUDY NARRATIVE -->
                    <div v-show="activeTab === 'narrative'" class="space-y-8 bg-[var(--bg)] border-2 border-[var(--heading)] p-6 sm:p-10 shadow-2xl">
                        <div class="border-b border-[var(--border-subtle)] pb-4">
                            <span class="font-mono text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-1">CHAPTER 02</span>
                            <h3 class="display-font text-2xl sm:text-3xl font-black uppercase text-[var(--heading)] tracking-tight">
                                CASE STUDY NARRATIVE &amp; VISION
                            </h3>
                        </div>

                        <!-- Full Project Overview -->
                        <div>
                            <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                01 // FULL PROJECT OVERVIEW &amp; VISION NARRATIVE
                            </label>
                            <textarea
                                v-model="form.overview"
                                rows="5"
                                placeholder="Deep contextual narrative explaining why this project was built, its architectural scope, and core objectives..."
                                class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] p-4 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"
                            ></textarea>
                        </div>

                        <!-- Problem vs Solution Split -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                            <div class="p-5 border-2 border-red-500/40 bg-red-950/10 space-y-3">
                                <label class="block font-mono text-[9px] tracking-[0.2em] text-red-400 uppercase font-bold">
                                    [ 02.A ] CHALLENGE / PROBLEM STATEMENT
                                </label>
                                <textarea
                                    v-model="form.problem"
                                    rows="4"
                                    placeholder="What specific problem, technical bottleneck, or system limitation did this project address?"
                                    class="w-full bg-[var(--bg)] border-2 border-red-500/40 focus:border-red-400 p-3 text-xs sm:text-sm font-sans text-[var(--heading)] focus:outline-none leading-relaxed"
                                ></textarea>
                            </div>
                            <div class="p-5 border-2 border-emerald-500/40 bg-emerald-950/10 space-y-3">
                                <label class="block font-mono text-[9px] tracking-[0.2em] text-emerald-400 uppercase font-bold">
                                    [ 02.B ] ENGINEERED SOLUTION
                                </label>
                                <textarea
                                    v-model="form.solution"
                                    rows="4"
                                    placeholder="How did your engineered architecture and technical choices solve this challenge?"
                                    class="w-full bg-[var(--bg)] border-2 border-emerald-500/40 focus:border-emerald-400 p-3 text-xs sm:text-sm font-sans text-[var(--heading)] focus:outline-none leading-relaxed"
                                ></textarea>
                            </div>
                        </div>

                        <!-- Personal Contribution -->
                        <div>
                            <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                03 // PERSONAL CONTRIBUTION &amp; IMPLEMENTED ARCHITECTURE
                            </label>
                            <textarea
                                v-model="form.contribution"
                                rows="4"
                                placeholder="Explain the exact subsystems you personally developed, authored algorithms, shaders, and architectural decisions..."
                                class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] p-4 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"
                            ></textarea>
                        </div>
                    </div>

                    <!-- CHAPTER 3: TECH & KEY FEATURES -->
                    <div v-show="activeTab === 'features'" class="space-y-8 bg-[var(--bg)] border-2 border-[var(--heading)] p-6 sm:p-10 shadow-2xl">
                        <div class="border-b border-[var(--border-subtle)] pb-4">
                            <span class="font-mono text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-1">CHAPTER 03</span>
                            <h3 class="display-font text-2xl sm:text-3xl font-black uppercase text-[var(--heading)] tracking-tight">
                                TECHNOLOGIES &amp; KEY FEATURE SHOWCASE
                            </h3>
                        </div>

                        <!-- Tech Stack Input -->
                        <div>
                            <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-2">
                                TECHNOLOGIES &amp; MODULES (COMMA SEPARATED)
                            </label>
                            <input
                                v-model="tagsInput"
                                type="text"
                                placeholder="Unity 3D, C#, OpenXR, Meta Quest 2, Shader Graph, HLSL"
                                class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-4 py-3 font-mono text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold"
                            />

                            <div v-if="parsedTags.length > 0" class="flex flex-wrap gap-2 mt-4">
                                <span
                                    v-for="tag in parsedTags"
                                    :key="tag"
                                    class="font-mono text-[9px] tracking-wider uppercase px-3 py-1.5 border border-blue-500/40 text-blue-400 bg-blue-950/30 font-bold"
                                >
                                    {{ tag }}
                                </span>
                            </div>
                        </div>

                        <!-- Key Features Repeater Builder -->
                        <div class="pt-6 border-t-2 border-[var(--border-subtle)]">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        FEATURE SHOWCASE REPEATER
                                    </span>
                                    <h4 class="display-font text-xl sm:text-2xl font-bold uppercase text-[var(--heading)]">
                                        KEY FEATURES ({{ form.features.length }})
                                    </h4>
                                </div>
                                <button
                                    type="button"
                                    @click="addFeature"
                                    class="font-sans text-xs tracking-[0.18em] uppercase px-5 py-2.5 border-2 border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-black cursor-pointer"
                                >
                                    + ADD FEATURE
                                </button>
                            </div>

                            <div v-if="form.features.length === 0" class="p-10 border-2 border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                NO KEY FEATURES ADDED YET. CLICK "+ ADD FEATURE" TO ADD A SYSTEM TO HIGHLIGHT.
                            </div>

                            <div v-else class="space-y-6">
                                <div
                                    v-for="(feat, idx) in form.features"
                                    :key="idx"
                                    class="p-6 border-2 border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 relative space-y-4"
                                >
                                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                                        <span class="font-mono text-sm font-bold text-[var(--heading)]">
                                            FEATURE #{{ feat.number || (idx + 1) }}
                                        </span>
                                        <button
                                            type="button"
                                            @click="removeFeature(idx)"
                                            class="text-red-400 hover:text-red-300 text-xs font-mono font-bold cursor-pointer px-2 py-1 border border-red-900/40 hover:border-red-500"
                                        >
                                            ✕ REMOVE FEATURE
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">INDEX NUMBER</label>
                                            <input
                                                v-model="feat.number"
                                                type="text"
                                                placeholder="01"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-mono text-[var(--heading)] font-bold"
                                            />
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FEATURE TITLE</label>
                                            <input
                                                v-model="feat.title"
                                                type="text"
                                                placeholder="e.g. FISHING & HARVESTING SYSTEM"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-sans text-[var(--heading)] uppercase font-semibold"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">TECHNICAL SPECS / SUBTITLE</label>
                                        <input
                                            v-model="feat.tech"
                                            type="text"
                                            placeholder="e.g. Physics Raycasting · Weighted Probability · State Machine"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-mono text-[var(--muted)]"
                                        />
                                    </div>

                                    <div>
                                        <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FEATURE EXPLANATION</label>
                                        <textarea
                                            v-model="feat.description"
                                            rows="3"
                                            placeholder="Explain the gameplay mechanics, architectural design, and optimization..."
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] p-3 text-xs font-sans text-[var(--heading)] leading-relaxed"
                                        ></textarea>
                                    </div>

                                    <!-- Feature Visual via Drag & Drop -->
                                    <div>
                                        <ImageDropzone
                                            v-model="feat.image"
                                            :label="'FEATURE ' + (feat.number || (idx + 1)) + ' VISUAL SHOWCASE'"
                                            compact
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CHAPTER 4: RESULTS & GALLERY -->
                    <div v-show="activeTab === 'results'" class="space-y-8 bg-[var(--bg)] border-2 border-[var(--heading)] p-6 sm:p-10 shadow-2xl">
                        <div class="border-b border-[var(--border-subtle)] pb-4">
                            <span class="font-mono text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-1">CHAPTER 04</span>
                            <h3 class="display-font text-2xl sm:text-3xl font-black uppercase text-[var(--heading)] tracking-tight">
                                OUTCOME METRICS &amp; VISUAL GALLERY
                            </h3>
                        </div>

                        <!-- Result Statement -->
                        <div class="space-y-4">
                            <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                01 // OUTCOME &amp; PERFORMANCE STATEMENT
                            </span>
                            <div>
                                <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">RESULT HEADLINE</label>
                                <input
                                    v-model="form.result_headline"
                                    type="text"
                                    placeholder="e.g. STANDALONE PERFORMANCE & ENGAGEMENT"
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] px-4 py-2.5 text-xs sm:text-sm font-sans text-[var(--heading)] uppercase font-semibold"
                                />
                            </div>
                            <div>
                                <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">RESULT SUMMARY</label>
                                <textarea
                                    v-model="form.result_summary"
                                    rows="3"
                                    placeholder="Delivered 72+ FPS experience directly on standalone Meta Quest 2..."
                                    class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] p-4 text-xs sm:text-sm font-sans text-[var(--heading)] leading-relaxed"
                                ></textarea>
                            </div>
                        </div>

                        <!-- Result Metrics Builder -->
                        <div class="pt-6 border-t-2 border-[var(--border-subtle)]">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        NUMERICAL DATA POINTS
                                    </span>
                                    <h4 class="display-font text-xl sm:text-2xl font-bold uppercase text-[var(--heading)]">
                                        METRICS ({{ form.result_metrics.length }})
                                    </h4>
                                </div>
                                <button
                                    type="button"
                                    @click="addMetric"
                                    class="font-sans text-xs tracking-[0.18em] uppercase px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer"
                                >
                                    + ADD METRIC
                                </button>
                            </div>

                            <div v-if="form.result_metrics.length === 0" class="p-6 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                NO METRICS ADDED YET. CLICK "+ ADD METRIC" TO ADD NUMERICAL ACCOMPLISHMENTS.
                            </div>

                            <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div
                                    v-for="(metric, idx) in form.result_metrics"
                                    :key="idx"
                                    class="p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 flex items-center gap-4"
                                >
                                    <div class="flex-1 space-y-2">
                                        <input
                                            v-model="metric.value"
                                            type="text"
                                            placeholder="Value (e.g. 72 FPS)"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-1.5 text-xs font-mono text-[var(--heading)] font-bold"
                                        />
                                        <input
                                            v-model="metric.label"
                                            type="text"
                                            placeholder="Label (e.g. Framerate on Quest 2)"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-1.5 text-xs font-sans text-[var(--muted)]"
                                        />
                                    </div>
                                    <button
                                        type="button"
                                        @click="removeMetric(idx)"
                                        class="text-red-400 hover:text-red-300 font-mono text-xs p-2 cursor-pointer font-bold"
                                    >
                                        ✕
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Visual Gallery Builder -->
                        <div class="pt-6 border-t-2 border-[var(--border-subtle)]">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        VISUAL SHOWCASE FRAMES
                                    </span>
                                    <h4 class="display-font text-xl sm:text-2xl font-bold uppercase text-[var(--heading)]">
                                        GALLERY ({{ form.gallery.length }})
                                    </h4>
                                </div>
                                <button
                                    type="button"
                                    @click="addGalleryItem"
                                    class="font-sans text-xs tracking-[0.18em] uppercase px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer"
                                >
                                    + ADD GALLERY IMAGE
                                </button>
                            </div>

                            <div v-if="form.gallery.length === 0" class="p-8 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                NO GALLERY IMAGES ADDED YET. CLICK "+ ADD GALLERY IMAGE" TO SHOWCASE IN-GAME / UI SCREENSHOTS.
                            </div>

                            <div v-else class="space-y-6">
                                <div
                                    v-for="(item, idx) in form.gallery"
                                    :key="idx"
                                    class="p-5 border-2 border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 space-y-4"
                                >
                                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                                        <span class="font-mono text-xs font-bold text-[var(--heading)]">
                                            FRAME #0{{ idx + 1 }}
                                        </span>
                                        <button
                                            type="button"
                                            @click="removeGalleryItem(idx)"
                                            class="text-red-400 hover:text-red-300 font-mono text-xs cursor-pointer font-bold px-2 py-1"
                                        >
                                            ✕ REMOVE FRAME
                                        </button>
                                    </div>

                                    <ImageDropzone
                                        v-model="item.url"
                                        label="GALLERY FRAME IMAGE"
                                        compact
                                    />

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                        <div>
                                            <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FRAME TITLE</label>
                                            <input
                                                v-model="item.title"
                                                type="text"
                                                placeholder="Title (e.g. Research Laboratory)"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-sans text-[var(--heading)]"
                                            />
                                        </div>
                                        <div>
                                            <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">CAPTION / CONTEXT</label>
                                            <input
                                                v-model="item.caption"
                                                type="text"
                                                placeholder="Caption / explanation"
                                                class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-sans text-[var(--muted)]"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Controls -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t-2 border-[var(--heading)]">
                        <button
                            type="button"
                            @click="handleBackToDashboard"
                            class="font-sans text-xs tracking-[0.2em] uppercase px-6 py-3.5 border-2 border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)] transition-colors font-bold cursor-pointer w-full sm:w-auto text-center"
                        >
                            ← DISCARD &amp; RETURN
                        </button>
                        <button
                            type="submit"
                            :disabled="isSaving"
                            class="font-sans text-xs tracking-[0.22em] uppercase px-10 py-4 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-all disabled:opacity-50 cursor-pointer shadow-2xl w-full sm:w-auto text-center active:scale-[0.98]"
                        >
                            {{ isSaving ? 'SYNCHRONIZING WITH DATABASE...' : (isEditMode ? 'UPDATE CASE STUDY →' : 'PUBLISH CASE STUDY →') }}
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
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
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

let clockTimer = null;

const presetCategories = ['VR Development', 'Unity', 'Website', 'Mobile', 'Design'];

const formTabs = [
    { id: 'general', label: '01 / GENERAL & HERO' },
    { id: 'narrative', label: '02 / CASE STUDY & VISION' },
    { id: 'features', label: '03 / TECH & KEY FEATURES' },
    { id: 'results', label: '04 / RESULTS & GALLERY' },
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
