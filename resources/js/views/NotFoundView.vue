<template>
    <div class="min-h-[100dvh] bg-[var(--bg)] text-[var(--text)] flex flex-col justify-between p-8 sm:p-16 relative overflow-hidden select-none font-sans">
        
        <!-- Minimal Header -->
        <header class="relative z-10 flex justify-between items-baseline">
            <router-link to="/" class="display-font text-xl font-black tracking-tight text-[var(--heading)] hover:opacity-70 transition-opacity">
                NAUFAL TSAQIF
            </router-link>
            <span class="text-[10px] tracking-[0.2em] text-[var(--muted)] uppercase">INDEX / 404</span>
        </header>

        <!-- Main Content (Typographic & Spacious) -->
        <main class="relative z-10 my-auto py-12 max-w-xl">
            <!-- Elegant Numeral Watermark -->
            <h1 class="display-font text-[18vw] sm:text-[12vw] font-black uppercase tracking-tighter text-[var(--heading)] leading-none mb-6">
                404
            </h1>
            
            <h2 class="font-sans text-sm sm:text-base tracking-[0.15em] uppercase text-[var(--heading)] font-semibold mb-4">
                HALAMAN TIDAK DITEMUKAN.
            </h2>
            
            <p class="font-sans text-xs sm:text-sm text-[var(--muted)] leading-relaxed mb-8 font-light max-w-[45ch]">
                Katalog kami tidak memiliki arsip halaman yang Anda cari. Halaman ini mungkin telah dipindahkan, dihapus, atau tautan yang Anda masukkan salah.
            </p>
            
            <div class="flex items-center gap-6 text-[10px] tracking-[0.2em] uppercase font-semibold">
                <router-link to="/" class="text-[var(--heading)] border-b border-[var(--heading)] pb-0.5 hover:opacity-70 transition-opacity">
                    BERANDA
                </router-link>
                <span class="opacity-30">/</span>
                <a href="mailto:naufaltsq333@gmail.com" class="text-[var(--muted)] hover:text-[var(--heading)] transition-colors">
                    KONTAK
                </a>
            </div>
        </main>

        <!-- Simple Footer -->
        <footer class="relative z-10 flex justify-between items-end text-[9px] tracking-[0.18em] text-[var(--muted)] uppercase font-light">
            <span>© {{ new Date().getFullYear() }}</span>
            <span>PORTFOLIO ARCHIVE</span>
        </footer>
    </div>
</template>

<script setup>
// Pure presentation, no logic needed
</script>

<style scoped>
.min-h-\[100dvh\] {
    min-height: 100dvh;
}
</style>
