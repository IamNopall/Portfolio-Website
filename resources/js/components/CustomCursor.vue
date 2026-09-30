<template>
    <div class="hidden lg:block">
        <!-- Minimalist Triangle Cursor with Hotspot at (0,0) Top-Left Tip -->
        <div ref="cursorRef" class="minimal-cursor fixed top-0 left-0 z-[9999] pointer-events-none"></div>
        <!-- Cursor Follower Dot -->
        <div ref="followerDotRef" class="cursor-follower-dot fixed top-0 left-0 z-[9998] pointer-events-none"></div>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { useGsap } from '../composables/useGsap';

const { gsap, prefersReducedMotion } = useGsap();

const cursorRef = ref(null);
const followerDotRef = ref(null);

let ctx = null;
let xToCursor = null;
let yToCursor = null;
let xToFollower = null;
let yToFollower = null;

const interactiveSelector = 'a, button, [role="button"], input, select, textarea, .cursor-pointer, .group\\/item';

const handleMouseMove = (e) => {
    if (xToCursor && yToCursor) {
        xToCursor(e.clientX);
        yToCursor(e.clientY);
    }
    if (xToFollower && yToFollower) {
        xToFollower(e.clientX + 16);
        yToFollower(e.clientY + 16);
    }
};

const handlePointerOver = (e) => {
    if (e.target && e.target.closest && e.target.closest(interactiveSelector)) {
        if (cursorRef.value) {
            cursorRef.value.classList.add('is-interactive');
            gsap.to(cursorRef.value, {
                scale: 1.25,
                transformOrigin: '0 0',
                duration: 0.2,
                ease: 'power2.out',
                overwrite: 'auto',
            });
        }
        if (followerDotRef.value) {
            gsap.to(followerDotRef.value, {
                scale: 1.6,
                opacity: 0.6,
                duration: 0.25,
                ease: 'power2.out',
                overwrite: 'auto',
            });
        }
    }
};

const handlePointerOut = (e) => {
    if (e.target && e.target.closest && e.target.closest(interactiveSelector)) {
        if (cursorRef.value) {
            cursorRef.value.classList.remove('is-interactive');
            gsap.to(cursorRef.value, {
                scale: 1,
                transformOrigin: '0 0',
                duration: 0.2,
                ease: 'power2.out',
                overwrite: 'auto',
            });
        }
        if (followerDotRef.value) {
            gsap.to(followerDotRef.value, {
                scale: 1,
                opacity: 1,
                duration: 0.25,
                ease: 'power2.out',
                overwrite: 'auto',
            });
        }
    }
};

onMounted(() => {
    if (prefersReducedMotion()) return;

    ctx = gsap.context(() => {
        // Hotspot is exactly (0,0) so the tip matches actual browser click coordinates
        gsap.set(cursorRef.value, { x: -100, y: -100, transformOrigin: '0 0' });
        gsap.set(followerDotRef.value, { x: -100, y: -100 });

        xToCursor = gsap.quickTo(cursorRef.value, 'x', { duration: 0.08, ease: 'power3.out' });
        yToCursor = gsap.quickTo(cursorRef.value, 'y', { duration: 0.08, ease: 'power3.out' });

        xToFollower = gsap.quickTo(followerDotRef.value, 'x', { duration: 0.35, ease: 'power3.out' });
        yToFollower = gsap.quickTo(followerDotRef.value, 'y', { duration: 0.35, ease: 'power3.out' });
    });

    window.addEventListener('mousemove', handleMouseMove, { passive: true });
    document.addEventListener('mouseover', handlePointerOver);
    document.addEventListener('mouseout', handlePointerOut);
});

onBeforeUnmount(() => {
    window.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseover', handlePointerOver);
    document.removeEventListener('mouseout', handlePointerOut);
    if (ctx) ctx.revert();
});
</script>
