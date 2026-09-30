-- Create projects table
CREATE TABLE IF NOT EXISTS public.projects (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    category VARCHAR(255) NOT NULL,
    year VARCHAR(50) NOT NULL,
    "desc" TEXT NOT NULL,
    role VARCHAR(255),
    image VARCHAR(255),
    overview TEXT,
    problem TEXT,
    solution TEXT,
    contribution TEXT,
    tags JSONB DEFAULT '[]'::jsonb,
    features JSONB DEFAULT '[]'::jsonb,
    result_headline VARCHAR(255),
    result_summary TEXT,
    result_metrics JSONB DEFAULT '[]'::jsonb,
    gallery JSONB DEFAULT '[]'::jsonb,
    github_url VARCHAR(255),
    live_url VARCHAR(255),
    documentation_url VARCHAR(255),
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Create admin_access table
CREATE TABLE IF NOT EXISTS public.admin_access (
    id BIGSERIAL PRIMARY KEY,
    key VARCHAR(255) UNIQUE DEFAULT 'admin_pin',
    pin_hash VARCHAR(255) NOT NULL,
    last_login_at TIMESTAMP WITH TIME ZONE,
    last_login_ip VARCHAR(255),
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Seed initial admin access record with PIN: 20032005 (Bcrypt hash)
INSERT INTO public.admin_access (key, pin_hash, created_at, updated_at)
VALUES (
    'admin_pin',
    '$2y$12$eI7L1k9V/2h5uXW.u9QW7.tJbM9P1yK7gq6T6yY8.R6Z8w4o9e.K.',
    NOW(),
    NOW()
)
ON CONFLICT (key) DO NOTHING;

-- Seed initial 6 Case Study projects
INSERT INTO public.projects (
    title, slug, category, year, "desc", role, image, overview, problem, solution, contribution,
    tags, features, result_headline, result_summary, result_metrics, gallery, github_url, live_url, documentation_url
) VALUES
(
    'AQUAVERSE',
    'aquaverse',
    'VR Development',
    '2026',
    'VR Educational Media for Aquaculture & Deep-Sea Ecosystems.',
    'Lead VR Developer & System Architect',
    '/images/projects/aquaverse-hero.jpg',
    'Aquaverse is an immersive virtual reality educational experience engineered to gamify aquaculture science. Built to bridge maritime knowledge and interactive technology, the platform simulates deep-sea micro-ecosystems, water quality telemetry, and precision biological harvesting.',
    'Traditional aquaculture training relies on static 2D manuals with zero spatial comprehension of complex underwater ecosystems.',
    'An intuitive 6-DOF virtual reality simulation providing real-time tactile interaction with aquatic organisms and aquaculture tooling.',
    'Architected the complete VR interaction pipeline using OpenXR & XR Interaction Toolkit in Unity 3D (C#). Programmed custom spatial UI systems, procedural boid fish schooling behaviors, water caustics shaders, and high-performance physics raycasting for standalone Meta Quest hardware.',
    '["Unity 3D", "C#", "XR Interaction Toolkit", "OpenXR", "Meta Quest 2", "Shader Graph", "Blender"]'::jsonb,
    '[
        {"number": "01", "title": "ZONE-BASED HARVESTING & FISHING", "description": "A zone-based harvesting mechanic using weighted randomness algorithms to determine fish rarity, ecological health, and lifecycle stages based on spatial depth.", "tech": "Physics Raycasting · Weighted Probability · State Machine", "image": "/images/projects/aquaverse-fishing.jpg"},
        {"number": "02", "title": "HAND-ANCHORED SPATIAL INVENTORY", "description": "A radial 3D inventory system anchored to the player wrist controller, engineered for zero-fatigue item management and instant haptic feedback.", "tech": "XR Direct Interactor · Canvas Worldspace · Haptic Feedback Engine", "image": "/images/projects/aquaverse-inventory.jpg"},
        {"number": "03", "title": "UNDERWATER ECOSYSTEM SIMULATION", "description": "Autonomous marine life flocking powered by procedural boids calculation, combined with optimized underwater caustics vertex shaders.", "tech": "Boids Flocking Algorithm · Custom Vertex Shaders · Volumetric Lighting", "image": "/images/projects/aquaverse-hero.jpg"}
    ]'::jsonb,
    'STANDALONE PERFORMANCE & ENGAGEMENT',
    'Delivered an uncompromising 72 FPS experience directly on mobile VR hardware with verified zero-nausea user comfort during extensive trials.',
    '[
        {"value": "72 FPS", "label": "Stable Standalone Framerate"},
        {"value": "14+", "label": "Interactive Core Mechanics"},
        {"value": "0 ms", "label": "Haptic Response Latency"},
        {"value": "4.9 / 5", "label": "User Study Usability Score"}
    ]'::jsonb,
    '[
        {"url": "/images/projects/aquaverse-hero.jpg", "title": "Deep Sea Research Laboratory", "caption": "Central underwater habitat and biometric specimen analytics deck."},
        {"url": "/images/projects/aquaverse-fishing.jpg", "title": "Sonar Scanning & Harvesting Grid", "caption": "Real-time sonar mapping interface with fish density heatmap."},
        {"url": "/images/projects/aquaverse-inventory.jpg", "title": "Radial Wrist-Anchored Toolkit", "caption": "Zero-latency equipment management system with haptic pulse confirmation."}
    ]'::jsonb,
    'https://github.com/IamNopall',
    NULL,
    NULL
),
(
    'VOID WALKER',
    'void-walker',
    'Unity',
    '2024',
    '3D action platformer with fluid movement and physics-based combat.',
    'Gameplay Programmer & Technical Artist',
    '/images/projects/voidwalker-hero.jpg',
    'Void Walker is a third-person physics-driven action platformer set across disintegrating obsidian monoliths in deep space. Players harness void energy to manipulate gravity vectors, traverse shifting platforms, and engage aggressive cybernetic sentinels.',
    'Standard platformers suffer from rigid, linear movement that lacks momentum and emergent vertical traversal.',
    'Engineered a momentum-preserving character controller with multidirectional grappling and dynamic gravity wells.',
    'Developed the custom kinematic character controller in Unity C#, created procedural trail and particle VFX in Shader Graph, authored enemy state machines, and designed the sound occlusion audio engine.',
    '["Unity", "C#", "Universal Render Pipeline (URP)", "Shader Graph", "Blender"]'::jsonb,
    '[
        {"number": "01", "title": "KINEMATIC MOMENTUM CONTROLLER", "description": "Custom physics controller capable of surface-snapping, wall-sliding, air-dashing, and smooth inertial preservation during high-speed vertical gameplay.", "tech": "Custom Raycast Controller · Inertia Preserving Physics", "image": "/images/projects/voidwalker-hero.jpg"}
    ]'::jsonb,
    'HIGH REPLAYABILITY & FLUIDITY',
    'Benchmarked with smooth 60+ FPS performance across mid-tier GPUs with positive feedback on control responsiveness and visual polish.',
    '[
        {"value": "60+ FPS", "label": "Target Frame Rate (1440p)"},
        {"value": "8+", "label": "Modular Movement Mechanics"}
    ]'::jsonb,
    '[
        {"url": "/images/projects/voidwalker-hero.jpg", "title": "Cosmic Monolith Rift Overlook", "caption": "Atmospheric hero vista showcasing void particle fields and monolithic architecture."}
    ]'::jsonb,
    'https://github.com/IamNopall',
    NULL,
    NULL
),
(
    'Nopal.Dev',
    'nopal-dev',
    'Website',
    '2025',
    'Minimalist portfolio website built with Vue.js and Laravel.',
    'Full-Stack Developer & UI/UX Designer',
    '/images/projects/aquaverse-hero.jpg',
    'A bespoke personal portfolio designed with an anti-slop editorial philosophy. Built from the ground up to showcase interactive systems, game mechanics, and modern web architecture with uncompromising typographic precision and performance.',
    'Generic template portfolios with repetitive SaaS bento cards fail to express distinct technical craftsmanship and identity.',
    'An architectural, high-contrast dark aesthetic with custom typography, fluid reactive parallax, and comprehensive case study breakdowns.',
    'Designed and built the full application stack using Vue 3, Vite, Tailwind CSS v4, and Laravel REST backend with custom admin management and dynamic slug routing.',
    '["Vue.js", "Laravel", "Tailwind", "Vite", "PHP 8.2"]'::jsonb,
    '[
        {"number": "01", "title": "REACTIVE EDITORIAL TYPOGRAPHY", "description": "Synchronized viewport-scaled headline typography combined with a dynamic multilingual greeting roller and silky micro-interactions.", "tech": "CSS Viewport Units · RequestAnimationFrame · Smooth Spring Transitions", "image": "/images/projects/aquaverse-hero.jpg"}
    ]'::jsonb,
    'LIGHTHOUSE 98+ PERFORMANCE',
    'Engineered for instant time-to-interactive, zero layout shift, and silky smooth 60fps animations across all screen sizes.',
    '[
        {"value": "98+", "label": "Lighthouse Performance Score"},
        {"value": "< 0.5s", "label": "Initial Page Load Time"}
    ]'::jsonb,
    '[]'::jsonb,
    'https://github.com/IamNopall',
    'https://nopal.dev',
    NULL
),
(
    'TaskFlow',
    'taskflow',
    'Website',
    '2024',
    'Collaborative project management app with real-time task tracking.',
    'Full-Stack Software Engineer',
    '/images/projects/aquaverse-fishing.jpg',
    'TaskFlow is a high-performance project management web application created for engineering teams. It provides intuitive Kanban boards, sprint telemetry, nested task hierarchies, and instant status updates.',
    'Complex enterprise task trackers are cluttered with bloat and suffer from sluggish UI response times.',
    'A streamlined, keyboard-first Kanban interface with instant optimistic UI updates and robust relational database modeling.',
    'Architected the relational schema in PostgreSQL, implemented REST API endpoints in Laravel with resource authorization policies, and developed the reactive drag-and-drop board interface in Vue 3.',
    '["Vue.js", "Laravel", "PostgreSQL", "Tailwind CSS"]'::jsonb,
    '[
        {"number": "01", "title": "OPTIMISTIC KANBAN PIPELINE", "description": "Zero-latency drag-and-drop workflow updates with automatic background conflict resolution and sync state recovery.", "tech": "HTML5 Drag-Drop · Optimistic State · Debounced Sync", "image": "/images/projects/aquaverse-fishing.jpg"}
    ]'::jsonb,
    'IMPROVED SPRINT VELOCITY',
    'Adopted by internal student engineering teams, reducing task tracking overhead by 40% compared to legacy tooling.',
    '[
        {"value": "40%", "label": "Reduced Meeting Overhead"},
        {"value": "100%", "label": "Type-Safe Validation"}
    ]'::jsonb,
    '[]'::jsonb,
    'https://github.com/IamNopall',
    NULL,
    NULL
),
(
    'Karsa Coffee',
    'karsa-coffee',
    'Website',
    '2024',
    'E-commerce & branding platform for a modern artisan coffee roastery.',
    'Frontend & Creative Developer',
    '/images/projects/aquaverse-inventory.jpg',
    'A bespoke digital storefront and brand narrative experience for an independent artisan coffee roastery, featuring interactive flavor profile wheel visualizations and friction-free checkout.',
    'Standard e-commerce storefronts feel generic and fail to communicate bean origins, tasting notes, and roaster philosophy.',
    'An editorial e-commerce layout featuring fluid page transitions, interactive origin maps, and an interactive tasting radar chart.',
    'Designed the digital identity, built the high-performance Vue 3 storefront with custom GSAP scroll transitions, and integrated order dispatch APIs.',
    '["Vue.js", "Tailwind CSS", "Pinia", "GSAP", "REST API"]'::jsonb,
    '[
        {"number": "01", "title": "INTERACTIVE FLAVOR RADAR", "description": "Interactive SVG polygon visualizing bean acidity, body, sweetness, and floral aromas dynamically based on selection.", "tech": "SVG Geometry · Dynamic Computed Props · GSAP Tween", "image": "/images/projects/aquaverse-inventory.jpg"}
    ]'::jsonb,
    'SEAMLESS COMMERCE EXPERIENCE',
    'Delivered sub-second page transitions, 100% mobile responsive touch-friendly shopping cart, and enhanced customer conversion.',
    '[
        {"value": "+35%", "label": "Average Session Duration"},
        {"value": "50ms", "label": "Cart Hydration Speed"}
    ]'::jsonb,
    '[]'::jsonb,
    'https://github.com/IamNopall',
    NULL,
    NULL
),
(
    'EcoScan',
    'ecoscan',
    'Mobile',
    '2024',
    'AI-powered waste classification and recycling companion app.',
    'Mobile Developer & AI Integrator',
    '/images/projects/voidwalker-hero.jpg',
    'EcoScan is an intelligent environmental mobile utility that identifies recyclable materials using computer vision and provides localized disposal guidelines and recycling reward tokens.',
    'Citizens struggle to accurately identify recyclable plastics and municipal waste sorting regulations.',
    'Real-time edge computer vision model classification providing instant recycling advice and disposal mapping.',
    'Integrated on-device TensorFlow Lite classification models, authored the cross-platform Flutter/Vue mobile shell, and connected municipal waste location APIs.',
    '["Flutter", "TensorFlow Lite", "Python", "FastAPI", "PostgreSQL"]'::jsonb,
    '[
        {"number": "01", "title": "REAL-TIME EDGE INFERENCE", "description": "On-device mobile camera feed classification capable of identifying plastic grades and sorting streams in under 80ms.", "tech": "TFLite MobileNetV3 · Camera Stream Buffer · Edge Inference", "image": "/images/projects/voidwalker-hero.jpg"}
    ]'::jsonb,
    'HIGH ACCURACY & LOW LATENCY',
    'Achieved 94.2% top-1 categorization accuracy across 12 standard household waste classifications on mobile devices.',
    '[
        {"value": "94.2%", "label": "Model Top-1 Accuracy"},
        {"value": "60 FPS", "label": "Consistent Performance"}
    ]'::jsonb,
    '[]'::jsonb,
    'https://github.com/IamNopall',
    NULL,
    NULL
)
ON CONFLICT (slug) DO NOTHING;
