<template>
    <Teleport to="body">
        <Transition name="pin-modal-scale">
            <div
                v-if="isOpen"
                class="fixed inset-0 z-[150] flex items-center justify-center p-4 sm:p-6 bg-black/85 backdrop-blur-xl overflow-y-auto font-sans"
                @keydown.esc="handleClose"
                tabindex="-1"
                ref="modalContainerRef"
            >
                <!-- Modal Backdrop -->
                <div class="fixed inset-0" @click="handleClose"></div>

                <div
                    class="relative w-full max-w-md bg-[var(--bg)] border border-[var(--border-subtle)] p-6 sm:p-10 shadow-[0_30px_100px_rgba(0,0,0,0.95)] my-auto overflow-hidden transition-all duration-300 z-10 select-none"
                    @click.stop
                >
                    <!-- Header Stamp -->
                    <div class="flex items-center justify-between gap-2 pb-3 mb-6 border-b border-[var(--border-subtle)] font-mono text-[8px] sm:text-[9px] tracking-[0.22em] uppercase text-[var(--muted)]">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            <span class="font-medium text-[var(--text-soft)]">
                                SECURITY // CREDENTIALS
                            </span>
                        </div>
                        <span class="font-bold tracking-widest">
                            HASH_BCRYPT_R12
                        </span>
                    </div>

                    <!-- Typography Title -->
                    <div class="mb-6 space-y-1.5">
                        <span class="font-mono text-[9px] tracking-[0.25em] text-[var(--muted)] uppercase block">
                            KEY ROTATION PROTOCOL
                        </span>
                        <h3 class="display-font text-2xl sm:text-3xl font-black uppercase tracking-tight text-[var(--heading)] leading-none">
                            UPDATE SECURITY PIN
                        </h3>
                    </div>

                    <!-- Alert message -->
                    <div v-if="errorMessage" class="mb-5 p-3 border-l-2 border-red-500 bg-red-500/10 text-red-300 font-mono text-xs flex items-center justify-between gap-2">
                        <span class="truncate">{{ errorMessage }}</span>
                        <button type="button" @click="errorMessage = ''" class="text-red-400 font-bold hover:text-white uppercase text-[9px]">[CLOSE]</button>
                    </div>

                    <div v-if="successMessage" class="mb-5 p-3 border-l-2 border-emerald-500 bg-emerald-500/10 text-emerald-300 font-mono text-xs flex items-center justify-between gap-2">
                        <span class="truncate">{{ successMessage }}</span>
                    </div>

                    <!-- Change PIN Form -->
                    <form @submit.prevent="handleSubmit" class="space-y-5">
                        <div class="space-y-1.5">
                            <label class="block font-mono text-[8px] sm:text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                CURRENT SECURITY PIN
                            </label>
                            <input
                                v-model="currentPin"
                                type="password"
                                required
                                placeholder="••••••••"
                                class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-base tracking-[0.3em] text-[var(--heading)] focus:outline-none transition-colors"
                            />
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-mono text-[8px] sm:text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                NEW SECURITY PIN (MIN 4 CHARS)
                            </label>
                            <input
                                v-model="newPin"
                                type="password"
                                required
                                minlength="4"
                                placeholder="••••••••"
                                class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-base tracking-[0.3em] text-[var(--heading)] focus:outline-none transition-colors"
                            />
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-mono text-[8px] sm:text-[9px] tracking-[0.2em] text-[var(--muted)] uppercase">
                                CONFIRM NEW PIN
                            </label>
                            <input
                                v-model="confirmNewPin"
                                type="password"
                                required
                                minlength="4"
                                placeholder="••••••••"
                                class="w-full bg-[var(--hover-bg)]/40 border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 font-mono text-base tracking-[0.3em] text-[var(--heading)] focus:outline-none transition-colors"
                            />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-[var(--border-subtle)]">
                            <button
                                type="button"
                                @click="handleClose"
                                class="font-sans text-[10px] tracking-[0.18em] uppercase px-4 py-2.5 text-[var(--muted)] hover:text-[var(--heading)] transition-colors font-bold cursor-pointer"
                            >
                                CANCEL
                            </button>
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="font-sans text-[10px] tracking-[0.2em] uppercase px-5 py-2.5 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-all cursor-pointer disabled:opacity-50 active:scale-[0.98]"
                            >
                                {{ isSubmitting ? 'ENCRYPTING...' : 'SAVE NEW PIN' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { nextTick, ref } from 'vue';

const emit = defineEmits(['success']);

const isOpen = ref(false);
const currentPin = ref('');
const newPin = ref('');
const confirmNewPin = ref('');
const isSubmitting = ref(false);
const errorMessage = ref('');
const successMessage = ref('');
const modalContainerRef = ref(null);

const open = () => {
    currentPin.value = '';
    newPin.value = '';
    confirmNewPin.value = '';
    errorMessage.value = '';
    successMessage.value = '';
    isOpen.value = true;
    nextTick(() => {
        if (modalContainerRef.value) {
            modalContainerRef.value.focus();
        }
    });
};

const handleClose = () => {
    if (isSubmitting.value) return;
    isOpen.value = false;
};

import { supabase } from '../composables/useSupabase.js';

const handleSubmit = async () => {
    errorMessage.value = '';
    successMessage.value = '';

    if (newPin.value !== confirmNewPin.value) {
        errorMessage.value = 'New PIN and confirmation do not match.';
        return;
    }

    if (newPin.value.length < 4) {
        errorMessage.value = 'New PIN must be at least 4 digits/characters.';
        return;
    }

    isSubmitting.value = true;

    try {
        // Try Supabase directly
        const { error } = await supabase
            .from('admin_access')
            .upsert({
                key: 'admin_pin',
                pin_hash: newPin.value,
                updated_at: new Date().toISOString()
            }, { onConflict: 'key' });

        if (!error) {
            successMessage.value = 'PIN successfully updated in Supabase cloud.';
            emit('success');
            setTimeout(() => {
                isOpen.value = false;
            }, 1200);
            return;
        }

        // Fallback to local API
        const res = await fetch('/api/admin/change-pin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                current_pin: currentPin.value,
                new_pin: newPin.value,
            }),
        });

        const json = await res.json();

        if (res.ok && json.success) {
            successMessage.value = 'PIN successfully updated in database.';
            emit('success');
            setTimeout(() => {
                isOpen.value = false;
            }, 1200);
        } else {
            errorMessage.value = json.message || 'Failed to update PIN.';
        }
    } catch (err) {
        errorMessage.value = 'Connection error. Please try again.';
    } finally {
        isSubmitting.value = false;
    }
};

defineExpose({
    open,
});
</script>

<style scoped>
.pin-modal-scale-enter-active,
.pin-modal-scale-leave-active {
    transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}

.pin-modal-scale-enter-from,
.pin-modal-scale-leave-to {
    opacity: 0;
    transform: scale(0.96);
}
</style>
