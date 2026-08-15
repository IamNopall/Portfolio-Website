<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div v-if="isOpen"
                class="fixed inset-0 z-[100] flex items-center justify-center p-2 sm:p-6 md:p-8 bg-black/80 backdrop-blur-md overflow-y-auto font-sans">
                <div class="relative w-full max-w-4xl bg-[var(--bg)] text-[var(--text)] border border-[var(--border-subtle)] shadow-2xl my-auto overflow-hidden transition-all duration-300 rounded-none max-h-[96vh] flex flex-col"
                    @click.stop>

                    <!-- Header Bar -->
                    <div class="flex items-center justify-between px-4 sm:px-8 py-3.5 sm:py-5 border-b border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 gap-3 shrink-0">
                        <div class="min-w-0">
                            <span class="font-mono text-[8px] sm:text-[9px] tracking-[0.2em] sm:tracking-[0.22em] text-[var(--muted)] uppercase block mb-0.5 sm:mb-1">
                                {{ editingId ? 'EDITING PROJECT #' + editingId : 'NEW PROJECT ENTRY' }}
                            </span>
                            <h2 class="display-font text-xl sm:text-3xl font-black uppercase tracking-tight text-[var(--heading)] leading-none truncate">
                                {{ editingId ? (form.title || 'EDIT PROJECT') : 'CREATE CASE STUDY' }}
                            </h2>
                        </div>
                        <button @click="closeModal"
                            class="p-1.5 sm:p-2 text-[var(--muted)] hover:text-[var(--heading)] transition-colors focus:outline-none cursor-pointer font-sans text-[10px] sm:text-xs uppercase tracking-widest flex items-center gap-1.5 shrink-0"
                            title="Close">
                            <span class="hidden xs:inline">CLOSE</span>
                            <span class="text-sm">✕</span>
                        </button>
                    </div>

                    <!-- Minimalist Tab Navigation Bar -->
                    <div class="px-4 sm:px-8 bg-[var(--bg)] border-b border-[var(--border-subtle)] shrink-0">
                        <div class="flex items-center gap-2 sm:gap-4 overflow-x-auto font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase scrollbar-none pb-px">
                            <button type="button" v-for="tab in formTabs" :key="tab.id"
                                @click="activeTab = tab.id"
                                class="py-2.5 sm:py-3 transition-all whitespace-nowrap cursor-pointer font-semibold border-b-2 -mb-px shrink-0"
                                :class="activeTab === tab.id
                                    ? 'border-[var(--heading)] text-[var(--heading)]'
                                    : 'border-transparent text-[var(--muted)] hover:text-[var(--text-soft)]'">
                                {{ tab.label }}
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-4 sm:p-8 overflow-y-auto flex-1">
                        <!-- Alert Banner -->
                        <div v-if="alertMessage"
                            class="mb-4 sm:mb-6 p-3 sm:p-4 text-xs font-sans border transition-all duration-300 flex items-center justify-between"
                            :class="alertType === 'error' ? 'border-red-500/40 bg-red-950/20 text-red-300' : 'border-emerald-500/40 bg-emerald-950/20 text-emerald-300'">
                            <p>{{ alertMessage }}</p>
                            <button @click="alertMessage = ''" class="text-xs p-1 cursor-pointer font-bold" title="Dismiss">✕</button>
                        </div>

                        <form @submit.prevent="saveProject" class="space-y-6">
                            <!-- TAB 1: GENERAL & HERO -->
                            <div v-show="activeTab === 'general'" class="space-y-6">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                                    <!-- Title -->
                                    <div class="sm:col-span-2 space-y-1.5">
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                            PROJECT TITLE *
                                        </label>
                                        <input v-model="form.title" type="text" required placeholder="e.g. AQUAVERSE"
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold" />
                                    </div>

                                    <!-- Release Year -->
                                    <div class="space-y-1.5">
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                            RELEASE YEAR *
                                        </label>
                                        <input v-model="form.year" type="text" required placeholder="2026"
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-mono text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-medium" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <!-- Custom Slug -->
                                    <div class="space-y-1.5">
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                            URL SLUG (OPTIONAL)
                                        </label>
                                        <input v-model="form.slug" type="text" placeholder="e.g. aquaverse"
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors" />
                                    </div>

                                    <!-- Role -->
                                    <div class="space-y-1.5">
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                            YOUR ROLE / SCOPE
                                        </label>
                                        <input v-model="form.role" type="text" placeholder="e.g. Lead VR Developer & Architect"
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors" />
                                    </div>
                                </div>

                                <!-- Category Selection -->
                                <div class="space-y-2">
                                    <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        CATEGORY *
                                    </label>
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" v-for="cat in presetCategories" :key="cat"
                                            @click="form.category = cat"
                                            class="font-mono text-[9px] tracking-[0.15em] uppercase px-3 py-1.5 border transition-all cursor-pointer font-medium"
                                            :class="form.category === cat ? 'bg-[var(--heading)] text-[var(--bg)] border-[var(--heading)]' : 'border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--border)]'">
                                            {{ cat }}
                                        </button>
                                    </div>
                                    <input v-model="form.category" type="text" required placeholder="Or custom category..."
                                        class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 font-sans text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider" />
                                </div>

                                <!-- Short Summary -->
                                <div class="space-y-1.5">
                                    <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        SHORT SUMMARY / TAGLINE *
                                    </label>
                                    <textarea v-model="form.desc" required rows="2" placeholder="Concise overview of the project..."
                                        class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>

                                <!-- Hero Image Dropzone -->
                                <div>
                                    <ImageDropzone
                                        v-model="form.image"
                                        label="HERO COVER VISUAL"
                                    />
                                </div>

                                <!-- External Links -->
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-[var(--border-subtle)]">
                                    <div class="space-y-1">
                                        <label class="block font-mono text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase">GITHUB URL</label>
                                        <input v-model="form.github_url" type="url" placeholder="https://github.com/..."
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block font-mono text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase">LIVE DEMO URL</label>
                                        <input v-model="form.live_url" type="url" placeholder="https://..."
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block font-mono text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase">DOCUMENTATION URL</label>
                                        <input v-model="form.documentation_url" type="url" placeholder="https://docs..."
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: OVERVIEW & CASE STUDY NARRATIVE -->
                            <div v-show="activeTab === 'narrative'" class="space-y-6">
                                <!-- Full Overview -->
                                <div class="space-y-1.5">
                                    <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        PROJECT OVERVIEW &amp; VISION
                                    </label>
                                    <textarea v-model="form.overview" rows="4" placeholder="Contextual narrative explaining why this project was built..."
                                        class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>

                                <!-- Problem vs Solution Split -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                    <div class="space-y-1.5 p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20">
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-red-400 uppercase font-semibold">
                                            CHALLENGE / PROBLEM
                                        </label>
                                        <textarea v-model="form.problem" rows="3" placeholder="What specific problem did this project address?"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-red-400 px-3 py-2 text-xs font-sans text-[var(--heading)] focus:outline-none"></textarea>
                                    </div>
                                    <div class="space-y-1.5 p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20">
                                        <label class="block font-mono text-[9px] tracking-[0.2em] text-emerald-400 uppercase font-semibold">
                                            ENGINEERED SOLUTION
                                        </label>
                                        <textarea v-model="form.solution" rows="3" placeholder="How did your engineered solution solve this challenge?"
                                            class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-emerald-400 px-3 py-2 text-xs font-sans text-[var(--heading)] focus:outline-none"></textarea>
                                    </div>
                                </div>

                                <!-- Personal Contribution -->
                                <div class="space-y-1.5">
                                    <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        PERSONAL CONTRIBUTION &amp; IMPLEMENTATION
                                    </label>
                                    <textarea v-model="form.contribution" rows="3" placeholder="Explain the systems you authored personally..."
                                        class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3.5 py-2.5 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>
                            </div>

                            <!-- TAB 3: TECH & KEY FEATURES -->
                            <div v-show="activeTab === 'features'" class="space-y-6">
                                <!-- Tech Stack Input -->
                                <div class="space-y-1.5">
                                    <label class="block font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                        TECHNOLOGIES &amp; MODULES (COMMA SEPARATED)
                                    </label>
                                    <input v-model="tagsInput" type="text" placeholder="Unity 3D, C#, OpenXR, Meta Quest 2, Shader Graph"
                                        class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider" />

                                    <div v-if="parsedTags.length > 0" class="flex flex-wrap gap-2 pt-2">
                                        <span v-for="tag in parsedTags" :key="tag"
                                            class="font-mono text-[9px] tracking-wider uppercase px-2.5 py-1 border border-[var(--border-subtle)] text-[var(--text-soft)] bg-[var(--hover-bg)]/40">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Key Features Repeater -->
                                <div class="pt-6 border-t border-[var(--border-subtle)] space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="display-font text-xl font-bold uppercase text-[var(--heading)]">
                                                KEY FEATURES ({{ form.features.length }})
                                            </h4>
                                            <span class="font-mono text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase block">
                                                SYSTEM MODULES
                                            </span>
                                        </div>
                                        <button type="button" @click="addFeature"
                                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-3.5 py-1.5 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer">
                                            + ADD FEATURE
                                        </button>
                                    </div>

                                    <div v-if="form.features.length === 0" class="p-6 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                        NO FEATURES ADDED YET.
                                    </div>

                                    <div v-else class="space-y-4">
                                        <div v-for="(feat, idx) in form.features" :key="idx"
                                            class="p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 space-y-3">
                                            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                                                <span class="font-mono text-xs font-semibold text-[var(--heading)]">FEATURE {{ feat.number || (idx + 1) }}</span>
                                                <button type="button" @click="removeFeature(idx)"
                                                    class="text-red-400 hover:text-red-300 text-xs font-mono cursor-pointer">
                                                    REMOVE ✕
                                                </button>
                                            </div>

                                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                                <div>
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">NUMBER</label>
                                                    <input v-model="feat.number" type="text" placeholder="01"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1.5 text-xs font-mono text-[var(--heading)] focus:outline-none" />
                                                </div>
                                                <div class="sm:col-span-3">
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FEATURE TITLE</label>
                                                    <input v-model="feat.title" type="text" placeholder="e.g. FISHING SYSTEM"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1.5 text-xs font-sans text-[var(--heading)] uppercase font-semibold focus:outline-none" />
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">SPECS / SUBTITLE</label>
                                                <input v-model="feat.tech" type="text" placeholder="e.g. Physics Raycasting · State Machine"
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1.5 text-xs font-mono text-[var(--muted)] focus:outline-none" />
                                            </div>

                                            <div>
                                                <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">DESCRIPTION</label>
                                                <textarea v-model="feat.description" rows="2" placeholder="Explain the mechanics..."
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1.5 text-xs font-sans text-[var(--heading)] leading-relaxed focus:outline-none"></textarea>
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

                            <!-- TAB 4: RESULTS & GALLERY -->
                            <div v-show="activeTab === 'results'" class="space-y-6">
                                <!-- Result Statement -->
                                <div class="space-y-3">
                                    <span class="font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase block">
                                        OUTCOME &amp; RESULTS
                                    </span>
                                    <div>
                                        <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">RESULT HEADLINE</label>
                                        <input v-model="form.result_headline" type="text" placeholder="e.g. STANDALONE PERFORMANCE"
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-sans text-[var(--heading)] uppercase font-semibold focus:outline-none" />
                                    </div>
                                    <div>
                                        <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">RESULT SUMMARY</label>
                                        <textarea v-model="form.result_summary" rows="2" placeholder="Delivered 72+ FPS experience directly on Meta Quest..."
                                            class="w-full bg-[var(--hover-bg)]/30 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 text-xs font-sans text-[var(--heading)] leading-relaxed focus:outline-none"></textarea>
                                    </div>
                                </div>

                                <!-- Metrics Repeater -->
                                <div class="pt-6 border-t border-[var(--border-subtle)] space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="display-font text-xl font-bold uppercase text-[var(--heading)]">
                                                METRICS ({{ form.result_metrics.length }})
                                            </h4>
                                            <span class="font-mono text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase block">
                                                DATA POINTS
                                            </span>
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
                                            class="p-3 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 flex items-center gap-3">
                                            <div class="flex-1 space-y-1.5">
                                                <input v-model="metric.value" type="text" placeholder="Value (e.g. 72 FPS)"
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1 text-xs font-mono text-[var(--heading)] font-bold focus:outline-none" />
                                                <input v-model="metric.label" type="text" placeholder="Label (e.g. Framerate on Quest 2)"
                                                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1 text-xs font-sans text-[var(--muted)] focus:outline-none" />
                                            </div>
                                            <button type="button" @click="removeMetric(idx)"
                                                class="text-red-400 hover:text-red-300 font-mono text-xs px-2 py-1 cursor-pointer">
                                                ✕
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Visual Gallery Repeater -->
                                <div class="pt-6 border-t border-[var(--border-subtle)] space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="display-font text-xl font-bold uppercase text-[var(--heading)]">
                                                GALLERY ({{ form.gallery.length }})
                                            </h4>
                                            <span class="font-mono text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase block">
                                                SHOWCASE FRAMES
                                            </span>
                                        </div>
                                        <button type="button" @click="addGalleryItem"
                                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-3 py-1.5 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] transition-colors font-bold cursor-pointer">
                                            + ADD FRAME
                                        </button>
                                    </div>

                                    <div v-if="form.gallery.length === 0" class="p-4 border border-dashed border-[var(--border-subtle)] text-center text-xs font-mono text-[var(--muted)]">
                                        NO GALLERY FRAMES ADDED YET.
                                    </div>

                                    <div v-else class="space-y-4">
                                        <div v-for="(item, idx) in form.gallery" :key="idx"
                                            class="p-4 border border-[var(--border-subtle)] bg-[var(--hover-bg)]/20 space-y-3">
                                            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                                                <span class="font-mono text-xs font-semibold text-[var(--heading)]">FRAME 0{{ idx + 1 }}</span>
                                                <button type="button" @click="removeGalleryItem(idx)"
                                                    class="text-red-400 hover:text-red-300 font-mono text-xs cursor-pointer">
                                                    REMOVE ✕
                                                </button>
                                            </div>

                                            <ImageDropzone
                                                v-model="item.url"
                                                label="FRAME IMAGE"
                                                compact
                                            />

                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                                <div>
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">FRAME TITLE</label>
                                                    <input v-model="item.title" type="text" placeholder="Title (e.g. Research Lab)"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1.5 text-xs font-sans text-[var(--heading)] focus:outline-none" />
                                                </div>
                                                <div>
                                                    <label class="block font-mono text-[8px] text-[var(--muted)] uppercase mb-1">CAPTION</label>
                                                    <input v-model="item.caption" type="text" placeholder="Caption / description"
                                                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2.5 py-1.5 text-xs font-sans text-[var(--muted)] focus:outline-none" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2 sm:gap-3 pt-5 sm:pt-6 border-t border-[var(--border-subtle)]">
                                <button type="button" @click="closeModal"
                                    class="font-sans text-[11px] sm:text-xs tracking-[0.15em] sm:tracking-[0.18em] uppercase px-5 py-2.5 sm:py-3 border border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)] transition-colors font-semibold cursor-pointer text-center">
                                    CANCEL
                                </button>
                                <button type="submit" :disabled="isSaving"
                                    class="font-sans text-[11px] sm:text-xs tracking-[0.18em] sm:tracking-[0.2em] uppercase px-6 py-3 bg-[var(--heading)] text-[var(--bg)] font-bold hover:opacity-90 transition-all disabled:opacity-50 cursor-pointer shadow-md active:scale-[0.98] text-center">
                                    {{ isSaving ? 'SAVING...' : (editingId ? 'SAVE CHANGES' : 'CREATE PROJECT') }}
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

const activeTab = ref('general');
const isSaving = ref(false);
const editingId = ref(null);
const alertMessage = ref('');
const alertType = ref('success');

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
