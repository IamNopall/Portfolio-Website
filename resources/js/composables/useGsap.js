import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register plugins once
gsap.registerPlugin(ScrollTrigger);

export function useGsap() {
    const prefersReducedMotion = () => {
        if (typeof window === 'undefined') return false;
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    };

    return {
        gsap,
        ScrollTrigger,
        prefersReducedMotion,
    };
}
