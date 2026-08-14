<template>
    <div class="hidden lg:block">
        <!-- Minimalist Triangle Cursor -->
        <div ref="cursorRef" class="minimal-cursor fixed top-0 left-0 z-[9999] pointer-events-none"></div>
        <!-- Cursor Follower Dot -->
        <div ref="followerDotRef" class="cursor-follower-dot fixed top-0 left-0 z-[9998] pointer-events-none"></div>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const cursorRef = ref(null);
const followerDotRef = ref(null);

const mousePos = { x: -200, y: -200 };
const cursorState = { x: -200, y: -200 };
const followerState = { x: -200, y: -200 };
const followerOffset = { x: 16, y: 16 };
let rafId = null;

const interactiveSelector = 'a, button, [role="button"], input, select, textarea, .cursor-pointer';

const handleMouseMove = (e) => {
    mousePos.x = e.clientX;
    mousePos.y = e.clientY;
};

const handlePointerOver = (e) => {
    if (e.target && e.target.closest && e.target.closest(interactiveSelector)) {
        if (cursorRef.value) cursorRef.value.classList.add('is-interactive');
    }
};

const handlePointerOut = (e) => {
    if (e.target && e.target.closest && e.target.closest(interactiveSelector)) {
        if (cursorRef.value) cursorRef.value.classList.remove('is-interactive');
    }
};

const animate = () => {
    const arrowLerp = 0.35;
    cursorState.x += (mousePos.x - cursorState.x) * arrowLerp;
    cursorState.y += (mousePos.y - cursorState.y) * arrowLerp;

    if (cursorRef.value) {
        cursorRef.value.style.transform = `translate3d(${cursorState.x}px, ${cursorState.y}px, 0)`;
    }

    const targetX = mousePos.x + followerOffset.x;
    const targetY = mousePos.y + followerOffset.y;
    const followerLerp = 0.15;
    followerState.x += (targetX - followerState.x) * followerLerp;
    followerState.y += (targetY - followerState.y) * followerLerp;

    if (followerDotRef.value) {
        followerDotRef.value.style.transform = `translate3d(${followerState.x}px, ${followerState.y}px, 0)`;
    }

    rafId = requestAnimationFrame(animate);
};

onMounted(() => {
    window.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseover', handlePointerOver);
    document.addEventListener('mouseout', handlePointerOut);
    animate();
});

onBeforeUnmount(() => {
    window.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseover', handlePointerOver);
    document.removeEventListener('mouseout', handlePointerOut);
    if (rafId) cancelAnimationFrame(rafId);
});
</script>
