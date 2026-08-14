<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'category' => 'required|string|max:100',
            'year' => 'required|string|max:10',
            'desc' => 'required|string',
            'image' => 'nullable',
            'tags' => 'nullable',
        ]);

        // Process tags (in case sent as JSON string or array in FormData)
        $tags = $request->input('tags');
        if (is_string($tags)) {
            $decoded = json_decode($tags, true);
            $tags = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode(',', $tags)));
        }

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
            'category' => $validated['category'],
            'year' => $validated['year'],
            'desc' => $validated['desc'],
            'image' => $imagePath,
            'tags' => is_array($tags) ? $tags : [],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'data' => $project,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): JsonResponse
    {
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
            'category' => 'sometimes|required|string|max:100',
            'year' => 'sometimes|required|string|max:10',
            'desc' => 'sometimes|required|string',
            'image' => 'nullable',
            'tags' => 'nullable',
        ]);

        if ($request->has('tags')) {
            $tags = $request->input('tags');
            if (is_string($tags)) {
                $decoded = json_decode($tags, true);
                $validated['tags'] = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode(',', $tags)));
            }
        }

        if ($request->hasFile('image')) {
            // Delete old stored image
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
}
