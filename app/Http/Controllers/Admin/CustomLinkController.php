<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomLink;
use Illuminate\Http\Request;

class CustomLinkController extends Controller
{
    public function index()
    {
        $links = CustomLink::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.custom-links', compact('links'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'open_in_new_tab' => 'nullable|boolean',
        ]);

        $link = new CustomLink();

        $link->name = $validated['name'];
        $link->url = $validated['url'];
        $link->icon = $validated['icon'] ?? null;
        $link->sort_order = $validated['sort_order'] ?? 0;
        $link->is_active = $request->boolean('is_active');
        $link->open_in_new_tab = $request->boolean('open_in_new_tab');

        $link->save();

        return redirect()
            ->route('admin.custom-links.index')
            ->with('success', 'Custom link added successfully.');
    }

    public function edit(CustomLink $customLink)
    {
        return view('admin.custom-link-edit', compact('customLink'));
    }

    public function update(Request $request, CustomLink $customLink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'open_in_new_tab' => 'nullable|boolean',
        ]);

        $customLink->name = $validated['name'];
        $customLink->url = $validated['url'];
        $customLink->icon = $validated['icon'] ?? null;
        $customLink->sort_order = $validated['sort_order'] ?? 0;
        $customLink->is_active = $request->boolean('is_active');
        $customLink->open_in_new_tab = $request->boolean('open_in_new_tab');

        $customLink->save();

        return redirect()
            ->route('admin.custom-links.index')
            ->with('success', 'Custom link updated successfully.');
    }

    public function destroy(CustomLink $customLink)
    {
        $customLink->delete();

        return redirect()
            ->route('admin.custom-links.index')
            ->with('success', 'Custom link deleted successfully.');
    }
}
