import { ref } from 'vue';

const isLightMode = ref(false);

export function useTheme() {
    const applyTheme = () => {
        if (typeof document !== 'undefined') {
            document.documentElement.classList.toggle('light-mode', isLightMode.value);
            localStorage.setItem('theme', isLightMode.value ? 'light' : 'dark');
        }
    };

    const initTheme = () => {
        if (typeof window !== 'undefined') {
            const saved = localStorage.getItem('theme');
            if (saved) {
                isLightMode.value = saved === 'light';
            } else {
                isLightMode.value = false;
            }
            applyTheme();
        }
    };

    const toggleTheme = () => {
        isLightMode.value = !isLightMode.value;
        applyTheme();
    };

    return {
        isLightMode,
        toggleTheme,
        initTheme,
        applyTheme,
    };
}
