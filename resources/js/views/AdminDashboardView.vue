<template>
    <div
        class="min-h-screen bg-[var(--bg)] text-[var(--text)] transition-colors duration-300 relative overflow-x-hidden font-sans selection:bg-[var(--heading)] selection:text-[var(--bg)]">
        <!-- Ambient Grid Lines & Background Accent -->
        <div
            class="fixed inset-0 pointer-events-none opacity-10 bg-[radial-gradient(ellipse_at_top,rgba(255,255,255,0.12)_0%,rgba(0,0,0,0)_70%)] light-mode:bg-[radial-gradient(ellipse_at_top,rgba(0,0,0,0.05)_0%,rgba(0,0,0,0)_70%)]">
        </div>
        <div
            class="fixed inset-0 pointer-events-none opacity-[0.07] bg-[linear-gradient(to_right,rgba(255,255,255,0.1)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.1)_1px,transparent_1px)] bg-[size:4rem_4rem] sm:bg-[size:6rem_6rem]">
        </div>

        <!-- 🔒 AUTHENTICATION LOCK SCREEN (If Not Authenticated) -->
        <div v-if="!isAuthenticated"
            class="fixed inset-0 h-[100dvh] w-full flex flex-col justify-between p-4 sm:p-6 md:p-8 lg:p-10 z-30 overflow-hidden bg-[var(--bg)] select-none">

            <!-- Hairline Top Frame / Architectural Breadcrumb -->
            <header
                class="shrink-0 w-full max-w-4xl mx-auto flex items-center justify-between pb-3 sm:pb-4 border-b border-[var(--border-subtle)] font-mono text-[9px] sm:text-[10px] tracking-[0.25em] uppercase text-[var(--muted)]">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--heading)] opacity-60"></span>
                    <span class="text-[var(--text-soft)] font-medium">AUTHORIZATION GATEWAY</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="hidden sm:inline opacity-40">PORTFOLIO OS //</span>
                    <span class="text-[var(--heading)] font-semibold">RESTRICTED ACCESS</span>
                </div>
            </header>

            <!-- Main Central Typographic Focus Area -->
            <main class="shrink-0 w-full max-w-lg mx-auto my-auto py-2 sm:py-4">
                <!-- Eyebrow & Headline -->
                <div class="mb-4 sm:mb-6">
                    <span
                        class="font-mono text-[9px] sm:text-[10px] tracking-[0.25em] text-[var(--muted)] uppercase block mb-1.5 sm:mb-2">
                        001 / SYSTEM VERIFICATION
                    </span>
                    <h1
                        class="display-font text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tighter text-[var(--heading)] leading-[0.85]">
                        SYSTEM<br />ACCESS.
                    </h1>
                </div>

                <!-- Error Notice (Minimal Typographic Accent) -->
                <div v-if="authError"
                    class="mb-4 p-2.5 sm:p-3 border-l-2 border-red-500 bg-red-500/5 text-red-300 font-mono text-xs flex items-center justify-between gap-3 transition-all">
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="text-red-500 font-bold shrink-0">!</span>
                        <span class="tracking-wide truncate">{{ authError }}</span>
                    </div>
                    <button @click="authError = ''" type="button"
                        class="text-red-400 hover:text-white uppercase tracking-widest text-[9px] shrink-0 cursor-pointer font-bold transition-colors">
                        [CLOSE]
                    </button>
                </div>

                <!-- Minimalist Typographic Form -->
                <form @submit.prevent="verifyPin" class="space-y-4 sm:space-y-6">
                    <div class="space-y-2">
                        <div class="flex justify-between items-baseline">
                            <label
                                class="font-mono text-[8px] sm:text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase">
                                ENTER SECURITY PIN
                            </label>
                            <button type="button" @click="showPin = !showPin"
                                class="font-mono text-[8px] sm:text-[9px] tracking-widest text-[var(--muted)] hover:text-[var(--heading)] uppercase transition-colors cursor-pointer">
                                [{{ showPin ? 'HIDE KEY' : 'SHOW KEY' }}]
                            </button>
                        </div>

                        <!-- Minimal Typographic Input Container -->
                        <div
                            class="relative border-b border-[var(--border-subtle)] focus-within:border-[var(--heading)] transition-colors duration-300">
                            <input v-model="pinInput" :type="showPin ? 'text' : 'password'" required autofocus
                                inputmode="numeric" pattern="[0-9]*" placeholder="••••••"
                                class="w-full bg-transparent px-0 py-2 sm:py-3 font-mono text-xl sm:text-3xl tracking-[0.35em] sm:tracking-[0.45em] text-[var(--heading)] focus:outline-none transition-colors placeholder:text-[var(--muted)]/20" />
                        </div>
                    </div>

                    <!-- Clean Typographic Action CTA -->
                    <button type="submit" :disabled="isVerifying"
                        class="group w-full py-3.5 sm:py-4 border border-[var(--heading)] bg-[var(--heading)] text-[var(--bg)] hover:bg-transparent hover:text-[var(--heading)] font-sans text-xs sm:text-sm font-black uppercase tracking-[0.22em] transition-all duration-300 flex items-center justify-between px-5 sm:px-6 cursor-pointer disabled:opacity-40 disabled:pointer-events-none active:scale-[0.99] shadow-sm">
                        <span>{{ isVerifying ? 'AUTHENTICATING...' : 'AUTHENTICATE & ENTER' }}</span>
                        <span
                            class="font-mono text-base transform group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                    </button>
                </form>
            </main>

            <!-- Bottom Hairline Footer Frame -->
            <footer
                class="shrink-0 w-full max-w-4xl mx-auto flex items-center justify-between pt-3 sm:pb-1 border-t border-[var(--border-subtle)] font-mono text-[8px] sm:text-[9px] tracking-[0.2em] uppercase text-[var(--muted)]">
                <router-link to="/"
                    class="hover:text-[var(--heading)] transition-colors inline-flex items-center gap-1.5 font-sans text-[11px] sm:text-xs tracking-[0.12em] font-medium group">
                    <span class="group-hover:-translate-x-1 transition-transform">←</span>
                    <span>RETURN TO PORTFOLIO</span>
                </router-link>
                <span class="opacity-40 hidden sm:inline">SHA-256 SECURED ENVIRONMENT</span>
            </footer>
        </div>

        <!-- 🔓 DASHBOARD MAIN WORKSPACE (If Authenticated) -->
        <template v-else>
            <!-- Top HUD Navigation Bar -->
            <header
                class="border-b border-[var(--border-subtle)] sticky top-0 bg-[var(--bg)]/95 backdrop-blur-xl z-40 px-4 sm:px-8 py-4 sm:py-5 transition-colors">
                <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">
                    <!-- Brand & Status -->
                    <div class="flex items-center gap-3 sm:gap-5">
                        <div class="relative flex items-center justify-center shrink-0">
                            <span
                                class="w-3 h-3 sm:w-3.5 sm:h-3.5 rounded-full bg-emerald-500 animate-ping absolute opacity-75"></span>
                            <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-emerald-400 relative"></span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 sm:gap-3">
                                <h1
                                    class="display-font text-lg sm:text-2xl font-black uppercase tracking-tight text-[var(--heading)] leading-none">
                                    NAUFAL TSAQIF
                                </h1>
                                <span
                                    class="font-mono text-[8px] sm:text-[9px] tracking-[0.15em] sm:tracking-[0.2em] text-[var(--bg)] bg-[var(--heading)] font-bold px-1.5 py-0.5 uppercase shrink-0">
                                    ADMIN OS
                                </span>
                            </div>
                            <div
                                class="hidden sm:flex items-center gap-3 font-mono text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase mt-0.5">
                                <span>PORTFOLIO EDITORIAL CONSOLE</span>
                                <span class="opacity-30">•</span>
                                <span>DB: MYSQL_3306</span>
                            </div>
                        </div>
                    </div>

                    <!-- Clock & Navigation -->
                    <div class="flex items-center gap-2 sm:gap-6 shrink-0">
                        <div
                            class="hidden lg:flex flex-col text-right font-mono text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">
                            <span class="text-[var(--heading)] font-semibold">{{ liveTime }}</span>
                            <span class="text-[8px] opacity-60">SYSTEM LOCAL TIME</span>
                        </div>

                        <router-link to="/"
                            class="font-sans text-[10px] sm:text-xs tracking-[0.15em] sm:tracking-[0.2em] uppercase px-3 py-2 sm:px-5 sm:py-2.5 border border-[var(--border-subtle)] text-[var(--text-soft)] hover:text-[var(--heading)] hover:border-[var(--heading)] hover:bg-[var(--hover-bg)] transition-all flex items-center gap-1.5 group font-semibold">
                            <span class="group-hover:-translate-x-1 transition-transform">←</span> PORTFOLIO
                        </router-link>

                        <button @click="changePinRef?.open()"
                            class="font-sans text-[10px] sm:text-xs tracking-[0.15em] sm:tracking-[0.2em] uppercase px-3 py-2 sm:px-4 sm:py-2.5 border border-[var(--border-subtle)] text-[var(--text-soft)] hover:text-[var(--heading)] hover:border-[var(--heading)] hover:bg-[var(--hover-bg)] transition-all cursor-pointer font-semibold flex items-center gap-1.5"
                            title="Manage Security PIN">
                            <span>🔑</span> <span class="hidden sm:inline">PIN</span>
                        </button>

                        <button @click="logout"
                            class="font-sans text-[10px] sm:text-xs tracking-[0.15em] sm:tracking-[0.2em] uppercase px-3 py-2 sm:px-4 sm:py-2.5 border border-red-900/40 text-red-400 hover:bg-red-950/40 hover:border-red-600 transition-all cursor-pointer font-semibold flex items-center gap-1"
                            title="Lock Console">
                            <span>🔒</span> <span class="hidden sm:inline">LOGOUT</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Dashboard Body -->
            <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-12 relative z-10">
                <!-- Header Title & Quick Action -->
                <div
                    class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8 sm:mb-12 pb-6 sm:pb-10 border-b-2 border-[var(--heading)]">
                    <div>
                        <div
                            class="flex items-center gap-2 sm:gap-3 mb-2 sm:mb-3 font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.3em] text-[var(--muted)] uppercase">
                            <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 bg-[var(--heading)] inline-block"></span>
                            <span>01 / KARYA INDEX</span>
                        </div>
                        <h2
                            class="display-font text-4xl sm:text-7xl lg:text-8xl font-black uppercase leading-[0.88] sm:leading-[0.85] tracking-tighter text-[var(--heading)]">
                            WORKS CONTROL.
                        </h2>
                    </div>

                    <button @click="openCreateModal"
                        class="font-sans text-xs tracking-[0.2em] sm:tracking-[0.25em] uppercase px-6 py-3.5 sm:px-8 sm:py-4 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-all self-stretch sm:self-auto shadow-xl active:scale-[0.98] cursor-pointer flex items-center justify-center gap-2 sm:gap-3">
                        <span class="text-base font-bold">+</span> ADD NEW WORK
                    </button>
                </div>

                <!-- Editorial High-Contrast Typography Metrics Grid -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-8 sm:mb-14">
                    <!-- Total Works -->
                    <div
                        class="p-4 sm:p-8 border border-[var(--border-subtle)] bg-[var(--bg)] relative overflow-hidden group hover:border-[var(--heading)] transition-colors">
                        <div
                            class="flex justify-between items-baseline mb-4 sm:mb-6 border-b border-[var(--border-subtle)] pb-2 sm:pb-3">
                            <span
                                class="font-mono text-[8px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.25em] uppercase text-[var(--muted)] font-semibold">
                                01 / INDEXED
                            </span>
                            <span
                                class="font-mono text-[8px] sm:text-[9px] text-[var(--muted)] tracking-widest uppercase">COUNT</span>
                        </div>
                        <div
                            class="display-font text-4xl sm:text-6xl font-black text-[var(--heading)] tracking-tighter leading-none">
                            {{ projects.length }}
                        </div>
                        <p
                            class="font-sans text-[8px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.18em] uppercase text-[var(--muted)] mt-2">
                            TOTAL KARYA DATABASE</p>
                    </div>

                    <!-- Website Projects -->
                    <div
                        class="p-4 sm:p-8 border border-[var(--border-subtle)] bg-[var(--bg)] relative overflow-hidden group hover:border-[var(--heading)] transition-colors">
                        <div
                            class="flex justify-between items-baseline mb-4 sm:mb-6 border-b border-[var(--border-subtle)] pb-2 sm:pb-3">
                            <span
                                class="font-mono text-[8px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.25em] uppercase text-[var(--muted)] font-semibold">
                                02 / WEB DEV
                            </span>
                            <span
                                class="font-mono text-[8px] sm:text-[9px] text-blue-400 tracking-widest uppercase font-semibold">WEB</span>
                        </div>
                        <div
                            class="display-font text-4xl sm:text-6xl font-black text-[var(--heading)] tracking-tighter leading-none">
                            {{ websiteCount }}
                        </div>
                        <p
                            class="font-sans text-[8px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.18em] uppercase text-[var(--muted)] mt-2">
                            FRONTEND &amp; FULLSTACK</p>
                    </div>

                    <!-- Unity Projects -->
                    <div
                        class="p-4 sm:p-8 border border-[var(--border-subtle)] bg-[var(--bg)] relative overflow-hidden group hover:border-[var(--heading)] transition-colors">
                        <div
                            class="flex justify-between items-baseline mb-4 sm:mb-6 border-b border-[var(--border-subtle)] pb-2 sm:pb-3">
                            <span
                                class="font-mono text-[8px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.25em] uppercase text-[var(--muted)] font-semibold">
                                03 / GAME 3D
                            </span>
                            <span
                                class="font-mono text-[8px] sm:text-[9px] text-purple-400 tracking-widest uppercase font-semibold">UNITY</span>
                        </div>
                        <div
                            class="display-font text-4xl sm:text-6xl font-black text-[var(--heading)] tracking-tighter leading-none">
                            {{ unityCount }}
                        </div>
                        <p
                            class="font-sans text-[8px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.18em] uppercase text-[var(--muted)] mt-2">
                            UNITY 3D &amp; GAME</p>
                    </div>

                    <!-- System Status -->
                    <div
                        class="p-4 sm:p-8 border border-[var(--border-subtle)] bg-[var(--bg)] relative overflow-hidden group hover:border-[var(--heading)] transition-colors col-span-1 sm:col-span-1">
                        <div
                            class="flex justify-between items-baseline mb-4 sm:mb-6 border-b border-[var(--border-subtle)] pb-2 sm:pb-3">
                            <span
                                class="font-mono text-[8px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.25em] uppercase text-[var(--muted)] font-semibold">
                                04 / BACKEND
                            </span>
                            <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full bg-emerald-400"></span>
                        </div>
                        <div
                            class="display-font text-2xl sm:text-4xl font-black text-emerald-400 tracking-tighter leading-none uppercase">
                            200 OK
                        </div>
                        <p
                            class="font-sans text-[8px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.18em] uppercase text-[var(--muted)] mt-2 sm:mt-3">
                            REST API ONLINE</p>
                    </div>
                </div>

                <!-- Toolbar Controls: Typography Search & Filter Strip -->
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 sm:gap-6 mb-6 sm:mb-8 pb-4 sm:pb-6 border-b border-[var(--border-subtle)]">
                    <!-- Search Bar -->
                    <div class="relative flex-1">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[var(--muted)] font-mono text-[10px] sm:text-xs">
                            SEARCH:
                        </div>
                        <input v-model="searchQuery" type="text" placeholder="Filter title, description, stack..."
                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] pl-20 sm:pl-24 pr-8 py-2.5 sm:py-3 font-sans text-xs text-[var(--heading)] focus:border-[var(--heading)] focus:outline-none transition-colors placeholder:text-[var(--muted)]/50 uppercase tracking-wider font-medium" />
                        <button v-if="searchQuery" @click="searchQuery = ''"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-xs text-[var(--muted)] hover:text-[var(--heading)] font-bold">
                            ✕
                        </button>
                    </div>

                    <!-- Category Pills -->
                    <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
                        <button v-for="cat in categories" :key="cat" @click="selectedCategory = cat"
                            class="font-mono text-[9px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.2em] uppercase px-3 py-2 sm:px-4 sm:py-2.5 border border-[var(--border-subtle)] transition-all whitespace-nowrap cursor-pointer flex items-center gap-1.5 font-semibold"
                            :class="selectedCategory === cat
                                ? 'bg-[var(--heading)] text-[var(--bg)] font-black border-[var(--heading)] shadow-md'
                                : 'text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)]'">
                            <span>{{ cat }}</span>
                            <span class="text-[8px] opacity-70">
                                [{{cat === 'All' ? projects.length : projects.filter(p => p.category === cat).length
                                }}]
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Batch Delete Actions Bar (Classic Typographic Architectural Strip) -->
                <div v-if="selectedIds.length > 0"
                    class="mb-6 relative border-2 border-amber-500/80 bg-[#160f04]/95 p-4 sm:p-5 text-amber-100 shadow-[0_20px_45px_-10px_rgba(245,158,11,0.25)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 transition-all duration-300 overflow-hidden">
                    <!-- Corner Crosshairs -->
                    <span class="absolute top-1 left-1.5 font-mono text-[9px] text-amber-400/50 select-none">+</span>
                    <span class="absolute top-1 right-1.5 font-mono text-[9px] text-amber-400/50 select-none">+</span>
                    <span class="absolute bottom-1 left-1.5 font-mono text-[9px] text-amber-400/50 select-none">+</span>
                    <span
                        class="absolute bottom-1 right-1.5 font-mono text-[9px] text-amber-400/50 select-none">+</span>

                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                        <div
                            class="w-9 h-9 border border-amber-500/50 bg-amber-950/80 flex items-center justify-center font-mono text-xs font-bold text-amber-300 shrink-0">
                            0{{ selectedIds.length }}
                        </div>
                        <div>
                            <div
                                class="flex items-center gap-2 font-mono text-[8px] sm:text-[9px] tracking-[0.25em] text-amber-400 uppercase font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                <span>STAGING QUEUE // BATCH PROTOCOL</span>
                            </div>
                            <h4
                                class="display-font text-xl sm:text-2xl font-black uppercase tracking-tight text-white leading-tight truncate">
                                {{ selectedIds.length }} {{ selectedIds.length === 1 ? 'WORK RECORD' : 'WORK RECORDS' }}
                                SELECTED FOR PURGE
                            </h4>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-2 sm:gap-3 shrink-0 self-end sm:self-auto w-full sm:w-auto justify-end">
                        <button @click="selectedIds = []"
                            class="font-sans text-[10px] sm:text-xs tracking-[0.18em] uppercase px-4 py-2 border border-amber-500/50 hover:border-amber-300 text-amber-200 hover:text-white transition-all cursor-pointer font-bold">
                            DESELECT ALL
                        </button>
                        <button @click="deleteSelected"
                            class="font-sans text-[10px] sm:text-xs tracking-[0.2em] uppercase px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white font-black transition-all cursor-pointer shadow-lg active:scale-[0.98] flex items-center gap-1.5">
                            <span>✕</span> EXECUTE PURGE
                        </button>
                    </div>
                </div>

                <!-- Projects Index View (Responsive Card Stack for Mobile, High-Contrast Data Table for Tablet/Desktop) -->
                <div class="border-2 border-[var(--heading)] bg-[var(--bg)] overflow-hidden shadow-2xl">
                    <!-- Loading State -->
                    <div v-if="isLoading" class="py-20 sm:py-28 text-center">
                        <div
                            class="inline-block w-7 h-7 sm:w-8 sm:h-8 border-2 border-[var(--heading)] border-t-transparent rounded-full animate-spin mb-4">
                        </div>
                        <p class="font-mono text-[10px] sm:text-xs uppercase tracking-[0.2em] text-[var(--muted)]">
                            FETCHING KARYA FROM BACKEND REST API...
                        </p>
                    </div>

                    <!-- Empty State -->
                    <div v-else-if="filteredProjects.length === 0" class="py-20 sm:py-28 text-center px-4">
                        <p
                            class="display-font text-3xl sm:text-5xl font-black text-[var(--muted)] uppercase mb-3 tracking-tight">
                            NO KARYA FOUND</p>
                        <p class="font-sans text-xs text-[var(--muted)] max-w-md mx-auto mb-6 sm:mb-8 leading-relaxed">
                            Tidak ada karya yang cocok dengan kata kunci "{{ searchQuery }}". Sesuaikan filter atau
                            tambah karya baru.
                        </p>
                        <button @click="openCreateModal"
                            class="font-sans text-xs tracking-[0.2em] uppercase px-6 py-3 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90">
                            + CREATE NEW WORK
                        </button>
                    </div>

                    <!-- Data View -->
                    <div v-else>
                        <!-- Mobile Responsive Card View (< md) -->
                        <div class="block md:hidden divide-y divide-[var(--border-subtle)]">
                            <div v-for="(proj, idx) in filteredProjects" :key="proj.id"
                                class="p-5 space-y-3 bg-[var(--bg)] flex items-start gap-3">

                                <!-- Mobile Checkbox Selection -->
                                <input type="checkbox" :value="proj.id" v-model="selectedIds"
                                    class="mt-1 accent-white w-4 h-4 shrink-0 cursor-pointer" />

                                <div class="flex-1 space-y-3">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <div
                                                class="flex items-center gap-2 font-mono text-[9px] text-[var(--muted)] mb-1">
                                                <span>0{{ idx + 1 }}</span>
                                                <span>•</span>
                                                <span>RELEASE {{ proj.year }}</span>
                                            </div>
                                            <h3
                                                class="display-font text-2xl font-black uppercase text-[var(--heading)] tracking-tight leading-none">
                                                {{ proj.title }}
                                            </h3>
                                        </div>
                                        <span
                                            class="font-mono text-[8px] tracking-wider uppercase px-2 py-0.5 border border-[var(--heading)] font-bold shrink-0"
                                            :class="proj.category === 'Website'
                                                ? 'bg-blue-950/20 text-blue-400 border-blue-500/40'
                                                : (proj.category === 'Unity' ? 'bg-purple-950/20 text-purple-400 border-purple-500/40' : 'bg-[var(--bg)] text-[var(--heading)]')">
                                            {{ proj.category }}
                                        </span>
                                    </div>

                                    <p class="font-sans text-xs text-[var(--text-soft)] leading-relaxed">
                                        {{ proj.desc }}
                                    </p>

                                    <div v-if="proj.tags && proj.tags.length > 0" class="flex flex-wrap gap-1 pt-1">
                                        <span v-for="tag in proj.tags" :key="tag"
                                            class="font-mono text-[8px] tracking-wider uppercase px-2 py-0.5 border border-[var(--border-subtle)] text-[var(--muted)] font-semibold bg-[var(--bg)]">
                                            {{ tag }}
                                        </span>
                                    </div>

                                    <div
                                        class="flex items-center justify-end gap-2 pt-3 border-t border-[var(--border-subtle)]/50">
                                        <button @click="triggerEdit(proj)"
                                            class="font-sans text-[9px] tracking-[0.18em] uppercase px-3.5 py-1.5 border border-[var(--heading)] text-[var(--heading)] font-black active:bg-[var(--heading)] active:text-[var(--bg)]">
                                            EDIT
                                        </button>
                                        <button @click="deleteProject(proj)"
                                            class="font-sans text-[9px] tracking-[0.18em] uppercase px-3.5 py-1.5 border border-red-900/50 text-red-400 font-bold active:bg-red-950">
                                            DELETE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Desktop Data Table View (>= md) -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="border-b-2 border-[var(--heading)] bg-[var(--hover-bg)] font-mono text-[10px] tracking-[0.25em] uppercase text-[var(--heading)] select-none">
                                        <th class="py-4 px-6 font-bold w-12 text-center">
                                            <input type="checkbox" v-model="selectAll"
                                                class="accent-white cursor-pointer w-4.5 h-4.5 align-middle" />
                                        </th>
                                        <th class="py-4 px-6 font-bold w-16"># INDEX</th>
                                        <th class="py-4 px-6 font-bold">KARYA TITLE &amp; EDITORIAL SUMMARY</th>
                                        <th class="py-4 px-6 font-bold">CATEGORY</th>
                                        <th class="py-4 px-6 font-bold">YEAR</th>
                                        <th class="py-4 px-6 font-bold">STACK / TAGS</th>
                                        <th class="py-4 px-6 font-bold text-right">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[var(--border-subtle)]">
                                    <tr v-for="(proj, idx) in filteredProjects" :key="proj.id"
                                        class="hover:bg-[var(--hover-bg)] transition-colors group border-l-4 border-l-transparent hover:border-l-[var(--heading)]">

                                        <!-- Selection Checkbox -->
                                        <td class="py-6 px-6 text-center">
                                            <input type="checkbox" :value="proj.id" v-model="selectedIds"
                                                class="accent-white cursor-pointer w-4 h-4 align-middle" />
                                        </td>

                                        <!-- Index -->
                                        <td
                                            class="py-6 px-6 font-mono text-xs text-[var(--muted)] tabular-nums font-semibold">
                                            0{{ idx + 1 }}
                                        </td>

                                        <!-- Title & Description with Image Preview -->
                                        <td class="py-6 px-6 max-w-md">
                                            <div class="flex items-start gap-4">
                                                <div v-if="proj.image"
                                                    class="w-14 h-14 bg-[var(--hover-bg)] border border-[var(--border-subtle)] overflow-hidden shrink-0">
                                                    <img :src="proj.image" :alt="proj.title"
                                                        class="w-full h-full object-cover" />
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3
                                                        class="display-font text-2xl font-black uppercase text-[var(--heading)] group-hover:text-[var(--accent-blue)] transition-colors tracking-tight leading-none mb-1.5 truncate">
                                                        {{ proj.title }}
                                                    </h3>
                                                    <p
                                                        class="font-sans text-xs text-[var(--text-soft)] leading-relaxed line-clamp-2">
                                                        {{ proj.desc }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Category Badge -->
                                        <td class="py-6 px-6 whitespace-nowrap">
                                            <span
                                                class="font-mono text-[9px] tracking-[0.2em] uppercase px-3 py-1 border border-[var(--heading)] font-bold transition-colors"
                                                :class="proj.category === 'Website'
                                                    ? 'bg-blue-950/20 text-blue-400 border-blue-500/40'
                                                    : (proj.category === 'Unity' ? 'bg-purple-950/20 text-purple-400 border-purple-500/40' : 'bg-[var(--bg)] text-[var(--heading)]')">
                                                {{ proj.category }}
                                            </span>
                                        </td>

                                        <!-- Year -->
                                        <td
                                            class="py-6 px-6 font-mono text-xs text-[var(--heading)] tabular-nums whitespace-nowrap font-bold">
                                            {{ proj.year }}
                                        </td>

                                        <!-- Tags Pills -->
                                        <td class="py-6 px-6">
                                            <div class="flex flex-wrap gap-1.5 max-w-xs">
                                                <span v-for="tag in proj.tags" :key="tag"
                                                    class="font-mono text-[9px] tracking-wider uppercase px-2 py-0.5 border border-[var(--border-subtle)] text-[var(--muted)] font-semibold bg-[var(--bg)]">
                                                    {{ tag }}
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Action Buttons -->
                                        <td class="py-6 px-6 text-right whitespace-nowrap">
                                            <div class="inline-flex items-center gap-3">
                                                <button @click="triggerEdit(proj)"
                                                    class="font-sans text-[10px] tracking-[0.2em] uppercase px-4 py-2 border border-[var(--heading)] text-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] font-black transition-all cursor-pointer">
                                                    EDIT
                                                </button>
                                                <button @click="deleteProject(proj)"
                                                    class="font-sans text-[10px] tracking-[0.2em] uppercase px-4 py-2 border border-red-900/50 text-red-400 hover:bg-red-950/80 hover:border-red-500 font-bold transition-all cursor-pointer">
                                                    DELETE
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Classic Editorial Toast HUD -->
            <AdminToast ref="toastRef" />

            <!-- Classic Typographic SweetAlert Confirmation Modal -->
            <AdminConfirmModal ref="confirmRef" />

            <!-- Security Credentials Modal -->
            <AdminChangePinModal ref="changePinRef" @success="handlePinChanged" />
        </template>
    </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import AdminToast from '../components/AdminToast.vue';
import AdminConfirmModal from '../components/AdminConfirmModal.vue';
import AdminChangePinModal from '../components/AdminChangePinModal.vue';

const router = useRouter();

const isAuthenticated = ref(false);
const pinInput = ref('');
const showPin = ref(false);
const isVerifying = ref(false);
const authError = ref('');

watch(
    isAuthenticated,
    (authenticated) => {
        document.title = authenticated
            ? 'Admin Dashboard'
            : 'WARNING!!!';
    },
    { immediate: true }
);

const projects = ref([]);
const isLoading = ref(true);
const searchQuery = ref('');
const selectedCategory = ref('All');
const toastRef = ref(null);
const confirmRef = ref(null);
const changePinRef = ref(null);
const liveTime = ref('');
const selectedIds = ref([]);

const handlePinChanged = () => {
    toastRef.value?.show({
        title: 'SECURITY UPDATED',
        message: 'Admin security PIN has been re-hashed and stored in database.',
        type: 'success',
    });
};

let clockTimer = null;

const checkExistingAuth = () => {
    const token = sessionStorage.getItem('admin_token');
    if (token) {
        isAuthenticated.value = true;
        fetchProjects();
    }
};

const verifyPin = async () => {
    isVerifying.value = true;
    authError.value = '';

    try {
        const res = await fetch('/api/admin/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ pin: pinInput.value }),
        });

        const json = await res.json();

        if (res.ok && json.success) {
            sessionStorage.setItem('admin_token', json.token);
            isAuthenticated.value = true;
            pinInput.value = '';
            fetchProjects();
        } else {
            authError.value = json.message || 'Invalid PIN. Access denied.';
        }
    } catch (err) {
        authError.value = 'Failed to connect to authentication service.';
    } finally {
        isVerifying.value = false;
    }
};

const logout = () => {
    sessionStorage.removeItem('admin_token');
    isAuthenticated.value = false;
    pinInput.value = '';
    authError.value = '';
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

const fetchProjects = async () => {
    isLoading.value = true;
    selectedIds.value = [];
    try {
        const res = await fetch('/api/projects');
        const json = await res.json();
        if (json.success) {
            projects.value = json.data;
        }
    } catch (err) {
        console.error('Failed to load projects:', err);
    } finally {
        isLoading.value = false;
    }
};

const selectAll = computed({
    get() {
        return filteredProjects.value.length > 0 && selectedIds.value.length === filteredProjects.value.length;
    },
    set(value) {
        if (value) {
            selectedIds.value = filteredProjects.value.map(p => p.id);
        } else {
            selectedIds.value = [];
        }
    }
});

const deleteSelected = async () => {
    if (selectedIds.value.length === 0) return;
    const count = selectedIds.value.length;

    let confirmed = false;
    if (confirmRef.value) {
        confirmed = await confirmRef.value.ask({
            title: 'EXECUTE BATCH PURGE',
            message: `Are you sure you want to permanently delete ${count} selected project records and all associated visual media? This action cannot be reversed.`,
            confirmText: `YES, PURGE ${count} RECORDS`,
            cancelText: 'ABORT',
            type: 'danger',
            code: 'BATCH_PURGE_REQ',
            category: 'DATABASE // BATCH DELETION'
        });
    } else {
        confirmed = confirm(`Are you sure you want to delete ${count} selected projects?`);
    }

    if (!confirmed) return;

    isLoading.value = true;
    try {
        const res = await fetch('/api/projects/batch-delete', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ids: selectedIds.value }),
        });
        const json = await res.json();
        if (res.ok && json.success) {
            selectedIds.value = [];
            await fetchProjects();
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: 'BATCH PURGE EXECUTED',
                    message: `${count} projects permanently removed from database storage.`,
                    type: 'success',
                    code: '204_PURGED',
                    category: 'DATABASE // SYNC'
                });
            }
        } else {
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: 'BATCH PURGE REJECTED',
                    message: json.message || 'Server failed to process batch deletion.',
                    type: 'error',
                    code: 'ERR_500',
                    category: 'TRANSACTION // FAULT'
                });
            }
        }
    } catch (err) {
        if (toastRef.value) {
            toastRef.value.addToast({
                title: 'NETWORK EXCEPTION',
                message: 'An error occurred during communication with backend.',
                type: 'error',
                code: 'NET_FAIL',
                category: 'PROTOCOL // ERROR'
            });
        }
    } finally {
        isLoading.value = false;
    }
};

const websiteCount = computed(() =>
    projects.value.filter(p => p.category.toLowerCase() === 'website').length
);

const unityCount = computed(() =>
    projects.value.filter(p => p.category.toLowerCase() === 'unity').length
);

const categories = computed(() => {
    const set = new Set(projects.value.map(p => p.category));
    return ['All', ...Array.from(set)];
});

const filteredProjects = computed(() => {
    return projects.value.filter(proj => {
        const matchesCategory = selectedCategory.value === 'All' || proj.category === selectedCategory.value;
        const q = searchQuery.value.toLowerCase().trim();
        if (!q) return matchesCategory;

        const matchesTitle = proj.title.toLowerCase().includes(q);
        const matchesDesc = proj.desc.toLowerCase().includes(q);
        const matchesTag = Array.isArray(proj.tags) && proj.tags.some(t => t.toLowerCase().includes(q));

        return matchesCategory && (matchesTitle || matchesDesc || matchesTag);
    });
});

const openCreateModal = () => {
    router.push('/adminnopal/projects/create');
};

const triggerEdit = (proj) => {
    router.push(`/adminnopal/projects/${proj.id}/edit`);
};

const deleteProject = async (proj) => {
    let confirmed = false;
    if (confirmRef.value) {
        confirmed = await confirmRef.value.ask({
            title: 'PURGE PROJECT RECORD',
            message: `Are you sure you want to permanently delete "${proj.title}"? All case study data and stored media will be removed.`,
            confirmText: 'YES, PURGE RECORD',
            cancelText: 'ABORT',
            type: 'danger',
            code: 'RECORD_PURGE_REQ',
            category: 'DATABASE // RECORD PURGE'
        });
    } else {
        confirmed = confirm(`Are you sure you want to delete "${proj.title}"?`);
    }

    if (!confirmed) return;

    try {
        const res = await fetch(`/api/projects/${proj.id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
            },
        });
        const json = await res.json();
        if (res.ok && json.success) {
            await fetchProjects();
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: 'PROJECT RECORD PURGED',
                    message: `"${proj.title}" was successfully deleted from storage.`,
                    type: 'success',
                    code: '204_DELETED',
                    category: 'DATABASE // SYNC'
                });
            }
        } else {
            if (toastRef.value) {
                toastRef.value.addToast({
                    title: 'DELETION REJECTED',
                    message: json.message || 'Failed to delete project.',
                    type: 'error',
                    code: 'ERR_400',
                    category: 'TRANSACTION // FAULT'
                });
            }
        }
    } catch (err) {
        if (toastRef.value) {
            toastRef.value.addToast({
                title: 'NETWORK EXCEPTION',
                message: 'An error occurred during deletion.',
                type: 'error',
                code: 'NET_ERR',
                category: 'PROTOCOL // ERROR'
            });
        }
    }
};

onMounted(() => {
    checkExistingAuth();
    updateClock();
    clockTimer = setInterval(updateClock, 1000);
});

onBeforeUnmount(() => {
    if (clockTimer) clearInterval(clockTimer);
});
</script>

<style scoped>
@keyframes shake {

    0%,
    100% {
        transform: translateX(0);
    }

    20%,
    60% {
        transform: translateX(-6px);
    }

    40%,
    80% {
        transform: translateX(6px);
    }
}

.animate-shake {
    animation: shake 0.4s ease-in-out;
}
</style>
