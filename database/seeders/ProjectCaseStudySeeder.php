<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectCaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'AQUAVERSE',
                'slug' => 'aquaverse',
                'category' => 'VR Development',
                'year' => '2026',
                'desc' => 'VR Educational Media for Aquaculture & Deep-Sea Ecosystems.',
                'role' => 'Lead VR Developer & System Architect',
                'image' => '/images/projects/aquaverse-hero.jpg',
                'overview' => 'Aquaverse is an immersive virtual reality educational experience engineered to gamify aquaculture science. Built to bridge maritime knowledge and interactive technology, the platform simulates deep-sea micro-ecosystems, water quality telemetry, and precision biological harvesting.',
                'problem' => 'Traditional aquaculture training relies on static 2D manuals with zero spatial comprehension of complex underwater ecosystems.',
                'solution' => 'An intuitive 6-DOF virtual reality simulation providing real-time tactile interaction with aquatic organisms and aquaculture tooling.',
                'contribution' => 'Architected the complete VR interaction pipeline using OpenXR & XR Interaction Toolkit in Unity 3D (C#). Programmed custom spatial UI systems, procedural boid fish schooling behaviors, water caustics shaders, and high-performance physics raycasting for standalone Meta Quest hardware.',
                'tags' => [
                    'Unity 3D',
                    'C#',
                    'XR Interaction Toolkit',
                    'OpenXR',
                    'Meta Quest 2',
                    'Shader Graph',
                    'Blender',
                ],
                'features' => [
                    [
                        'number' => '01',
                        'title' => 'ZONE-BASED HARVESTING & FISHING',
                        'description' => 'A zone-based harvesting mechanic using weighted randomness algorithms to determine fish rarity, ecological health, and lifecycle stages based on spatial depth.',
                        'tech' => 'Physics Raycasting · Weighted Probability · State Machine',
                        'image' => '/images/projects/aquaverse-fishing.jpg',
                    ],
                    [
                        'number' => '02',
                        'title' => 'HAND-ANCHORED SPATIAL INVENTORY',
                        'description' => 'A radial 3D inventory system anchored to the player\'s wrist controller, engineered for zero-fatigue item management and instant haptic feedback.',
                        'tech' => 'XR Direct Interactor · Canvas Worldspace · Haptic Feedback Engine',
                        'image' => '/images/projects/aquaverse-inventory.jpg',
                    ],
                    [
                        'number' => '03',
                        'title' => 'UNDERWATER ECOSYSTEM SIMULATION',
                        'description' => 'Autonomous marine life flocking powered by procedural boids calculation, combined with optimized underwater caustics vertex shaders.',
                        'tech' => 'Boids Flocking Algorithm · Custom Vertex Shaders · Volumetric Lighting',
                        'image' => '/images/projects/aquaverse-hero.jpg',
                    ],
                ],
                'result_headline' => 'STANDALONE PERFORMANCE & ENGAGEMENT',
                'result_summary' => 'Delivered an uncompromising 72 FPS experience directly on mobile VR hardware with verified zero-nausea user comfort during extensive trials.',
                'result_metrics' => [
                    ['value' => '72 FPS', 'label' => 'Stable Standalone Framerate'],
                    ['value' => '14+', 'label' => 'Interactive Core Mechanics'],
                    ['value' => '0 ms', 'label' => 'Haptic Response Latency'],
                    ['value' => '4.9 / 5', 'label' => 'User Study Usability Score'],
                ],
                'gallery' => [
                    [
                        'url' => '/images/projects/aquaverse-hero.jpg',
                        'title' => 'Deep Sea Research Laboratory',
                        'caption' => 'Central underwater habitat and biometric specimen analytics deck.',
                    ],
                    [
                        'url' => '/images/projects/aquaverse-fishing.jpg',
                        'title' => 'Sonar Scanning & Harvesting Grid',
                        'caption' => 'Real-time sonar mapping interface with fish density heatmap.',
                    ],
                    [
                        'url' => '/images/projects/aquaverse-inventory.jpg',
                        'title' => 'Radial Wrist-Anchored Toolkit',
                        'caption' => 'Zero-latency equipment management system with haptic pulse confirmation.',
                    ],
                ],
                'github_url' => 'https://github.com/NaufalTsaqifUNS',
                'live_url' => null,
                'documentation_url' => null,
            ],
            [
                'title' => 'VOID WALKER',
                'slug' => 'void-walker',
                'category' => 'Unity',
                'year' => '2024',
                'desc' => '3D action platformer with fluid movement and physics-based combat.',
                'role' => 'Gameplay Programmer & Technical Artist',
                'image' => '/images/projects/voidwalker-hero.jpg',
                'overview' => 'Void Walker is a third-person physics-driven action platformer set across disintegrating obsidian monoliths in deep space. Players harness void energy to manipulate gravity vectors, traverse shifting platforms, and engage aggressive cybernetic sentinels.',
                'problem' => 'Standard platformers suffer from rigid, linear movement that lacks momentum and emergent vertical traversal.',
                'solution' => 'Engineered a momentum-preserving character controller with multidirectional grappling and dynamic gravity wells.',
                'contribution' => 'Developed the custom kinematic character controller in Unity C#, created procedural trail and particle VFX in Shader Graph, authored enemy state machines, and designed the sound occlusion audio engine.',
                'tags' => [
                    'Unity',
                    'C#',
                    'Universal Render Pipeline (URP)',
                    'Shader Graph',
                    'Blender',
                ],
                'features' => [
                    [
                        'number' => '01',
                        'title' => 'KINEMATIC MOMENTUM CONTROLLER',
                        'description' => 'Custom physics controller capable of surface-snapping, wall-sliding, air-dashing, and smooth inertial preservation during high-speed vertical gameplay.',
                        'tech' => 'Custom Raycast Controller · Inertia Preserving Physics',
                        'image' => '/images/projects/voidwalker-hero.jpg',
                    ],
                ],
                'result_headline' => 'HIGH REPLAYABILITY & FLUIDITY',
                'result_summary' => 'Benchmarked with smooth 60+ FPS performance across mid-tier GPUs with positive feedback on control responsiveness and visual polish.',
                'result_metrics' => [
                    ['value' => '60+ FPS', 'label' => 'Target Frame Rate (1440p)'],
                    ['value' => '8+', 'label' => 'Modular Movement Mechanics'],
                ],
                'gallery' => [
                    [
                        'url' => '/images/projects/voidwalker-hero.jpg',
                        'title' => 'Cosmic Monolith Rift Overlook',
                        'caption' => 'Atmospheric hero vista showcasing void particle fields and monolithic architecture.',
                    ],
                ],
                'github_url' => 'https://github.com/NaufalTsaqifUNS',
                'live_url' => null,
                'documentation_url' => null,
            ],
            [
                'title' => 'Nopal.Dev',
                'slug' => 'nopal-dev',
                'category' => 'Website',
                'year' => '2025',
                'desc' => 'Minimalist portfolio website built with Vue.js and Laravel.',
                'role' => 'Full-Stack Developer & UI/UX Designer',
                'image' => '/images/projects/aquaverse-hero.jpg',
                'overview' => 'A bespoke personal portfolio designed with an anti-slop editorial philosophy. Built from the ground up to showcase interactive systems, game mechanics, and modern web architecture with uncompromising typographic precision and performance.',
                'problem' => 'Generic template portfolios with repetitive SaaS bento cards fail to express distinct technical craftsmanship and identity.',
                'solution' => 'An architectural, high-contrast dark aesthetic with custom typography, fluid reactive parallax, and comprehensive case study breakdowns.',
                'contribution' => 'Designed and built the full application stack using Vue 3, Vite, Tailwind CSS v4, and Laravel REST backend with custom admin management and dynamic slug routing.',
                'tags' => ['Vue.js', 'Laravel', 'Tailwind', 'Vite', 'PHP 8.2'],
                'features' => [
                    [
                        'number' => '01',
                        'title' => 'REACTIVE EDITORIAL TYPOGRAPHY',
                        'description' => 'Synchronized viewport-scaled headline typography combined with a dynamic multilingual greeting roller and silky micro-interactions.',
                        'tech' => 'CSS Viewport Units · RequestAnimationFrame · Smooth Spring Transitions',
                        'image' => '/images/projects/aquaverse-hero.jpg',
                    ],
                ],
                'result_headline' => 'LIGHTHOUSE 98+ PERFORMANCE',
                'result_summary' => 'Engineered for instant time-to-interactive, zero layout shift, and silky smooth 60fps animations across all screen sizes.',
                'result_metrics' => [
                    ['value' => '98+', 'label' => 'Lighthouse Performance Score'],
                    ['value' => '< 0.5s', 'label' => 'Initial Page Load Time'],
                ],
                'gallery' => [],
                'github_url' => 'https://github.com/NaufalTsaqifUNS',
                'live_url' => 'https://nopal.dev',
                'documentation_url' => null,
            ],
            [
                'title' => 'TaskFlow',
                'slug' => 'taskflow',
                'category' => 'Website',
                'year' => '2024',
                'desc' => 'Collaborative project management app with real-time task tracking.',
                'role' => 'Full-Stack Software Engineer',
                'image' => '/images/projects/aquaverse-fishing.jpg',
                'overview' => 'TaskFlow is a high-performance project management web application created for engineering teams. It provides intuitive Kanban boards, sprint telemetry, nested task hierarchies, and instant status updates.',
                'problem' => 'Complex enterprise task trackers are cluttered with bloat and suffer from sluggish UI response times.',
                'solution' => 'A streamlined, keyboard-first Kanban interface with instant optimistic UI updates and robust relational database modeling.',
                'contribution' => 'Architected the relational schema in MySQL, implemented REST API endpoints in Laravel with resource authorization policies, and developed the reactive drag-and-drop board interface in Vue 3.',
                'tags' => ['Vue.js', 'Laravel', 'MySQL', 'Tailwind CSS'],
                'features' => [
                    [
                        'number' => '01',
                        'title' => 'DRAG-AND-DROP KANBAN ENGINE',
                        'description' => 'Fluid card re-ordering and status lane transitions backed by optimistic UI state and debounced background persistence.',
                        'tech' => 'HTML5 Drag & Drop · Optimistic State · REST Sync',
                        'image' => '/images/projects/aquaverse-fishing.jpg',
                    ],
                ],
                'result_headline' => 'STREAMLINED TEAM VELOCITY',
                'result_summary' => 'Successfully deployed and utilized for collaborative course projects with seamless multi-user task synchronization.',
                'result_metrics' => [
                    ['value' => '< 100ms', 'label' => 'Average API Response Time'],
                    ['value' => '100%', 'label' => 'Type-Safe Validation'],
                ],
                'gallery' => [],
                'github_url' => 'https://github.com/NaufalTsaqifUNS',
                'live_url' => null,
                'documentation_url' => null,
            ],
            [
                'title' => 'ShopSphere',
                'slug' => 'shopsphere',
                'category' => 'Website',
                'year' => '2024',
                'desc' => 'Full-stack e-commerce platform with inventory and order management.',
                'role' => 'Backend & Frontend Developer',
                'image' => '/images/projects/aquaverse-inventory.jpg',
                'overview' => 'ShopSphere is a full-stack digital commerce engine with catalog filtering, shopping cart persistence, payment simulation, and an integrated merchant admin panel.',
                'problem' => 'Fragmented store setups that create friction between inventory management and the customer checkout flow.',
                'solution' => 'A unified single-source commerce platform with seamless order processing and real-time inventory locking.',
                'contribution' => 'Designed the MySQL transactional schema, built cart state logic, integrated secure checkout flows, and styled responsive storefront components.',
                'tags' => ['Laravel', 'Tailwind', 'MySQL', 'Vue.js'],
                'features' => [
                    [
                        'number' => '01',
                        'title' => 'FAST MULTI-FACET CATALOG FILTER',
                        'description' => 'Instant multi-attribute search and category filtering with instant client-side updates and zero page reload lag.',
                        'tech' => 'Indexed Queries · Reactive Vue Filtering · URL State Sync',
                        'image' => '/images/projects/aquaverse-inventory.jpg',
                    ],
                ],
                'result_headline' => 'TRANSACTION ACCURACY',
                'result_summary' => '100% test coverage on inventory transaction locking preventing overselling scenarios.',
                'result_metrics' => [
                    ['value' => '100%', 'label' => 'Transaction Integrity'],
                    ['value' => '50ms', 'label' => 'Cart Hydration Speed'],
                ],
                'gallery' => [],
                'github_url' => 'https://github.com/NaufalTsaqifUNS',
                'live_url' => null,
                'documentation_url' => null,
            ],
            [
                'title' => 'EchoScape',
                'slug' => 'echoscape',
                'category' => 'Unity',
                'year' => '2025',
                'desc' => 'Atmospheric first-person horror experience with procedural sound design.',
                'role' => 'Audio Programmer & Game Designer',
                'image' => '/images/projects/voidwalker-hero.jpg',
                'overview' => 'EchoScape is an atmospheric horror mystery where visual navigation depends directly on audio cues and sonar pulse reflections in complete darkness.',
                'problem' => 'Most horror titles rely on cheap visual jump scares rather than auditory tension.',
                'solution' => 'A gameplay loop driven by echolocation, sound propagation algorithms, and dynamic binaural spatialization.',
                'contribution' => 'Engineered the acoustic impulse response calculation system, visual sonar particle propagation shaders, and environmental atmospheric audio loops.',
                'tags' => ['Unity', 'C#', 'Blender', 'Shader Graph'],
                'features' => [
                    [
                        'number' => '01',
                        'title' => 'ACOUSTIC ECHOLOCATION RAYS',
                        'description' => 'Custom ray-tracing system that emits sound wave rings upon footstep impact, momentarily illuminating geometry silhouettes.',
                        'tech' => 'Sphere Raycast Sweep · Vertex Color Masking · Spatial Audio',
                        'image' => '/images/projects/voidwalker-hero.jpg',
                    ],
                ],
                'result_headline' => 'AUDITORY IMMERSION',
                'result_summary' => 'Delivered an intensely atmospheric interactive prototype praised for psychological suspense and audio innovation.',
                'result_metrics' => [
                    ['value' => '3D Spatial', 'label' => 'Binaural Audio Modeling'],
                    ['value' => '60 FPS', 'label' => 'Consistent Performance'],
                ],
                'gallery' => [],
                'github_url' => 'https://github.com/NaufalTsaqifUNS',
                'live_url' => null,
                'documentation_url' => null,
            ],
        ];

        foreach ($projects as $projData) {
            Project::updateOrCreate(
                ['slug' => $projData['slug']],
                $projData
            );
        }
    }
}
