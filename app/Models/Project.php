<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'year',
        'desc',
        'role',
        'image',
        'overview',
        'problem',
        'solution',
        'contribution',
        'tags',
        'features',
        'result_headline',
        'result_summary',
        'result_metrics',
        'gallery',
        'github_url',
        'live_url',
        'documentation_url',
    ];

    protected $casts = [
        'tags' => 'array',
        'features' => 'array',
        'result_metrics' => 'array',
        'gallery' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (empty($project->slug) && !empty($project->title)) {
                $baseSlug = Str::slug($project->title);
                $slug = $baseSlug;
                $counter = 1;
                while (static::where('slug', $slug)->where('id', '!=', $project->id ?? 0)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                $project->slug = $slug;
            }
        });
    }
}

