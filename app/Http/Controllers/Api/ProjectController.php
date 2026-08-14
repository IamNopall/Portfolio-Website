<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'category' => 'required|string|max:100',
            'year' => 'required|string|max:10',
            'desc' => 'required|string',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable',
            'overview' => 'nullable|string',
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'contribution' => 'nullable|string',
            'tags' => 'nullable',
            'features' => 'nullable',
            'result_headline' => 'nullable|string|max:255',
            'result_summary' => 'nullable|string',
            'result_metrics' => 'nullable',
            'gallery' => 'nullable',
            'github_url' => 'nullable|string|max:500',
            'live_url' => 'nullable|string|max:500',
            'documentation_url' => 'nullable|string|max:500',
        ]);

        $tags = $this->parseJsonOrArray($request->input('tags'));
        $features = $this->parseJsonOrArray($request->input('features'));
        $resultMetrics = $this->parseJsonOrArray($request->input('result_metrics'));
        $gallery = $this->parseJsonOrArray($request->input('gallery'));

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $stored = $file->store('projects', 'public');
            $imagePath = '/storage/' . $stored;
        } elseif ($request->filled('image') && is_string($request->input('image'))) {
            $imagePath = $request->input('image');
        }

        $project = Project::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?? Str::slug($validated['title']),
            'category' => $validated['category'],
            'year' => $validated['year'],
            'desc' => $validated['desc'],
            'role' => $validated['role'] ?? null,
            'image' => $imagePath,
            'overview' => $validated['overview'] ?? null,
            'problem' => $validated['problem'] ?? null,
            'solution' => $validated['solution'] ?? null,
            'contribution' => $validated['contribution'] ?? null,
            'tags' => $tags ?? [],
            'features' => $features ?? [],
            'result_headline' => $validated['result_headline'] ?? null,
            'result_summary' => $validated['result_summary'] ?? null,
            'result_metrics' => $resultMetrics ?? [],
            'gallery' => $gallery ?? [],
            'github_url' => $validated['github_url'] ?? null,
            'live_url' => $validated['live_url'] ?? null,
            'documentation_url' => $validated['documentation_url'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'data' => $project,
        ], 201);
    }

    /**
     * Display the specified resource by ID or Slug.
     */
    public function show(string $idOrSlug): JsonResponse
    {
        $project = is_numeric($idOrSlug)
            ? Project::find($idOrSlug)
            : Project::where('slug', $idOrSlug)->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $project->id,
            'category' => 'sometimes|required|string|max:100',
            'year' => 'sometimes|required|string|max:10',
            'desc' => 'sometimes|required|string',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable',
            'overview' => 'nullable|string',
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'contribution' => 'nullable|string',
            'tags' => 'nullable',
            'features' => 'nullable',
            'result_headline' => 'nullable|string|max:255',
            'result_summary' => 'nullable|string',
            'result_metrics' => 'nullable',
            'gallery' => 'nullable',
            'github_url' => 'nullable|string|max:500',
            'live_url' => 'nullable|string|max:500',
            'documentation_url' => 'nullable|string|max:500',
        ]);

        if ($request->has('tags')) {
            $validated['tags'] = $this->parseJsonOrArray($request->input('tags'));
        }
        if ($request->has('features')) {
            $validated['features'] = $this->parseJsonOrArray($request->input('features'));
        }
        if ($request->has('result_metrics')) {
            $validated['result_metrics'] = $this->parseJsonOrArray($request->input('result_metrics'));
        }
        if ($request->has('gallery')) {
            $validated['gallery'] = $this->parseJsonOrArray($request->input('gallery'));
        }

        if ($request->hasFile('image')) {
            if ($project->image && str_starts_with($project->image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $project->image);
                Storage::disk('public')->delete($oldPath);
            }

            $stored = $request->file('image')->store('projects', 'public');
            $validated['image'] = '/storage/' . $stored;
        } elseif ($request->has('image') && is_string($request->input('image'))) {
            $validated['image'] = $request->input('image');
        } elseif ($request->boolean('remove_image')) {
            if ($project->image && str_starts_with($project->image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $project->image);
                Storage::disk('public')->delete($oldPath);
            }
            $validated['image'] = null;
        }

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully.',
            'data' => $project,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        if ($project->image && str_starts_with($project->image, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $project->image);
            Storage::disk('public')->delete($oldPath);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.',
        ]);
    }

    /**
     * Upload an image file directly (for drag-and-drop & file manager uploads)
     */
    public function uploadMedia(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|file|image|max:10240', // 10MB max
        ]);

        $file = $request->file('image');
        $stored = $file->store('projects', 'public');
        $url = '/storage/' . $stored;

        return response()->json([
            'success' => true,
            'url' => $url,
            'message' => 'Image uploaded successfully.',
        ]);
    }

    /**
     * Batch delete multiple projects at once
     */
    public function batchDestroy(Request $request): JsonResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:projects,id',
        ]);

        $ids = $request->input('ids');
        $projects = Project::whereIn('id', $ids)->get();

        foreach ($projects as $project) {
            if ($project->image && str_starts_with($project->image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $project->image);
                Storage::disk('public')->delete($oldPath);
            }
            $project->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' projects deleted successfully.',
        ]);
    }

    /**
     * Helper to decode JSON strings or return arrays
     */
    private function parseJsonOrArray(mixed $input): mixed
    {
        if (is_null($input)) return [];
        if (is_array($input)) return $input;
        if (is_string($input)) {
            $decoded = json_decode($input, true);
            if (is_array($decoded)) return $decoded;
            // Fallback for comma separated strings
            return array_values(array_filter(array_map('trim', explode(',', $input))));
        }
        return [];
    }
}
