<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderByDesc('id')->get();

        return view('admin.pages', compact('pages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $page = new Page();

        $page->title = $validated['title'];
        $page->slug = Str::slug($validated['title']);
        $page->content = $validated['content'] ?? null;
        $page->is_active = $request->boolean('is_active');

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');

            $filename = 'page-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/pages');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $page->featured_image = 'uploads/pages/' . $filename;
        }

        $page->save();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page added successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.page-edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $page->title = $validated['title'];
        $page->slug = Str::slug($validated['title']);
        $page->content = $validated['content'] ?? null;
        $page->is_active = $request->boolean('is_active');

        if ($request->hasFile('featured_image')) {

            if ($page->featured_image) {
                $oldImage = public_path($page->featured_image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $file = $request->file('featured_image');

            $filename = 'page-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/pages');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $page->featured_image = 'uploads/pages/' . $filename;
        }

        $page->save();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        if ($page->featured_image) {
            $imagePath = public_path($page->featured_image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
