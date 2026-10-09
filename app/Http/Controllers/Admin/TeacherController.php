<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.teachers', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $teacher = new Teacher();

        $teacher->name = $validated['name'];
        $teacher->designation = $validated['designation'] ?? null;
        $teacher->subject = $validated['subject'] ?? null;
        $teacher->phone = $validated['phone'] ?? null;
        $teacher->email = $validated['email'] ?? null;
        $teacher->sort_order = $validated['sort_order'] ?? 0;
        $teacher->is_active = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $filename = 'teacher-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/teachers');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $teacher->photo = 'uploads/teachers/' . $filename;
        }

        $teacher->save();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher added successfully.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teacher-edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $teacher->name = $validated['name'];
        $teacher->designation = $validated['designation'] ?? null;
        $teacher->subject = $validated['subject'] ?? null;
        $teacher->phone = $validated['phone'] ?? null;
        $teacher->email = $validated['email'] ?? null;
        $teacher->sort_order = $validated['sort_order'] ?? 0;
        $teacher->is_active = $request->boolean('is_active');

        if ($request->hasFile('photo')) {

            if ($teacher->photo) {
                $oldPhoto = public_path($teacher->photo);

                if (file_exists($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }

            $file = $request->file('photo');

            $filename = 'teacher-' . time() . '-' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/teachers');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $teacher->photo = 'uploads/teachers/' . $filename;
        }

        $teacher->save();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo) {
            $photoPath = public_path($teacher->photo);

            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
