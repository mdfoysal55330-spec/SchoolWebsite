<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Show all notices.
     */
    public function index()
    {
        $notices = Notice::orderByDesc('publish_date')
            ->orderByDesc('id')
            ->get();

        return view('admin.notices', compact('notices'));
    }

    /**
     * Store a new notice.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,pdf,link',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'external_url' => 'nullable|url|max:500',
            'publish_date' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $notice = new Notice();

        $notice->title = $validated['title'];
        $notice->type = $validated['type'];
        $notice->publish_date = $validated['publish_date'];
        $notice->is_active = $request->boolean('is_active');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = 'notice-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/notices');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $notice->file_path = 'uploads/notices/' . $filename;
        }

        if ($validated['type'] === 'link') {
            $notice->external_url = $validated['external_url'] ?? null;
        } else {
            $notice->external_url = null;
        }

        $notice->save();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Notice $notice)
    {
        return view('admin.notice-edit', compact('notice'));
    }

    /**
     * Update notice.
     */
    public function update(Request $request, Notice $notice)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:image,pdf,link',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'external_url' => 'nullable|url|max:500',
            'publish_date' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $notice->title = $validated['title'];
        $notice->type = $validated['type'];
        $notice->publish_date = $validated['publish_date'];
        $notice->is_active = $request->boolean('is_active');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = 'notice-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/notices');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $notice->file_path = 'uploads/notices/' . $filename;
        }

        if ($validated['type'] === 'link') {
            $notice->external_url = $validated['external_url'] ?? null;
        } else {
            $notice->external_url = null;
        }

        $notice->save();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice updated successfully.');
    }

    /**
     * Delete notice.
     */
    public function destroy(Notice $notice)
    {
        if ($notice->file_path) {
            $filePath = public_path($notice->file_path);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $notice->delete();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice deleted successfully.');
    }
}