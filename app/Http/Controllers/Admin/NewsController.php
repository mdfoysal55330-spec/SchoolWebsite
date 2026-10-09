<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderByDesc('publish_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.news', compact('news'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'publish_date' => 'required|date',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $item = new News();

        $item->title = $validated['title'];
        $item->description = $validated['description'] ?? null;
        $item->publish_date = $validated['publish_date'];
        $item->sort_order = $validated['sort_order'] ?? 0;
        $item->is_active = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = 'news-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/news');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $item->image = 'uploads/news/' . $filename;
        }

        $item->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News added successfully.');
    }

    public function edit(News $news)
    {
        return view('admin.news-edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'publish_date' => 'required|date',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $news->title = $validated['title'];
        $news->description = $validated['description'] ?? null;
        $news->publish_date = $validated['publish_date'];
        $news->sort_order = $validated['sort_order'] ?? 0;
        $news->is_active = $request->boolean('is_active');

        if ($request->hasFile('image')) {

            if ($news->image) {
                $oldImage = public_path($news->image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $file = $request->file('image');

            $filename = 'news-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/news');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $news->image = 'uploads/news/' . $filename;
        }

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            $imagePath = public_path($news->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }
}
