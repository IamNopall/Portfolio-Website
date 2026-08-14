<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div v-if="isOpen"
                class="fixed inset-0 z-[100] flex items-center justify-center p-2 sm:p-4 md:p-8 bg-black/85 backdrop-blur-xl overflow-y-auto font-sans">
                <div class="relative w-full max-w-5xl bg-[var(--bg)] text-[var(--text)] border-2 border-[var(--heading)] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.8)] my-auto overflow-hidden transition-all duration-300"
                    @click.stop>

                    <!-- Top Bar Solid Accent -->
                    <div class="h-1.5 w-full bg-[var(--heading)]"></div>

                    <!-- Header -->
                    <div class="flex items-center justify-between px-4 sm:px-8 py-4 sm:py-5 border-b-2 border-[var(--heading)] bg-[var(--hover-bg)] gap-3">
                        <div>
                            <span class="font-mono text-[8px] sm:text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-0.5 sm:mb-1">
                                CONSOLE FORM // {{ editingId ? 'UPDATE CASE STUDY ENTRY' : 'CREATE CASE STUDY ENTRY' }}
                            </span>
                            <h2 class="display-font text-xl sm:text-3xl font-black uppercase tracking-tight text-[var(--heading)] leading-none">
                                {{ editingId ? 'EDIT: ' + (form.title || 'PROJECT') : 'ADD NEW CASE STUDY' }}
                            </h2>
                        </div>
                        <button @click="closeModal"
                            class="p-1.5 sm:p-2 text-[var(--muted)] hover:text-[var(--heading)] transition-colors focus:outline-none cursor-pointer font-mono text-xs sm:text-sm border border-[var(--border-subtle)] px-2.5 sm:px-3 shrink-0"
                            title="Close Modal">
                            ✕ <span class="hidden sm:inline">CLOSE</span>
                        </button>
                    </div>

                    <!-- Tabs Navigation Bar -->
                    <div class="px-4 sm:px-8 pt-4 bg-[var(--hover-bg)]/50 border-b border-[var(--border-subtle)]">
                        <div class="flex items-center gap-2 sm:gap-4 overflow-x-auto pb-3 font-sans text-xs tracking-[0.15em] uppercase scrollbar-none">
                            <button type="button" v-for="tab in formTabs" :key="tab.id"
                                @click="activeTab = tab.id"
                                class="px-3.5 py-2 transition-all whitespace-nowrap cursor-pointer font-semibold border-b-2"
                                :class="activeTab === tab.id
                                    ? 'border-[var(--heading)] text-[var(--heading)] bg-[var(--hover-bg)]'
                                    : 'border-transparent text-[var(--muted)] hover:text-[var(--heading)]'">
                                {{ tab.label }}
                            </button>
                        </div>
                    </div>

                    <!-- Body Content -->
                    <div class="p-4 sm:p-8 max-h-[65vh] overflow-y-auto">
                        <!-- Alert Banner (Classic Typographic Architectural Frame) -->
                        <div v-if="alertMessage"
                            class="mb-6 relative border-2 p-4 sm:p-5 shadow-[0_15px_35px_-10px_rgba(0,0,0,0.5)] overflow-hidden transition-all duration-300"
                            :class="alertType === 'error' ? 'border-red-500/80 bg-[#160406]/95 text-red-100' : 'border-emerald-500/80 bg-[#04140b]/95 text-emerald-100'">
                            <!-- Corner Crosshairs -->
                            <span class="absolute top-1 left-1.5 font-mono text-[9px] opacity-40 select-none">+</span>
                            <span class="absolute top-1 right-1.5 font-mono text-[9px] opacity-40 select-none">+</span>
                            <span class="absolute bottom-1 left-1.5 font-mono text-[9px] opacity-40 select-none">+</span>
                            <span class="absolute bottom-1 right-1.5 font-mono text-[9px] opacity-40 select-none">+</span>

                            <div class="flex items-center justify-between gap-2 pb-2 mb-2 border-b border-white/10 font-mono text-[8px] sm:text-[9px] tracking-[0.25em] uppercase"
                                :class="alertType === 'error' ? 'text-red-400' : 'text-emerald-400'">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full animate-ping"
                                        :class="alertType === 'error' ? 'bg-red-400' : 'bg-emerald-400'"></span>
                                    <span class="font-bold">{{ alertType === 'error' ? 'TRANSACTION FAULT' : 'TRANSACTION CONFIRMED' }}</span>
                                </div>
                                <span class="px-1.5 py-0.5 border font-semibold tracking-widest text-[8px]"
                                    :class="alertType === 'error' ? 'border-red-500/40 bg-red-950 text-red-300' : 'border-emerald-500/40 bg-emerald-950 text-emerald-300'">
                                    {{ alertType === 'error' ? 'ERR_422' : '200_OK' }}
                                </span>
                            </div>

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="display-font text-lg sm:text-xl font-black uppercase tracking-tight text-white leading-tight mb-0.5">
                                        {{ alertType === 'error' ? 'SUBMISSION REJECTED' : 'OPERATION SUCCESSFUL' }}
                                    </h4>
                                    <p class="font-sans text-xs text-white/90 leading-relaxed font-light">
                                        {{ alertMessage }}
                                    </p>
                                </div>
                                <button @click="alertMessage = ''" class="text-white/60 hover:text-white p-1 font-mono text-xs font-bold cursor-pointer transition-colors" title="Dismiss">
                                    ✕
                                </button>
                            </div>
                        </div>

                        <form @submit.prevent="saveProject" class="space-y-6">
                            <!-- TAB 1: GENERAL & HERO -->
                            <div v-show="activeTab === 'general'" class="space-y-6">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                                    <!-- Title -->
                                    <div class="sm:col-span-2">
                                        <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                            PROJECT TITLE *
                                        </label>
                                        <input v-model="form.title" type="text" required placeholder="e.g. AQUAVERSE"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-medium" />
                                    </div>

                                    <!-- Release Year -->
                                    <div>
                                        <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                            RELEASE YEAR *
                                        </label>
                                        <input v-model="form.year" type="text" required placeholder="2026"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-bold" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <!-- Custom Slug -->
                                    <div>
                                        <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                            CUSTOM URL SLUG (OPTIONAL - AUTO GENERATED)
                                        </label>
                                        <input v-model="form.slug" type="text" placeholder="e.g. aquaverse"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors" />
                                    </div>

                                    <!-- Role / Personal Responsibility -->
                                    <div>
                                        <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                            YOUR ROLE / SCOPE
                                        </label>
                                        <input v-model="form.role" type="text" placeholder="e.g. Lead VR Developer & System Architect"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors" />
                                    </div>
                                </div>

                                <!-- Category Selection -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                        CATEGORY *
                                    </label>
                                    <div class="flex flex-wrap gap-2 mb-2.5">
                                        <button type="button" v-for="cat in presetCategories" :key="cat"
                                            @click="form.category = cat"
                                            class="font-mono text-[9px] sm:text-[10px] tracking-[0.15em] uppercase px-3 py-1.5 border transition-all cursor-pointer font-bold"
                                            :class="form.category === cat ? 'bg-[var(--heading)] text-[var(--bg)] border-[var(--heading)]' : 'border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)]'">
                                            {{ cat }}
                                        </button>
                                    </div>
                                    <input v-model="form.category" type="text" required placeholder="Custom category..."
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 font-sans text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold" />
                                </div>

                                <!-- Short Description / Tagline -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                        SHORT SUMMARY / TAGLINE (FOR CARDS &amp; HERO) *
                                    </label>
                                    <textarea v-model="form.desc" required rows="2" placeholder="Concise description of the experience..."
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>

                                <!-- Hero Image via Drag & Drop / File Manager / Server Storage -->
                                <div>
                                    <ImageDropzone
                                        v-model="form.image"
                                        label="HERO IMAGE / COVER VISUAL"
                                    />
                                </div>

                                <!-- Action Links (GitHub, Live Demo, Docs) -->
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-[var(--border-subtle)]">
                                    <div>
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1">GITHUB REPO URL</label>
                                        <input v-model="form.github_url" type="url" placeholder="https://github.com/..."
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                    </div>
                                    <div>
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1">LIVE DEMO URL</label>
                                        <input v-model="form.live_url" type="url" placeholder="https://..."
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                    </div>
                                    <div>
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1">DOCUMENTATION URL</label>
                                        <input v-model="form.documentation_url" type="url" placeholder="https://docs..."
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: OVERVIEW & CASE STUDY NARRATIVE -->
                            <div v-show="activeTab === 'narrative'" class="space-y-6">
                                <!-- Full Overview -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                        01 // FULL PROJECT OVERVIEW &amp; VISION
                                    </label>
                                    <textarea v-model="form.overview" rows="4" placeholder="Deep contextual narrative explaining why this project was built, its scope, and core objectives..."
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>

                                <!-- Problem vs Solution Split -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                    <div>
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-red-400 uppercase mb-1.5 font-semibold">
                                            CHALLENGE / PROBLEM STATEMENT
                                        </label>
                                        <textarea v-model="form.problem" rows="3" placeholder="What specific problem or technical limitation did this project address?"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-red-500/60 px-3 py-2 text-xs font-sans text-[var(--heading)] focus:outline-none"></textarea>
                                    </div>
                                    <div>
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-emerald-400 uppercase mb-1.5 font-semibold">
                                            ENGINEERED SOLUTION
                                        </label>
                                        <textarea v-model="form.solution" rows="3" placeholder="How did your architecture and design solve this challenge?"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-emerald-500/60 px-3 py-2 text-xs font-sans text-[var(--heading)] focus:outline-none"></textarea>
                                    </div>
                                </div>

                                <!-- Personal Contribution -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                        02 // MY PERSONAL CONTRIBUTION &amp; IMPLEMENTED SYSTEMS
                                    </label>
                                    <textarea v-model="form.contribution" rows="3" placeholder="Explain the systems you personally developed, algorithms authored, and architectural decisions..."
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>
                            </div>

                            <!-- TAB 3: TECH & KEY FEATURES -->
                            <div v-show="activeTab === 'features'" class="space-y-8">
                                <!-- Tech Stack Input -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase mb-1.5">
                                        TECHNOLOGIES &amp; MODULES (COMMA SEPARATED)
                                    </label>
                                    <input v-model="tagsInput" type="text" placeholder="Unity 3D, C#, OpenXR, Meta Quest 2, Shader Graph"
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold" />

                                    <div v-if="parsedTags.length > 0" class="flex flex-wrap gap-2 mt-3">
                                        <span v-for="tag in parsedTags" :key="tag"
                                            class="font-mono text-[9px] tracking-wider uppercase px-2.5 py-1 border border-blue-500/40 text-blue-400 bg-blue-950/30 font-bold">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Key Features Repeater Builder -->
                                <div class="pt-6 border-t border-[var(--border-subtle)]">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                                FEATURE SHOWCASE LIST
                                            </span>
                                            <h4 class="display-font text-xl font-bold uppercase text-[var(--heading)]">
                                                KEY FEATURES ({{ form.features.length }})
                                            </h4>
                                        </div>
                                        <button type="button" @click="addFeature"
                                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer">
                                            + ADD FEATURE
                                        </button>
                                    </div>

                                    <div v-if="form.features.length === 0" class="p-6 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                        NO KEY FEATURES ADDED YET. CLICK "+ ADD FEATURE" TO CREATE ONE.
                                    </div>

                                    <div v-else class="space-y-6">
                                        <div v-for="(feat, idx) in form.features" :key="idx"
                                            class="p-4 sm:p-5 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 relative space-y-4">
                                            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                                                <span class="font-mono text-xs font-bold text-[var(--heading)]">FEATURE #{{ feat.number || (idx + 1) }}</span>
                                                <button type="button" @click="removeFeature(idx)"
                                                    class="text-red-400 hover:text-red-300 text-xs font-mono font-bold cursor-pointer">
                                                    ✕ REMOVE
                                                </button>
                                            </div>

                                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                                <div>
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">NUMBER</label>
                                                    <input v-model="feat.number" type="text" placeholder="01"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1.5 text-xs font-mono text-[var(--heading)]" />
                                                </div>
                                                <div class="sm:col-span-3">
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FEATURE TITLE</label>
                                                    <input v-model="feat.title" type="text" placeholder="e.g. FISHING & HARVESTING SYSTEM"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1.5 text-xs font-sans text-[var(--heading)] uppercase font-semibold" />
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">TECHNICAL SPECS / SUBTITLE</label>
                                                <input v-model="feat.tech" type="text" placeholder="e.g. Physics Raycasting · Weighted Probability · State Machine"
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1.5 text-xs font-mono text-[var(--muted)]" />
                                            </div>

                                            <div>
                                                <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FEATURE EXPLANATION</label>
                                                <textarea v-model="feat.description" rows="2" placeholder="Explain the mechanics and architectural implementation..."
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1.5 text-xs font-sans text-[var(--heading)] leading-relaxed"></textarea>
                                            </div>

                                            <!-- Feature Visual via Drag & Drop -->
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

                            <!-- TAB 4: RESULTS & GALLERY -->
                            <div v-show="activeTab === 'results'" class="space-y-8">
                                <!-- Result Statement -->
                                <div class="space-y-4">
                                    <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        01 // OUTCOME &amp; PERFORMANCE STATEMENT
                                    </span>
                                    <div>
                                        <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">RESULT HEADLINE</label>
                                        <input v-model="form.result_headline" type="text" placeholder="e.g. STANDALONE PERFORMANCE & ENGAGEMENT"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-sans text-[var(--heading)] uppercase font-semibold" />
                                    </div>
                                    <div>
                                        <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">RESULT SUMMARY</label>
                                        <textarea v-model="form.result_summary" rows="2" placeholder="Delivered 72+ FPS experience directly on standalone Meta Quest..."
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-3 py-2 text-xs font-sans text-[var(--heading)] leading-relaxed"></textarea>
                                    </div>
                                </div>

                                <!-- Result Metrics Builder -->
                                <div class="pt-6 border-t border-[var(--border-subtle)]">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                                NUMERICAL DATA POINTS
                                            </span>
                                            <h4 class="display-font text-xl font-bold uppercase text-[var(--heading)]">
                                                METRICS ({{ form.result_metrics.length }})
                                            </h4>
                                        </div>
                                        <button type="button" @click="addMetric"
                                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-3 py-1.5 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer">
                                            + ADD METRIC
                                        </button>
                                    </div>

                                    <div v-if="form.result_metrics.length === 0" class="p-4 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                        NO METRICS ADDED YET.
                                    </div>

                                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div v-for="(metric, idx) in form.result_metrics" :key="idx"
                                            class="p-3 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 flex items-center gap-3">
                                            <div class="flex-1 space-y-2">
                                                <input v-model="metric.value" type="text" placeholder="Value (e.g. 72 FPS)"
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1 text-xs font-mono text-[var(--heading)] font-bold" />
                                                <input v-model="metric.label" type="text" placeholder="Label (e.g. Framerate on Quest 2)"
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1 text-xs font-sans text-[var(--muted)]" />
                                            </div>
                                            <button type="button" @click="removeMetric(idx)"
                                                class="text-red-400 hover:text-red-300 font-mono text-xs px-2 py-1 cursor-pointer">
                                                ✕
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Visual Gallery Builder -->
                                <div class="pt-6 border-t border-[var(--border-subtle)]">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <span class="font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                                VISUAL SHOWCASE FRAMES
                                            </span>
                                            <h4 class="display-font text-xl font-bold uppercase text-[var(--heading)]">
                                                GALLERY ({{ form.gallery.length }})
                                            </h4>
                                        </div>
                                        <button type="button" @click="addGalleryItem"
                                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-3 py-1.5 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer">
                                            + ADD GALLERY IMAGE
                                        </button>
                                    </div>

                                    <div v-if="form.gallery.length === 0" class="p-4 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                        NO GALLERY IMAGES ADDED YET.
                                    </div>

                                    <div v-else class="space-y-4">
                                        <div v-for="(item, idx) in form.gallery" :key="idx"
                                            class="p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 space-y-3">
                                            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                                                <span class="font-mono text-xs font-bold text-[var(--heading)]">FRAME #0{{ idx + 1 }}</span>
                                                <button type="button" @click="removeGalleryItem(idx)"
                                                    class="text-red-400 hover:text-red-300 font-mono text-xs cursor-pointer font-bold">
                                                    ✕ REMOVE
                                                </button>
                                            </div>

                                            <ImageDropzone
                                                v-model="item.url"
                                                label="GALLERY FRAME IMAGE"
                                                compact
                                            />

                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                                <div>
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FRAME TITLE</label>
                                                    <input v-model="item.title" type="text" placeholder="Title (e.g. Research Laboratory)"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1.5 text-xs font-sans text-[var(--heading)]" />
                                                </div>
                                                <div>
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">CAPTION / CONTEXT</label>
                                                    <input v-model="item.caption" type="text" placeholder="Caption / explanation"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] px-2.5 py-1.5 text-xs font-sans text-[var(--muted)]" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons Bottom Bar -->
                            <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-[var(--border-subtle)]">
                                <button type="button" @click="closeModal"
                                    class="font-sans text-xs tracking-[0.18em] uppercase px-5 py-2.5 border-2 border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)] transition-colors font-bold cursor-pointer">
                                    CANCEL
                                </button>
                                <button type="submit" :disabled="isSaving"
                                    class="font-sans text-xs tracking-[0.2em] uppercase px-8 py-3.5 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-opacity disabled:opacity-50 cursor-pointer shadow-xl">
                                    {{ isSaving ? 'SAVING...' : (editingId ? 'UPDATE CASE STUDY' : 'CREATE CASE STUDY') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { computed, ref } from 'vue';
import ImageDropzone from './ImageDropzone.vue';

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close', 'updated']);

const activeTab = ref('general'); // 'general' | 'narrative' | 'features' | 'results'
const isSaving = ref(false);
const editingId = ref(null);
const alertMessage = ref('');
const alertType = ref('success');

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
    features: [],
    result_headline: '',
    result_summary: '',
    result_metrics: [],
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

// Dynamic Repeaters Controls
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

const showAlert = (msg, type = 'success') => {
    alertMessage.value = msg;
    alertType.value = type;
    setTimeout(() => {
        if (alertMessage.value === msg) alertMessage.value = '';
    }, 4000);
};

const openCreateForm = () => {
    editingId.value = null;
    activeTab.value = 'general';
    form.value = {
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
    };
    tagsInput.value = '';
};

const openEditForm = (proj) => {
    editingId.value = proj.id;
    activeTab.value = 'general';
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
};

const closeModal = () => {
    emit('close');
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
        const url = editingId.value ? `/api/projects/${editingId.value}` : '/api/projects';
        const method = editingId.value ? 'PUT' : 'POST';

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
            emit('updated');
            closeModal();
        } else {
            showAlert(json.message || 'Failed to save case study.', 'error');
        }
    } catch (err) {
        showAlert('An error occurred while saving.', 'error');
    } finally {
        isSaving.value = false;
    }
};

defineExpose({
    openCreateForm,
    openEditForm,
});
</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.25s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}
</style>
