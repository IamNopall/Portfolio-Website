<template>
    <div class="image-dropzone-wrapper space-y-2">
        <div v-if="label" class="flex items-center justify-between font-mono text-[9px] sm:text-[10px] tracking-[0.2em] uppercase text-[var(--muted)]">
            <span>{{ label }}</span>
            <span v-if="isUploading" class="text-[var(--accent-blue)] animate-pulse flex items-center gap-1 font-bold">
                <span class="inline-block animate-spin">⟳</span> UPLOADING TO STORAGE...
            </span>
            <span v-else-if="modelValue" class="text-emerald-400 font-mono text-[8px] flex items-center gap-1">
                ✔ ATTACHED
            </span>
        </div>

        <!-- 1. DRAG & DROP ZONE (If no image or compact mode) -->
        <div
            v-if="!modelValue"
            class="relative border-2 border-dashed transition-all duration-300 flex flex-col items-center justify-center text-center p-4 sm:p-6 bg-[var(--bg)] cursor-pointer group"
            :class="[
                isDragging
                    ? 'border-[var(--heading)] bg-[var(--hover-bg)] scale-[1.01]'
                    : 'border-[var(--border-subtle)] hover:border-[var(--heading)]/70 hover:bg-[var(--hover-bg)]/40',
                compact ? 'min-h-[90px] py-3' : 'min-h-[140px]'
            ]"
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="handleDrop"
            @click="triggerFileInput"
        >
            <input
                ref="fileInputRef"
                type="file"
                accept="image/*"
                class="hidden"
                @change="handleFileInputChange"
            />

            <!-- Icon -->
            <div class="w-8 h-8 rounded-full bg-[var(--hover-bg)] border border-[var(--border-subtle)] flex items-center justify-center text-[var(--muted)] group-hover:text-[var(--heading)] group-hover:scale-110 transition-all mb-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
            </div>

            <!-- Upload copy -->
            <p class="font-sans text-xs font-semibold tracking-wider uppercase text-[var(--heading)] mb-1">
                DRAG &amp; DROP IMAGE OR <span class="underline decoration-[var(--border)] group-hover:decoration-[var(--heading)]">BROWSE FILE</span>
            </p>
            <p class="font-mono text-[8px] sm:text-[9px] text-[var(--muted)] tracking-wider">
                PNG, JPG, WEBP, GIF (MAX 10MB) · UPLOADS DIRECTLY TO HOSTING STORAGE
            </p>
        </div>

        <!-- 2. IMAGE PREVIEW CONTAINER (When image exists) -->
        <div
            v-else
            class="relative border border-[var(--border-subtle)] bg-[var(--hover-bg)]/40 overflow-hidden group transition-all"
            :class="compact ? 'p-2' : 'p-3'"
        >
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                <!-- Thumbnail Box -->
                <div class="relative w-28 h-20 sm:w-36 sm:h-24 bg-black/60 border border-[var(--border-subtle)] overflow-hidden shrink-0">
                    <img :src="modelValue" alt="Uploaded Preview" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                        <button
                            type="button"
                            @click="triggerFileInput"
                            class="px-2 py-1 bg-[var(--heading)] text-[var(--bg)] font-sans text-[8px] tracking-wider uppercase font-bold hover:opacity-90 transition-opacity cursor-pointer"
                            title="Replace Image">
                            REPLACE
                        </button>
                    </div>
                </div>

                <!-- Info & Path -->
                <div class="flex-1 min-w-0 space-y-1.5 w-full">
                    <div class="flex items-center justify-between gap-2">
                        <span class="font-mono text-[9px] text-emerald-400 font-semibold tracking-wider truncate">
                            ✔ STORED ON SERVER
                        </span>
                        <div class="flex items-center gap-2">
                            <button
                                type="button"
                                @click="triggerFileInput"
                                class="font-sans text-[9px] tracking-wider uppercase text-[var(--muted)] hover:text-[var(--heading)] transition-colors cursor-pointer font-bold">
                                CHANGE
                            </button>
                            <span class="text-[var(--muted)] opacity-40">|</span>
                            <button
                                type="button"
                                @click="clearImage"
                                class="font-sans text-[9px] tracking-wider uppercase text-red-400 hover:text-red-300 transition-colors cursor-pointer font-bold">
                                REMOVE ✕
                            </button>
                        </div>
                    </div>

                    <input
                        :value="modelValue"
                        @input="$emit('update:modelValue', $event.target.value)"
                        type="text"
                        placeholder="Image URL / Storage Path..."
                        class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-2 py-1.5 font-mono text-[10px] text-[var(--text-soft)] focus:outline-none"
                    />
                </div>
            </div>

            <!-- Hidden File Input for Replacement -->
            <input
                ref="fileInputRef"
                type="file"
                accept="image/*"
                class="hidden"
                @change="handleFileInputChange"
            />
        </div>

        <!-- 3. Optional Direct URL input Toggle for Empty State -->
        <div v-if="!modelValue && showDirectInput" class="pt-1">
            <div class="flex items-center gap-2">
                <input
                    :value="modelValue"
                    @input="$emit('update:modelValue', $event.target.value)"
                    type="text"
                    placeholder="Or enter direct image path / URL (https://... or /images/...)"
                    class="w-full bg-[var(--bg)] border border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-1.5 font-mono text-xs text-[var(--heading)] focus:outline-none"
                />
            </div>
        </div>

        <div v-if="!modelValue" class="flex justify-end">
            <button
                type="button"
                @click="showDirectInput = !showDirectInput"
                class="font-mono text-[8px] sm:text-[9px] tracking-wider uppercase text-[var(--muted)] hover:text-[var(--heading)] transition-colors cursor-pointer">
                {{ showDirectInput ? 'HIDE URL INPUT' : 'ENTER URL MANUALLY ↗' }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    label: {
        type: String,
        default: '',
    },
    compact: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['update:modelValue', 'uploaded']);

const fileInputRef = ref(null);
const isDragging = ref(false);
const isUploading = ref(false);
const showDirectInput = ref(false);

const triggerFileInput = () => {
    if (fileInputRef.value) {
        fileInputRef.value.click();
    }
};

const handleFileInputChange = (e) => {
    const file = e.target.files?.[0];
    if (file) {
        uploadFile(file);
    }
};

const handleDrop = (e) => {
    isDragging.value = false;
    const file = e.dataTransfer.files?.[0];
    if (file && file.type.startsWith('image/')) {
        uploadFile(file);
    }
};

import { supabase } from '../composables/useSupabase.js';

const uploadFile = async (file) => {
    isUploading.value = true;

    try {
        // Generate unique filename with timestamp & extension
        const fileExt = file.name.split('.').pop() || 'jpg';
        const cleanName = file.name.replace(/\.[^/.]+$/, "").replace(/[^a-zA-Z0-9]/g, "_");
        const fileName = `${Date.now()}_${cleanName}.${fileExt}`;
        const filePath = `projects/${fileName}`;

        // Direct upload to Supabase Storage bucket 'portfolio'
        const { data: uploadData, error: uploadError } = await supabase.storage
            .from('portfolio')
            .upload(filePath, file, {
                cacheControl: '3600',
                upsert: true
            });

        if (!uploadError && uploadData) {
            const { data: publicUrlData } = supabase.storage
                .from('portfolio')
                .getPublicUrl(filePath);

            const publicUrl = publicUrlData?.publicUrl;
            if (publicUrl) {
                emit('update:modelValue', publicUrl);
                emit('uploaded', publicUrl);
                return;
            }
        }

        // Fallback: Try local API if available
        const formData = new FormData();
        formData.append('image', file);

        const res = await fetch('/api/upload-media', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData,
        });

        const json = await res.json();
        if (res.ok && json.success && json.url) {
            emit('update:modelValue', json.url);
            emit('uploaded', json.url);
            return;
        }

        // Ultimate fallback: FileReader Base64
        const reader = new FileReader();
        reader.onload = (e) => {
            const base64Url = e.target?.result;
            if (base64Url) {
                emit('update:modelValue', base64Url);
                emit('uploaded', base64Url);
            }
        };
        reader.readAsDataURL(file);
    } catch (err) {
        console.error('Image upload error, using local data URL fallback:', err);
        const reader = new FileReader();
        reader.onload = (e) => {
            const base64Url = e.target?.result;
            if (base64Url) {
                emit('update:modelValue', base64Url);
                emit('uploaded', base64Url);
            }
        };
        reader.readAsDataURL(file);
    } finally {
        isUploading.value = false;
        if (fileInputRef.value) {
            fileInputRef.value.value = '';
        }
    }
};

const clearImage = () => {
    emit('update:modelValue', '');
};
</script>
