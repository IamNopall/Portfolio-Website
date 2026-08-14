<template>
    <Teleport to="body">
        <Transition name="confirm-scale">
            <div
                v-if="isOpen"
                class="fixed inset-0 z-[150] flex items-center justify-center p-4 sm:p-6 bg-black/85 backdrop-blur-xl overflow-y-auto font-sans"
                @keydown.esc="handleCancel"
                @keydown.enter="handleConfirm"
                tabindex="-1"
                ref="modalContainerRef"
            >
                <!-- Modal Backdrop Click -->
                <div class="fixed inset-0" @click="handleCancel"></div>

                <div
                    class="relative w-full max-w-md bg-[#0d0d0d] border border-neutral-800 p-8 sm:p-10 shadow-[0_30px_100px_rgba(0,0,0,0.95)] my-auto overflow-hidden transition-all duration-300 z-10"
                    @click.stop
                >
                    <!-- Header Meta Stamp -->
                    <div class="flex items-center justify-between gap-2 pb-3 mb-6 border-b border-neutral-900 font-mono text-[8px] tracking-[0.22em] uppercase text-neutral-500">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-neutral-700"></span>
                            <span class="font-medium">
                                {{ category || 'SYSTEM // LOG' }}
                            </span>
                        </div>
                        <span class="font-bold tracking-widest text-[8px]">
                            {{ code || 'CONFIRM_REQ' }}
                        </span>
                    </div>

                    <!-- Typography Message -->
                    <div class="text-center py-2 space-y-2.5">
                        <!-- Refined Classic Headline -->
                        <h3 class="display-font text-2xl sm:text-3xl font-black uppercase tracking-tight text-white leading-none">
                            {{ title }}
                        </h3>

                        <!-- Editorial Explanation Subtext -->
                        <p class="font-sans text-xs sm:text-sm text-neutral-400 leading-relaxed max-w-sm mx-auto font-light">
                            {{ message }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 pt-6 mt-6 border-t border-neutral-900">
                        <button
                            type="button"
                            @click="handleCancel"
                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-5 py-2.5 border border-neutral-800 text-neutral-400 hover:text-white hover:border-neutral-600 transition-all font-bold cursor-pointer text-center order-2 sm:order-1"
                        >
                            {{ cancelText }}
                        </button>
                        <button
                            type="button"
                            @click="handleConfirm"
                            class="font-sans text-[10px] tracking-[0.18em] uppercase px-6 py-2.5 font-black text-black bg-white hover:bg-neutral-200 transition-all cursor-pointer text-center order-1 sm:order-2 active:scale-[0.98]"
                            :class="[
                                type === 'danger'
                                    ? 'hover:bg-red-500 hover:text-white'
                                    : 'hover:bg-neutral-200'
                            ]"
                        >
                            {{ confirmText }}
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { nextTick, ref } from 'vue';

const isOpen = ref(false);
const title = ref('CONFIRM PURGE PROTOCOL');
const message = ref('Are you sure you want to proceed with this operation?');
const confirmText = ref('EXECUTE PURGE');
const cancelText = ref('ABORT');
const type = ref('danger'); // 'danger' | 'warning' | 'info'
const code = ref('PURGE_REQ');
const category = ref('DATABASE // PURGE PROTOCOL');
const modalContainerRef = ref(null);

let resolvePromise = null;

const ask = (options = {}) => {
    title.value = options.title || 'CONFIRM ACTION';
    message.value = options.message || 'Are you sure you want to proceed?';
    confirmText.value = options.confirmText || 'CONFIRM';
    cancelText.value = options.cancelText || 'ABORT';
    type.value = options.type || 'danger';
    code.value = options.code || (type.value === 'danger' ? 'PURGE_REQ' : 'VERIFY_REQ');
    category.value = options.category || (type.value === 'danger' ? 'DATABASE // PURGE PROTOCOL' : 'SYSTEM // VERIFICATION');

    isOpen.value = true;
    nextTick(() => {
        if (modalContainerRef.value) {
            modalContainerRef.value.focus();
        }
    });

    return new Promise((resolve) => {
        resolvePromise = resolve;
    });
};

const handleConfirm = () => {
    isOpen.value = false;
    if (resolvePromise) {
        resolvePromise(true);
        resolvePromise = null;
    }
};

const handleCancel = () => {
    isOpen.value = false;
    if (resolvePromise) {
        resolvePromise(false);
        resolvePromise = null;
    }
};

defineExpose({
    ask,
    confirm: ask
});
</script>

<style scoped>
.confirm-scale-enter-active,
.confirm-scale-leave-active {
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}

.confirm-scale-enter-from,
.confirm-scale-leave-to {
    opacity: 0;
    transform: scale(0.92) translateY(10px);
}
</style>
