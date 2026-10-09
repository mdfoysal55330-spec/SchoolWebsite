<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $gallery = new Gallery();

        $gallery->title = $validated['title'] ?? null;
        $gallery->sort_order = $validated['sort_order'] ?? 0;
        $gallery->is_active = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = 'gallery-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/gallery');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $gallery->image = 'uploads/gallery/' . $filename;
        }

        $gallery->save();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery image added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery-edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $gallery->title = $validated['title'] ?? null;
        $gallery->sort_order = $validated['sort_order'] ?? 0;
        $gallery->is_active = $request->boolean('is_active');

        if ($request->hasFile('image')) {

            if ($gallery->image) {
                $oldImage = public_path($gallery->image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $file = $request->file('image');

            $filename = 'gallery-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/gallery');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $gallery->image = 'uploads/gallery/' . $filename;
        }

        $gallery->save();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            $imagePath = public_path($gallery->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery image deleted successfully.');
    }
}
