<template>
    <Teleport to="body">
        <div class="fixed top-5 right-5 z-[120] max-w-md w-[calc(100vw-2.5rem)] sm:w-96 pointer-events-none space-y-3 font-sans">
            <TransitionGroup name="toast-slide">
                <div
                    v-for="item in toasts"
                    :key="item.id"
                    class="pointer-events-auto relative border-2 p-4 sm:p-5 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.8)] backdrop-blur-xl overflow-hidden group transition-all duration-300"
                    :class="[
                        item.type === 'error'
                            ? 'bg-[#150406]/95 border-red-500/80 text-red-100 shadow-red-950/40'
                            : item.type === 'warning'
                            ? 'bg-[#170e03]/95 border-amber-500/80 text-amber-100 shadow-amber-950/40'
                            : item.type === 'info'
                            ? 'bg-[#040e1a]/95 border-blue-500/80 text-blue-100 shadow-blue-950/40'
                            : 'bg-[#04140b]/95 border-emerald-500/80 text-emerald-100 shadow-emerald-950/40'
                    ]"
                >
                    <!-- Corner Crosshair / Architectural Brackets -->
                    <span class="absolute top-1 left-1.5 font-mono text-[9px] opacity-40 select-none">+</span>
                    <span class="absolute top-1 right-1.5 font-mono text-[9px] opacity-40 select-none">+</span>
                    <span class="absolute bottom-1 left-1.5 font-mono text-[9px] opacity-40 select-none">+</span>
                    <span class="absolute bottom-1 right-1.5 font-mono text-[9px] opacity-40 select-none">+</span>

                    <!-- Top Bar Meta / Code -->
                    <div class="flex items-center justify-between gap-3 mb-2 pb-2 border-b border-white/10 font-mono text-[8px] sm:text-[9px] tracking-[0.25em] uppercase">
                        <div class="flex items-center gap-2">
                            <span
                                class="w-2 h-2 rounded-full inline-block animate-ping"
                                :class="[
                                    item.type === 'error' ? 'bg-red-400' :
                                    item.type === 'warning' ? 'bg-amber-400' :
                                    item.type === 'info' ? 'bg-blue-400' : 'bg-emerald-400'
                                ]"
                            ></span>
                            <span class="font-bold tracking-[0.2em]">
                                {{ item.category || 'SYSTEM // LOG' }}
                            </span>
                        </div>
                        <span
                            class="px-1.5 py-0.5 border font-semibold tracking-widest text-[8px]"
                            :class="[
                                item.type === 'error' ? 'border-red-500/50 bg-red-950/60 text-red-300' :
                                item.type === 'warning' ? 'border-amber-500/50 bg-amber-950/60 text-amber-300' :
                                item.type === 'info' ? 'border-blue-500/50 bg-blue-950/60 text-blue-300' : 'border-emerald-500/50 bg-emerald-950/60 text-emerald-300'
                            ]"
                        >
                            {{ item.code || (item.type === 'error' ? 'ERR_500' : '200_OK') }}
                        </span>
                    </div>

                    <!-- Title & Message -->
                    <div class="pr-6">
                        <h4 class="display-font text-lg sm:text-xl font-black uppercase tracking-tight text-white leading-tight mb-1">
                            {{ item.title }}
                        </h4>
                        <p class="font-sans text-xs sm:text-sm text-white/80 leading-relaxed font-light">
                            {{ item.message }}
                        </p>
                    </div>

                    <!-- Close Button -->
                    <button
                        @click="removeToast(item.id)"
                        class="absolute top-3 right-3 text-white/50 hover:text-white transition-colors cursor-pointer p-1 font-mono text-xs"
                        title="Dismiss"
                    >
                        ✕
                    </button>

                    <!-- Auto-dismiss Progress Bar -->
                    <div
                        v-if="item.duration > 0"
                        class="absolute bottom-0 left-0 h-0.5 transition-all linear"
                        :class="[
                            item.type === 'error' ? 'bg-red-400' :
                            item.type === 'warning' ? 'bg-amber-400' :
                            item.type === 'info' ? 'bg-blue-400' : 'bg-emerald-400'
                        ]"
                        :style="{
                            width: '100%',
                            animation: `toast-progress ${item.duration}ms linear forwards`
                        }"
                    ></div>
                </div>
            </TransitionGroup>
        </div>
    </Teleport>
</template>

<script setup>
import { ref } from 'vue';

const toasts = ref([]);
let toastCounter = 0;

const addToast = ({
    title,
    message,
    type = 'success',
    code = '',
    category = '',
    duration = 4500
}) => {
    const id = ++toastCounter;
    const defaultCode = type === 'error' ? 'ERR_400' : (type === 'warning' ? 'WARN_300' : '200_OK');
    const defaultCategory = type === 'error' ? 'SECURITY // FAULT' : (type === 'warning' ? 'STAGING // NOTICE' : 'PROTOCOL // CONFIRMED');

    toasts.value.push({
        id,
        title,
        message,
        type,
        code: code || defaultCode,
        category: category || defaultCategory,
        duration
    });

    if (duration > 0) {
        setTimeout(() => {
            removeToast(id);
        }, duration);
    }
};

const removeToast = (id) => {
    const idx = toasts.value.findIndex(t => t.id === id);
    if (idx !== -1) {
        toasts.value.splice(idx, 1);
    }
};

defineExpose({
    addToast,
    removeToast
});
</script>

<style scoped>
.toast-slide-enter-active {
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}
.toast-slide-leave-active {
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
.toast-slide-enter-from {
    opacity: 0;
    transform: translateX(40px) scale(0.95);
}
.toast-slide-leave-to {
    opacity: 0;
    transform: translateX(30px) scale(0.95);
}

@keyframes toast-progress {
    from {
        width: 100%;
    }
    to {
        width: 0%;
    }
}
</style>
