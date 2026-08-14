<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Nopal.Dev',
                'category' => 'Website',
                'year' => '2025',
                'desc' => 'Minimalist portfolio website built with Vue.js and Laravel.',
                'tags' => ['Vue.js', 'Laravel', 'Tailwind'],
            ],
            [
                'title' => 'TaskFlow',
                'category' => 'Website',
                'year' => '2024',
                'desc' => 'Collaborative project management app with real-time task tracking.',
                'tags' => ['Vue.js', 'Laravel', 'MySQL'],
            ],
            [
                'title' => 'ShopSphere',
                'category' => 'Website',
                'year' => '2024',
                'desc' => 'Full-stack e-commerce platform with inventory and order management.',
                'tags' => ['Laravel', 'Tailwind', 'MySQL'],
            ],
            [
                'title' => 'Void Walker',
                'category' => 'Unity',
                'year' => '2024',
                'desc' => '3D action platformer with fluid movement and physics-based combat.',
                'tags' => ['Unity', 'C#', 'Blender'],
            ],
            [
                'title' => 'Neon Grid',
                'category' => 'Unity',
                'year' => '2023',
                'desc' => 'Retro-futuristic arcade puzzle game with neon aesthetic and chiptune audio.',
                'tags' => ['Unity', 'C#'],
            ],
            [
                'title' => 'EchoScape',
                'category' => 'Unity',
                'year' => '2025',
                'desc' => 'Atmospheric first-person horror experience with procedural sound design.',
                'tags' => ['Unity', 'C#', 'Blender'],
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
