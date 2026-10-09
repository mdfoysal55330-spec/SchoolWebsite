<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PublicPageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.public-page', compact('page'));
    }
}
