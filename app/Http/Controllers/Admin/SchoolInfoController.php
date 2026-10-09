<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SchoolInfoController extends Controller
{
    /**
     * Show school information.
     */
    public function edit()
    {
        $settings = SiteSetting::first();

        return view('admin.school-info', compact('settings'));
    }

    /**
     * Update school information.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',

            'principal_name' => 'nullable|string|max:255',
            'principal_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'principal_message' => 'nullable|string',

            'facebook_url' => 'nullable|url|max:500',
            'youtube_url' => 'nullable|url|max:500',

            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico,webp|max:1024',
        ]);

        $settings = SiteSetting::first();

        if (!$settings) {
            $settings = new SiteSetting();
        }

        $settings->school_name = $validated['school_name'];
        $settings->address = $validated['address'] ?? null;
        $settings->phone = $validated['phone'] ?? null;
        $settings->email = $validated['email'] ?? null;
        $settings->principal_name = $validated['principal_name'] ?? null;
        $settings->principal_message = $validated['principal_message'] ?? null;
        $settings->facebook_url = $validated['facebook_url'] ?? null;
        $settings->youtube_url = $validated['youtube_url'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | School Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            $file = $request->file('logo');

            $filename = 'school-logo-' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/school'),
                $filename
            );

            $settings->logo = 'uploads/school/' . $filename;
        }


        /*
        |--------------------------------------------------------------------------
        | Principal Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('principal_photo')) {

            $file = $request->file('principal_photo');

            $filename = 'principal-' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/school'),
                $filename
            );

            $settings->principal_photo = 'uploads/school/' . $filename;
        }


        /*
        |--------------------------------------------------------------------------
        | Favicon
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('favicon')) {

            $file = $request->file('favicon');

            $filename = 'favicon-' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/school'),
                $filename
            );

            $settings->favicon = 'uploads/school/' . $filename;
        }

        $settings->save();

        return redirect()
            ->route('admin.school-info.edit')
            ->with('success', 'School information updated successfully.');
    }
}