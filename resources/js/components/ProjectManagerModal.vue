<template>
    <Teleport to="body">
        <Transition name="modal-fade">
            <div v-if="isOpen"
                class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 md:p-10 bg-black/85 backdrop-blur-xl overflow-y-auto">
                <div class="relative w-full max-w-4xl bg-[var(--bg)] text-[var(--text)] border-2 border-[var(--heading)] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.8)] my-auto overflow-hidden transition-all duration-300"
                    @click.stop>

                    <!-- Top Bar Solid Accent -->
                    <div class="h-1.5 w-full bg-[var(--heading)]"></div>

                    <!-- Header -->
                    <div class="flex items-center justify-between px-4 sm:px-10 py-4 sm:py-6 border-b-2 border-[var(--heading)] bg-[var(--hover-bg)] gap-3">
                        <div>
                            <span class="font-mono text-[8px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.3em] text-[var(--muted)] uppercase block mb-0.5 sm:mb-1">
                                CONSOLE FORM // {{ editingId ? 'UPDATE WORK ENTRY' : 'CREATE WORK ENTRY' }}
                            </span>
                            <h2 class="display-font text-xl sm:text-4xl font-black uppercase tracking-tight text-[var(--heading)] leading-none">
                                {{ currentView === 'list' ? 'PROJECT INDEX' : (editingId ? 'EDIT KARYA' : 'ADD NEW KARYA') }}
                            </h2>
                        </div>
                        <button @click="closeModal"
                            class="p-1.5 sm:p-2 text-[var(--muted)] hover:text-[var(--heading)] transition-colors focus:outline-none cursor-pointer font-mono text-xs sm:text-sm border border-[var(--border-subtle)] px-2.5 sm:px-3 shrink-0"
                            title="Close Modal">
                            ✕ <span class="hidden sm:inline">CLOSE</span>
                        </button>
                    </div>

                    <!-- Body Content -->
                    <div class="p-4 sm:p-10 max-h-[78vh] overflow-y-auto">
                        <!-- Alert Banner -->
                        <div v-if="alertMessage"
                            class="mb-6 sm:mb-8 p-3 sm:p-4 text-[10px] sm:text-xs font-mono tracking-wider uppercase border-l-4 flex items-center justify-between transition-all"
                            :class="alertType === 'error' ? 'bg-red-950/40 border-l-red-500 border border-red-800/40 text-red-300' : 'bg-emerald-950/40 border-l-emerald-500 border border-emerald-800/40 text-emerald-300'">
                            <div class="flex items-center gap-2 sm:gap-3 font-semibold">
                                <span>{{ alertType === 'error' ? '✖' : '✔' }}</span>
                                <span>{{ alertMessage }}</span>
                            </div>
                            <button @click="alertMessage = ''" class="ml-2 opacity-70 hover:opacity-100 font-bold">&times;</button>
                        </div>

                        <!-- LIST VIEW -->
                        <div v-if="currentView === 'list'">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 sm:mb-8 pb-4 border-b border-[var(--border-subtle)]">
                                <span class="font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase font-semibold">
                                    TOTAL INDEXED: {{ projectsList.length }} KARYA
                                </span>
                                <button @click="openCreateForm"
                                    class="font-sans text-xs tracking-[0.18em] sm:tracking-[0.22em] uppercase px-5 py-2.5 sm:px-6 sm:py-3 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-opacity cursor-pointer w-full sm:w-auto">
                                    + ADD NEW WORK
                                </button>
                            </div>

                            <div v-if="isLoading" class="py-12 sm:py-16 text-center font-mono text-[10px] sm:text-xs uppercase tracking-[0.2em] text-[var(--muted)]">
                                FETCHING PROJECT INDEX...
                            </div>

                            <div v-else-if="projectsList.length === 0" class="py-12 sm:py-16 text-center font-mono text-[10px] sm:text-xs uppercase tracking-[0.2em] text-[var(--muted)]">
                                NO WORKS INDEXED YET. CLICK "+ ADD NEW WORK" TO CREATE ONE.
                            </div>

                            <div v-else class="divide-y divide-[var(--border-subtle)] border-2 border-[var(--border-subtle)]">
                                <div v-for="proj in projectsList" :key="proj.id"
                                    class="py-4 sm:py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4 group hover:bg-[var(--hover-bg)] px-3 sm:px-4 transition-colors">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 sm:gap-3 mb-1">
                                            <h3 class="display-font text-lg sm:text-xl font-bold text-[var(--heading)] truncate">
                                                {{ proj.title }}
                                            </h3>
                                            <span class="font-mono text-[8px] sm:text-[9px] tracking-wider uppercase px-2 py-0.5 border border-[var(--heading)] font-semibold text-[var(--heading)] shrink-0">
                                                {{ proj.category }}
                                            </span>
                                            <span class="font-mono text-[8px] sm:text-[9px] tracking-wider text-[var(--muted)] shrink-0">
                                                {{ proj.year }}
                                            </span>
                                        </div>
                                        <p class="font-sans text-xs text-[var(--muted)] line-clamp-1 max-w-xl">
                                            {{ proj.desc }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-2 sm:gap-3 shrink-0 self-end sm:self-auto pt-1 sm:pt-0">
                                        <button @click="openEditForm(proj)"
                                            class="font-sans text-[9px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.2em] uppercase px-3.5 py-1.5 sm:px-4 sm:py-2 border border-[var(--heading)] hover:bg-[var(--heading)] hover:text-[var(--bg)] text-[var(--heading)] font-bold transition-all cursor-pointer">
                                            EDIT
                                        </button>
                                        <button @click="confirmDelete(proj)"
                                            class="font-sans text-[9px] sm:text-[10px] tracking-[0.18em] sm:tracking-[0.2em] uppercase px-3.5 py-1.5 sm:px-4 sm:py-2 border border-red-900/50 text-red-400 hover:bg-red-950/80 transition-all cursor-pointer font-bold">
                                            DELETE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FORM VIEW (CREATE / EDIT) -->
                        <div v-else-if="currentView === 'form'">
                            <form @submit.prevent="saveProject" class="space-y-6 sm:space-y-8">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                                    <!-- Title -->
                                    <div class="sm:col-span-2">
                                        <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase mb-1.5 sm:mb-2">
                                            WORK TITLE *
                                        </label>
                                        <input v-model="form.title" type="text" required placeholder="e.g. Nopal.Dev Portfolio"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 sm:px-4 sm:py-3 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-medium uppercase tracking-wider" />
                                    </div>

                                    <!-- Year -->
                                    <div>
                                        <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase mb-1.5 sm:mb-2">
                                            RELEASE YEAR *
                                        </label>
                                        <input v-model="form.year" type="text" required placeholder="2026"
                                            class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 sm:px-4 sm:py-3 font-mono text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors font-bold" />
                                    </div>
                                </div>

                                <!-- Category Selection -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase mb-1.5 sm:mb-2">
                                        CATEGORY *
                                    </label>
                                    <div class="flex flex-wrap gap-2 sm:gap-2.5 mb-2.5 sm:mb-3">
                                        <button type="button" v-for="cat in presetCategories" :key="cat"
                                            @click="form.category = cat"
                                            class="font-mono text-[9px] sm:text-[10px] tracking-[0.15em] sm:tracking-[0.2em] uppercase px-3 py-1.5 sm:px-4 sm:py-2 border transition-all cursor-pointer font-bold"
                                            :class="form.category === cat ? 'bg-[var(--heading)] text-[var(--bg)] border-[var(--heading)]' : 'border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)]'">
                                            {{ cat }}
                                        </button>
                                    </div>
                                    <input v-model="form.category" type="text" required placeholder="Custom category..."
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 sm:px-4 sm:py-2.5 font-sans text-xs text-[var(--heading)] focus:outline-none transition-colors uppercase tracking-wider font-semibold" />
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase mb-1.5 sm:mb-2">
                                        EDITORIAL DESCRIPTION SUMMARY *
                                    </label>
                                    <textarea v-model="form.desc" required rows="3" placeholder="Brief concise explanation of the project features & interactive mechanics..."
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 sm:px-4 sm:py-3 font-sans text-xs sm:text-sm text-[var(--heading)] focus:outline-none transition-colors leading-relaxed"></textarea>
                                </div>

                                <!-- Tags / Technologies -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase mb-1.5 sm:mb-2">
                                        STACK &amp; TECHNOLOGIES (COMMA SEPARATED)
                                    </label>
                                    <input v-model="tagsInput" type="text" placeholder="Vue.js, Laravel, Tailwind, Unity 3D"
                                        class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2.5 sm:px-4 sm:py-3 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors font-semibold uppercase tracking-wider" />

                                    <!-- Tags Preview -->
                                    <div v-if="parsedTags.length > 0" class="flex flex-wrap gap-1.5 sm:gap-2 mt-3 sm:mt-4">
                                        <span v-for="tag in parsedTags" :key="tag"
                                            class="font-mono text-[8px] sm:text-[9px] tracking-wider uppercase px-2 py-0.5 sm:px-2.5 sm:py-1 border border-blue-500/40 text-blue-400 bg-blue-950/30 font-bold">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Image Upload & Preview -->
                                <div>
                                    <label class="block font-mono text-[9px] sm:text-[10px] tracking-[0.2em] sm:tracking-[0.25em] text-[var(--muted)] uppercase mb-1.5 sm:mb-2">
                                        WORK IMAGE / THUMBNAIL (UPLOAD FILE OR DIRECT URL)
                                    </label>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4 items-start">
                                        <div class="space-y-3">
                                            <!-- File input -->
                                            <div class="flex items-center gap-3">
                                                <label class="cursor-pointer font-sans text-xs tracking-[0.15em] uppercase px-4 py-2.5 bg-[var(--heading)] text-[var(--bg)] font-bold hover:opacity-90 transition-opacity shrink-0">
                                                    CHOOSE FILE
                                                    <input type="file" accept="image/*" class="hidden" @change="handleImageFileChange" />
                                                </label>
                                                <span class="font-mono text-[10px] text-[var(--muted)] truncate">
                                                    {{ selectedImageFile ? selectedImageFile.name : (form.image ? 'CURRENT IMAGE ATTACHED' : 'NO FILE CHOSEN') }}
                                                </span>
                                            </div>

                                            <!-- Or direct URL -->
                                            <input v-model="form.image" type="text" placeholder="Or enter direct image URL (https://...)"
                                                @input="handleImageUrlInput"
                                                class="w-full bg-[var(--bg)] border-2 border-[var(--border-subtle)] focus:border-[var(--heading)] px-3 py-2 font-mono text-xs text-[var(--heading)] focus:outline-none transition-colors" />
                                        </div>

                                        <!-- Image Preview Plate -->
                                        <div v-if="imagePreview || form.image" class="relative w-28 h-20 sm:w-32 sm:h-24 bg-[var(--hover-bg)] border border-[var(--border-subtle)] flex items-center justify-center overflow-hidden shrink-0">
                                            <img :src="imagePreview || form.image" alt="Preview" class="w-full h-full object-cover" />
                                            <button type="button" @click="removeImage"
                                                class="absolute top-1 right-1 bg-black/80 text-white text-[9px] font-mono px-1.5 py-0.5 hover:bg-red-600 transition-colors"
                                                title="Remove Image">
                                                ✕
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row justify-end items-stretch sm:items-center gap-3 sm:gap-4 pt-6 sm:pt-8 border-t-2 border-[var(--border-subtle)]">
                                    <button type="button" @click="currentView = 'list'"
                                        class="font-sans text-xs tracking-[0.18em] sm:tracking-[0.2em] uppercase px-5 py-2.5 sm:px-6 sm:py-3 border-2 border-[var(--border-subtle)] text-[var(--muted)] hover:text-[var(--heading)] hover:border-[var(--heading)] transition-colors font-bold cursor-pointer text-center">
                                        BACK TO INDEX
                                    </button>
                                    <button type="submit" :disabled="isSaving"
                                        class="font-sans text-xs tracking-[0.2em] sm:tracking-[0.25em] uppercase px-6 py-3 sm:px-8 sm:py-3.5 bg-[var(--heading)] text-[var(--bg)] font-black hover:opacity-90 transition-opacity disabled:opacity-50 cursor-pointer shadow-xl text-center">
                                        {{ isSaving ? 'SAVING...' : (editingId ? 'UPDATE WORK' : 'SAVE WORK') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close', 'updated']);

const currentView = ref('list'); // 'list' | 'form'
const projectsList = ref([]);
const isLoading = ref(false);
const isSaving = ref(false);
const editingId = ref(null);
const alertMessage = ref('');
const alertType = ref('success');

const presetCategories = ['Website', 'Unity', 'Mobile', 'Design'];

const form = ref({
    title: '',
    category: 'Website',
    year: new Date().getFullYear().toString(),
    desc: '',
    image: '',
});
const selectedImageFile = ref(null);
const imagePreview = ref('');
const removeImageFlag = ref(false);
const tagsInput = ref('');

const parsedTags = computed(() => {
    return tagsInput.value
        .split(',')
        .map(t => t.trim())
        .filter(t => t.length > 0);
});

const handleImageFileChange = (e) => {
    const file = e.target.files?.[0];
    if (file) {
        selectedImageFile.value = file;
        removeImageFlag.value = false;
        const reader = new FileReader();
        reader.onload = (event) => {
            imagePreview.value = event.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const handleImageUrlInput = () => {
    if (form.value.image) {
        selectedImageFile.value = null;
        imagePreview.value = form.value.image;
        removeImageFlag.value = false;
    }
};

const removeImage = () => {
    form.value.image = '';
    selectedImageFile.value = null;
    imagePreview.value = '';
    removeImageFlag.value = true;
};

const fetchProjects = async () => {
    isLoading.value = true;
    try {
        const res = await fetch('/api/projects');
        const json = await res.json();
        if (json.success) {
            projectsList.value = json.data;
        }
    } catch (err) {
        showAlert('Failed to load projects from server.', 'error');
    } finally {
        isLoading.value = false;
    }
};

watch(() => props.isOpen, (newVal) => {
    if (newVal) {
        alertMessage.value = '';
        fetchProjects();
    }
});

const showAlert = (msg, type = 'success') => {
    alertMessage.value = msg;
    alertType.value = type;
    setTimeout(() => {
        if (alertMessage.value === msg) alertMessage.value = '';
    }, 4000);
};

const openCreateForm = () => {
    editingId.value = null;
    form.value = {
        title: '',
        category: 'Website',
        year: new Date().getFullYear().toString(),
        desc: '',
        image: '',
    };
    selectedImageFile.value = null;
    imagePreview.value = '';
    removeImageFlag.value = false;
    tagsInput.value = '';
    currentView.value = 'form';
};

const openEditForm = (proj) => {
    editingId.value = proj.id;
    form.value = {
        title: proj.title,
        category: proj.category,
        year: proj.year,
        desc: proj.desc,
        image: proj.image || '',
    };
    selectedImageFile.value = null;
    imagePreview.value = proj.image || '';
    removeImageFlag.value = false;
    tagsInput.value = Array.isArray(proj.tags) ? proj.tags.join(', ') : '';
    currentView.value = 'form';
};

const closeModal = () => {
    emit('close');
};

const saveProject = async () => {
    isSaving.value = true;

    const formData = new FormData();
    formData.append('title', form.value.title);
    formData.append('category', form.value.category);
    formData.append('year', form.value.year);
    formData.append('desc', form.value.desc);
    formData.append('tags', JSON.stringify(parsedTags.value));

    if (selectedImageFile.value) {
        formData.append('image', selectedImageFile.value);
    } else if (form.value.image) {
        formData.append('image', form.value.image);
    }

    if (removeImageFlag.value) {
        formData.append('remove_image', '1');
    }

    try {
        const url = editingId.value ? `/api/projects/${editingId.value}` : '/api/projects';
        
        // When updating with multipart/form-data in Laravel, use POST with _method=PUT
        if (editingId.value) {
            formData.append('_method', 'PUT');
        }

        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData,
        });

        const json = await res.json();

        if (res.ok && json.success) {
            showAlert(json.message || 'Saved successfully.', 'success');
            currentView.value = 'list';
            await fetchProjects();
            emit('updated');
        } else {
            showAlert(json.message || 'Failed to save project.', 'error');
        }
    } catch (err) {
        showAlert('An error occurred while saving.', 'error');
    } finally {
        isSaving.value = false;
    }
};

const confirmDelete = async (proj) => {
    if (!confirm(`Are you sure you want to delete "${proj.title}"?`)) return;

    try {
        const res = await fetch(`/api/projects/${proj.id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
            },
        });
        const json = await res.json();
        if (res.ok && json.success) {
            showAlert('Project deleted successfully.', 'success');
            await fetchProjects();
            emit('updated');
        } else {
            showAlert(json.message || 'Failed to delete project.', 'error');
        }
    } catch (err) {
        showAlert('Error occurred during deletion.', 'error');
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
