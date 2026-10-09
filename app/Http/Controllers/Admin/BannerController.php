<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Show all banners.
     */
    public function index()
    {
        $banners = Banner::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.banners', compact('banners'));
    }

    /**
     * Store a new banner.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $banner = new Banner();

        $banner->title = $validated['title'] ?? null;
        $banner->subtitle = $validated['subtitle'] ?? null;
        $banner->sort_order = $validated['sort_order'] ?? 0;
        $banner->is_active = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = 'banner-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/banners');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner-edit', compact('banner'));
    }

    /**
     * Update banner.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $banner->title = $validated['title'] ?? null;
        $banner->subtitle = $validated['subtitle'] ?? null;
        $banner->sort_order = $validated['sort_order'] ?? 0;
        $banner->is_active = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = 'banner-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/banners');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Delete banner.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            $imagePath = public_path($banner->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}