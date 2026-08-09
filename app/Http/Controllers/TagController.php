<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tags = Tag::whereNull('deleted_at')->get();

        return response()->json([
            'success' => true,
            'data' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request): JsonResponse
    {
        $tag = Tag::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully.',
            'data' => $tag
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): JsonResponse
    {
        if ($tag->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'The tag is not available.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateTagRequest $request,
        Tag $tag
    ): JsonResponse {

        if ($tag->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'A deleted tag cannot be updated.'
            ], 404);
        }

        $tag->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully.',
            'data' => $tag->fresh()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): JsonResponse
    {
        if ($tag->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'This tag has already been removed.'
            ], 404);
        }

        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully.'
        ]);
    }
}
