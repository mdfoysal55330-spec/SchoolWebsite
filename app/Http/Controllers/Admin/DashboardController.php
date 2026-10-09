<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $noticeCount = Notice::where('is_active', true)->count();

        $teacherCount = Teacher::where('is_active', true)->count();

        $galleryCount = Gallery::where('is_active', true)->count();

        $pageCount = Page::where('is_active', true)->count();

        return view('pages.admin', compact(
            'noticeCount',
            'teacherCount',
            'galleryCount',
            'pageCount'
        ));
    }
}