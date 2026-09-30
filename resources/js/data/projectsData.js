/**
 * Helper to generate URL-friendly slugs
 */
export function slugify(text) {
    if (!text) return '';
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-');
}

/**
 * Curated detailed case study database
 */
export const curatedCaseStudies = {
    'aquaverse': {
        slug: 'aquaverse',
        title: 'AQUAVERSE',
        shortDescription: 'VR Educational Media for Aquaculture & Deep-Sea Ecosystems',
        category: 'VR Development',
        year: '2026',
        role: 'Lead VR Developer & System Architect',
        heroImage: '/images/projects/aquaverse-hero.jpg',
        overview: 'Aquaverse is an immersive virtual reality educational experience engineered to gamify aquaculture science. Built to bridge maritime knowledge and interactive technology, the platform simulates deep-sea micro-ecosystems, water quality telemetry, and precision biological harvesting.',
        problemSolution: {
            problem: 'Traditional aquaculture training relies on static 2D manuals with zero spatial comprehension of complex underwater ecosystems.',
            solution: 'An intuitive 6-DOF virtual reality simulation providing real-time tactile interaction with aquatic organisms and aquaculture tooling.'
        },
        contribution: 'Architected the complete VR interaction pipeline using OpenXR & XR Interaction Toolkit in Unity 3D (C#). Programmed custom spatial UI systems, procedural boid fish schooling behaviors, water caustics shaders, and high-performance physics raycasting for standalone Meta Quest hardware.',
        technologies: [
            'Unity 3D',
            'C#',
            'XR Interaction Toolkit',
            'OpenXR',
            'Meta Quest 2',
            'Shader Graph',
            'Blender'
        ],
        features: [
            {
                number: '01',
                title: 'ZONE-BASED HARVESTING & FISHING',
                description: 'A zone-based harvesting mechanic using weighted randomness algorithms to determine fish rarity, ecological health, and lifecycle stages based on spatial depth.',
                tech: 'Physics Raycasting · Weighted Probability · State Machine',
                image: '/images/projects/aquaverse-fishing.jpg'
            },
            {
                number: '02',
                title: 'HAND-ANCHORED SPATIAL INVENTORY',
                description: 'A radial 3D inventory system anchored to the player\'s wrist controller, engineered for zero-fatigue item management and instant haptic feedback.',
                tech: 'XR Direct Interactor · Canvas Worldspace · Haptic Feedback Engine',
                image: '/images/projects/aquaverse-inventory.jpg'
            },
            {
                number: '03',
                title: 'UNDERWATER ECOSYSTEM SIMULATION',
                description: 'Autonomous marine life flocking powered by procedural boids calculation, combined with optimized underwater caustics vertex shaders.',
                tech: 'Boids Flocking Algorithm · Custom Vertex Shaders · Volumetric Lighting',
                image: '/images/projects/aquaverse-hero.jpg'
            }
        ],
        result: {
            headline: 'STANDALONE PERFORMANCE & ENGAGEMENT',
            summary: 'Delivered an uncompromising 72 FPS experience directly on mobile VR hardware with verified zero-nausea user comfort during extensive trials.',
            metrics: [
                { value: '72 FPS', label: 'Stable Standalone Framerate' },
                { value: '14+', label: 'Interactive Core Mechanics' },
                { value: '0 ms', label: 'Haptic Response Latency' },
                { value: '4.9 / 5', label: 'User Study Usability Score' }
            ]
        },
        gallery: [
            {
                url: '/images/projects/aquaverse-hero.jpg',
                title: 'Deep Sea Research Laboratory',
                caption: 'Central underwater habitat and biometric specimen analytics deck.'
            },
            {
                url: '/images/projects/aquaverse-fishing.jpg',
                title: 'Sonar Scanning & Harvesting Grid',
                caption: 'Real-time sonar mapping interface with fish density heatmap.'
            },
            {
                url: '/images/projects/aquaverse-inventory.jpg',
                title: 'Radial Wrist-Anchored Toolkit',
                caption: 'Zero-latency equipment management system with haptic pulse confirmation.'
            }
        ],
        githubUrl: 'https://github.com/IamNopall',
        liveUrl: null,
        documentationUrl: null
    },

    'void-walker': {
        slug: 'void-walker',
        title: 'VOID WALKER',
        shortDescription: '3D Sci-Fi Action Platformer with Cosmic Physics & Combat',
        category: 'Unity 3D',
        year: '2024',
        role: 'Gameplay Programmer & Technical Artist',
        heroImage: '/images/projects/voidwalker-hero.jpg',
        overview: 'Void Walker is a third-person physics-driven action platformer set across disintegrating obsidian monoliths in deep space. Players harness void energy to manipulate gravity vectors, traverse shifting platforms, and engage aggressive cybernetic sentinels.',
        problemSolution: {
            problem: 'Standard platformers suffer from rigid, linear movement that lacks momentum and emergent vertical traversal.',
            solution: 'Engineered a momentum-preserving character controller with multidirectional grappling and dynamic gravity wells.'
        },
        contribution: 'Developed the custom kinematic character controller in Unity C#, created procedural trail and particle VFX in Shader Graph, authored enemy state machines, and designed the sound occlusion audio engine.',
        technologies: [
            'Unity 3D',
            'C#',
            'Universal Render Pipeline (URP)',
            'Shader Graph',
            'Blender',
            'Cinemachine'
        ],
        features: [
            {
                number: '01',
                title: 'KINEMATIC MOMENTUM CONTROLLER',
                description: 'Custom physics controller capable of surface-snapping, wall-sliding, air-dashing, and smooth inertial preservation during high-speed vertical gameplay.',
                tech: 'Custom Raycast Controller · Inertia Preserving Physics · Smooth Step Damping',
                image: '/images/projects/voidwalker-hero.jpg'
            },
            {
                number: '02',
                title: 'DYNAMIC VOID PARTICLE FX',
                description: 'GPU-accelerated visual effects that react dynamically to weapon strikes, dashing vectors, and spatial distortion fields.',
                tech: 'VFX Graph · Custom HLSL Shaders · Screen-Space Post-Processing',
                image: '/images/projects/voidwalker-hero.jpg'
            }
        ],
        result: {
            headline: 'HIGH REPLAYABILITY & FLUIDITY',
            summary: 'Benchmarked with smooth 60+ FPS performance across mid-tier GPUs with positive feedback on control responsiveness and visual polish.',
            metrics: [
                { value: '60+ FPS', label: 'Target Frame Rate (1440p)' },
                { value: '8+', label: 'Modular Movement Mechanics' },
                { value: '< 16ms', label: 'Frame Render Budget' },
                { value: '100%', label: 'Custom C# Physics Pipeline' }
            ]
        },
        gallery: [
            {
                url: '/images/projects/voidwalker-hero.jpg',
                title: 'Cosmic Monolith Rift Overlook',
                caption: 'Atmospheric hero vista showcasing void particle fields and monolithic architecture.'
            }
        ],
        githubUrl: 'https://github.com/IamNopall',
        liveUrl: null,
        documentationUrl: null
    },

    'nopal-dev': {
        slug: 'nopal-dev',
        title: 'NOPAL.DEV',
        shortDescription: 'High-Impact Editorial Portfolio for Informatics & Game Engineering',
        category: 'Web Architecture',
        year: '2025',
        role: 'Full-Stack Developer & UI/UX Designer',
        heroImage: '/images/projects/aquaverse-hero.jpg',
        overview: 'A bespoke personal portfolio designed with an anti-slop editorial philosophy. Built from the ground up to showcase interactive systems, game mechanics, and modern web architecture with uncompromising typographic precision and performance.',
        problemSolution: {
            problem: 'Generic template portfolios with repetitive SaaS bento cards fail to express distinct technical craftsmanship and identity.',
            solution: 'An architectural, high-contrast dark aesthetic with custom typography, fluid reactive parallax, and comprehensive case study breakdowns.'
        },
        contribution: 'Designed and built the full application stack using Vue 3, Vite, Tailwind CSS v4, and Laravel REST backend with custom admin management and dynamic slug routing.',
        technologies: [
            'Vue 3',
            'Vite',
            'Tailwind CSS v4',
            'Laravel 12',
            'PHP 8.2',
            'JavaScript ESNext'
        ],
        features: [
            {
                number: '01',
                title: 'REACTIVE EDITORIAL TYPOGRAPHY',
                description: 'Synchronized viewport-scaled headline typography combined with a dynamic multilingial greeting roller and silky micro-interactions.',
                tech: 'CSS Viewport Units · RequestAnimationFrame · Smooth Spring Transitions',
                image: '/images/projects/aquaverse-hero.jpg'
            },
            {
                number: '02',
                title: 'DYNAMIC REST CASE STUDY ARCHITECTURE',
                description: 'Seamless integration between Laravel REST API and client-side case study enrichment with dynamic slug matching and failover resilience.',
                tech: 'Vue Router v4 · RESTful API · Reactive Data Hydration',
                image: '/images/projects/aquaverse-inventory.jpg'
            }
        ],
        result: {
            headline: 'LIGHTHOUSE 98+ PERFORMANCE',
            summary: 'Engineered for instant time-to-interactive, zero layout shift, and silky smooth 60fps animations across all screen sizes.',
            metrics: [
                { value: '98+', label: 'Lighthouse Performance Score' },
                { value: '< 0.5s', label: 'Initial Page Load Time' },
                { value: '0 CLS', label: 'Cumulative Layout Shift' },
                { value: '100%', label: 'Responsive Viewport Parity' }
            ]
        },
        gallery: [
            {
                url: '/images/projects/aquaverse-hero.jpg',
                title: 'Editorial Interface System',
                caption: 'High-contrast typography layout featuring custom Mixtape Condensed display type.'
            }
        ],
        githubUrl: 'https://github.com/IamNopall',
        liveUrl: 'https://nopal.dev',
        documentationUrl: null
    },

    'taskflow': {
        slug: 'taskflow',
        title: 'TASKFLOW',
        shortDescription: 'Collaborative Project Management Suite with Real-Time Board Engine',
        category: 'Web Application',
        year: '2024',
        role: 'Full-Stack Software Engineer',
        heroImage: '/images/projects/aquaverse-fishing.jpg',
        overview: 'TaskFlow is a high-performance project management web application created for engineering teams. It provides intuitive Kanban boards, sprint telemetry, nested task hierarchies, and instant status updates.',
        problemSolution: {
            problem: 'Complex enterprise task trackers are cluttered with bloat and suffer from sluggish UI response times.',
            solution: 'A streamlined, keyboard-first Kanban interface with instant optimistic UI updates and robust relational database modeling.'
        },
        contribution: 'Architected the relational schema in MySQL, implemented REST API endpoints in Laravel with resource authorization policies, and developed the reactive drag-and-drop board interface in Vue 3.',
        technologies: [
            'Vue 3',
            'Laravel',
            'MySQL',
            'Tailwind CSS',
            'REST API',
            'Pinia'
        ],
        features: [
            {
                number: '01',
                title: 'DRAG-AND-DROP KANBAN ENGINE',
                description: 'Fluid card re-ordering and status lane transitions backed by optimistic UI state and debounced background persistence.',
                tech: 'HTML5 Drag & Drop · Optimistic State · REST Sync',
                image: '/images/projects/aquaverse-fishing.jpg'
            }
        ],
        result: {
            headline: 'STREAMLINED TEAM VELOCITY',
            summary: 'Successfully deployed and utilized for collaborative course projects with seamless multi-user task synchronization.',
            metrics: [
                { value: '< 100ms', label: 'Average API Response Time' },
                { value: '100%', label: 'Type-Safe Validation' },
                { value: '200+', label: 'Tracked Tasks in Testing' }
            ]
        },
        gallery: [],
        githubUrl: 'https://github.com/IamNopall',
        liveUrl: null,
        documentationUrl: null
    },

    'echoscape': {
        slug: 'echoscape',
        title: 'ECHOSCAPE',
        shortDescription: 'Atmospheric First-Person Exploration with Procedural Soundscapes',
        category: 'Unity 3D',
        year: '2025',
        role: 'Audio Programmer & Game Designer',
        heroImage: '/images/projects/voidwalker-hero.jpg',
        overview: 'EchoScape is an atmospheric horror mystery where visual navigation depends directly on audio cues and sonar pulse reflections in complete darkness.',
        problemSolution: {
            problem: 'Most horror titles rely on cheap visual jump scares rather than auditory tension.',
            solution: 'A gameplay loop driven by echolocation, sound propagation algorithms, and dynamic binaural spatialization.'
        },
        contribution: 'Engineered the acoustic impulse response calculation system, visual sonar particle propagation shaders, and environmental atmospheric audio loops.',
        technologies: [
            'Unity 3D',
            'C#',
            'FMOD / Unity Audio',
            'Shader Graph',
            'Blender'
        ],
        features: [
            {
                number: '01',
                title: 'ACOUSTIC ECHOLOCATION RAYS',
                description: 'Custom ray-tracing system that emits sound wave rings upon footstep impact, momentarily illuminating geometry silhouettes.',
                tech: 'Sphere Raycast Sweep · Vertex Color Masking · Spatial Audio',
                image: '/images/projects/voidwalker-hero.jpg'
            }
        ],
        result: {
            headline: 'AUDITORY IMMERSION',
            summary: 'Delivered an intensely atmospheric interactive prototype praised for psychological suspense and audio innovation.',
            metrics: [
                { value: '3D Spatial', label: 'Binaural Audio Modeling' },
                { value: '60 FPS', label: 'Consistent Performance' }
            ]
        },
        gallery: [],
        githubUrl: 'https://github.com/IamNopall',
        liveUrl: null,
        documentationUrl: null
    },

    'shopsphere': {
        slug: 'shopsphere',
        title: 'SHOPSPHERE',
        shortDescription: 'Modern E-Commerce Storefront with Real-Time Stock & Checkout',
        category: 'Web Application',
        year: '2024',
        role: 'Backend & Frontend Developer',
        heroImage: '/images/projects/aquaverse-inventory.jpg',
        overview: 'ShopSphere is a full-stack digital commerce engine with catalog filtering, shopping cart persistence, payment simulation, and an integrated merchant admin panel.',
        problemSolution: {
            problem: 'Fragmented store setups that create friction between inventory management and the customer checkout flow.',
            solution: 'A unified single-source commerce platform with seamless order processing and real-time inventory locking.'
        },
        contribution: 'Designed the MySQL transactional schema, built cart state logic, integrated secure checkout flows, and styled responsive storefront components.',
        technologies: [
            'Laravel',
            'Vue.js',
            'Tailwind CSS',
            'MySQL',
            'Stripe API'
        ],
        features: [
            {
                number: '01',
                title: 'FAST MULTI-FACET CATALOG FILTER',
                description: 'Instant multi-attribute search and category filtering with instant client-side updates and zero page reload lag.',
                tech: 'Indexed Queries · Reactive Vue Filtering · URL State Sync',
                image: '/images/projects/aquaverse-inventory.jpg'
            }
        ],
        result: {
            headline: 'TRANSACTION ACCURACY',
            summary: '100% test coverage on inventory transaction locking preventing overselling scenarios.',
            metrics: [
                { value: '100%', label: 'Transaction Integrity' },
                { value: '50ms', label: 'Cart Hydration Speed' }
            ]
        },
        gallery: [],
        githubUrl: 'https://github.com/IamNopall',
        liveUrl: null,
        documentationUrl: null
    }
};

/**
 * Resolve project data by slug or ID, merging API project data with curated case studies.
 */
/**
 * Resolve project data by slug or ID, merging database API data with curated fallback values.
 */
export function resolveProjectData(slugOrId, apiProjects = []) {
    if (!slugOrId) return null;
    const cleanQuery = String(slugOrId).toLowerCase().trim();

    // 1. Look for matching project in apiProjects first (by slug or ID or slugified title)
    const apiMatch = apiProjects.find(
        p => (p.slug && p.slug.toLowerCase() === cleanQuery) ||
             slugify(p.title) === cleanQuery ||
             String(p.id) === cleanQuery
    );

    // Look for curated fallback definition
    const curatedMatch = curatedCaseStudies[cleanQuery] ||
                         (apiMatch ? curatedCaseStudies[slugify(apiMatch.title)] : null) ||
                         (apiMatch && apiMatch.slug ? curatedCaseStudies[apiMatch.slug] : null);

    if (apiMatch) {
        const slug = apiMatch.slug || slugify(apiMatch.title);
        const title = apiMatch.title || curatedMatch?.title || '';
        const category = apiMatch.category || curatedMatch?.category || 'Software Engineering';
        const year = apiMatch.year || curatedMatch?.year || new Date().getFullYear().toString();
        const shortDescription = apiMatch.desc || curatedMatch?.shortDescription || '';
        const role = apiMatch.role || curatedMatch?.role || 'Lead Developer & Architect';
        const heroImage = apiMatch.image || curatedMatch?.heroImage || '/images/projects/aquaverse-hero.jpg';

        const overview = apiMatch.overview || curatedMatch?.overview || apiMatch.desc || 'Comprehensive case study exploration.';
        
        let problemSolution = null;
        if (apiMatch.problem || apiMatch.solution) {
            problemSolution = {
                problem: apiMatch.problem || 'Addressing core digital requirements and performance constraints.',
                solution: apiMatch.solution || 'Engineered a scalable, maintainable solution using robust design patterns.'
            };
        } else if (curatedMatch?.problemSolution) {
            problemSolution = curatedMatch.problemSolution;
        }

        const contribution = apiMatch.contribution || curatedMatch?.contribution || `Led core systems architecture, feature engineering, and design implementation for ${title}.`;

        const technologies = (apiMatch.tags && apiMatch.tags.length > 0)
            ? apiMatch.tags
            : (curatedMatch?.technologies || ['Vue.js', 'Laravel', 'Tailwind CSS']);

        let features = [];
        if (Array.isArray(apiMatch.features) && apiMatch.features.length > 0) {
            features = apiMatch.features;
        } else if (curatedMatch?.features) {
            features = curatedMatch.features;
        } else {
            features = [
                {
                    number: '01',
                    title: 'CORE ARCHITECTURE & SYSTEMS',
                    description: apiMatch.desc || 'Engineered modular components and clean data contracts for optimal performance and maintainability.',
                    tech: (apiMatch.tags || ['Core Systems']).slice(0, 3).join(' · '),
                    image: apiMatch.image || '/images/projects/aquaverse-hero.jpg'
                }
            ];
        }

        let result = null;
        if (apiMatch.result_headline || apiMatch.result_summary || (Array.isArray(apiMatch.result_metrics) && apiMatch.result_metrics.length > 0)) {
            result = {
                headline: apiMatch.result_headline || 'MEASURABLE OUTCOMES',
                summary: apiMatch.result_summary || 'Successfully verified across target platforms with verified performance and code quality.',
                metrics: Array.isArray(apiMatch.result_metrics) && apiMatch.result_metrics.length > 0
                    ? apiMatch.result_metrics
                    : [
                        { value: '100%', label: 'Requirement Delivery' },
                        { value: apiMatch.year || '2026', label: 'Release Cycle' }
                    ]
            };
        } else if (curatedMatch?.result) {
            result = curatedMatch.result;
        }

        let gallery = [];
        if (Array.isArray(apiMatch.gallery) && apiMatch.gallery.length > 0) {
            gallery = apiMatch.gallery;
        } else if (curatedMatch?.gallery) {
            gallery = curatedMatch.gallery;
        } else if (apiMatch.image) {
            gallery = [{ url: apiMatch.image, title: apiMatch.title, caption: apiMatch.desc }];
        }

        return {
            id: apiMatch.id,
            slug,
            title,
            category,
            year,
            shortDescription,
            role,
            heroImage,
            overview,
            problemSolution,
            contribution,
            technologies,
            features,
            result,
            gallery,
            githubUrl: apiMatch.github_url ?? curatedMatch?.githubUrl ?? null,
            liveUrl: apiMatch.live_url ?? curatedMatch?.liveUrl ?? null,
            documentationUrl: apiMatch.documentation_url ?? curatedMatch?.documentationUrl ?? null,
        };
    }

    // 2. If not found in apiProjects, return curated data if available
    if (curatedMatch) {
        return curatedMatch;
    }

    return null;
}

/**
 * Get adjacent (Previous & Next) projects for direct traversal
 */
export function getAdjacentProjects(currentSlug, allProjects = []) {
    const list = [];
    const seenSlugs = new Set();

    // 1. Jika ada data project dari Supabase / API, prioritaskan data tersebut
    if (Array.isArray(allProjects) && allProjects.length > 0) {
        for (const p of allProjects) {
            const slug = p.slug || slugify(p.title);
            if (slug && !seenSlugs.has(slug)) {
                seenSlugs.add(slug);
                list.push({
                    slug,
                    title: p.title,
                    category: p.category,
                    year: p.year
                });
            }
        }
    } else {
        // 2. Hanya gunakan data curated (dummy/mock) jika data API benar-benar kosong
        for (const [key, item] of Object.entries(curatedCaseStudies)) {
            if (!seenSlugs.has(key)) {
                seenSlugs.add(key);
                list.push({
                    slug: key,
                    title: item.title,
                    category: item.category,
                    year: item.year
                });
            }
        }
    }

    // Jika hanya ada 1 atau 0 project, tidak ada project Previous / Next
    if (list.length <= 1) {
        return { prev: null, next: null };
    }

    const currentIndex = list.findIndex(p => p.slug === currentSlug);
    if (currentIndex === -1) {
        return {
            prev: list[list.length - 1],
            next: list[0]
        };
    }

    const prevIndex = (currentIndex - 1 + list.length) % list.length;
    const nextIndex = (currentIndex + 1) % list.length;

    return {
        prev: list[prevIndex],
        next: list[nextIndex]
    };
}

