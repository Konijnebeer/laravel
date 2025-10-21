<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(Auth::user()->cannot('view-any', 'tags'));
        if (Auth::user()->cannot('view-any', Tag::class)) {
            abort(403);
        }
        $tags = Tag::all();
//        $tags = Tag::with('children.children')
//            ->whereNull('parent_id')
//            ->get();
        return view('tag.tags', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', Tag::class)) {
            abort(403);
        }

        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        if (Auth::user()->cannot('create', Tag::class)) {
            abort(403);
        }

        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $tag = Tag::create($validated);

        return redirect()->route('tags.show', $tag->id)
            ->with('success', 'Tag created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        if (Auth::user()->cannot('view', $tag)) {
            abort(403);
        }

        return view('tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        if (Auth::user()->cannot('update', $tag)) {
            abort(403);
        }

        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        if (Auth::user()->cannot('update', $tag)) {
            abort(403);
        }

        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $tag->update($validated);

        return redirect()->route('tags.show', $tag->id)
            ->with('success', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if (Auth::user()->cannot('delete', $tag)) {
            abort(403);
        }

        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully!');
    }
}
