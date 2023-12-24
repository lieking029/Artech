<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Art;

class VirtualGalleryController extends Controller
{
    public function index()
    {
        $arts = Art::with('user', 'likes')->where('status', 1)->get();
        $categories = Category::all();

        return view('common.virtualGallery', compact('arts', 'categories'));
    }
}
