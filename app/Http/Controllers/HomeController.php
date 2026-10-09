<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\CustomLink;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Notice;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\Teacher;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();

        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $customLinks = CustomLink::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $teachers = Teacher::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $notices = Notice::where('is_active', true)
            ->orderByDesc('publish_date')
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $news = News::where('is_active', true)
            ->orderByDesc('publish_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->take(8)
            ->get();

        $pages = Page::where('is_active', true)
            ->orderByDesc('id')
            ->get();

        return view('welcome', compact(
            'settings',
            'banners',
            'customLinks',
            'teachers',
            'notices',
            'news',
            'galleries',
            'pages'
        ));
    }
}
