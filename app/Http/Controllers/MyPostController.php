<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Art;
use App\Models\Category;

class MyPostController extends Controller
{
    public function index()
    {
        $arts = Art::where('user_id', auth()->id())->with('user', 'likes')->get();
        $categories = Category::all();

        return view('client.myPost.index', compact('arts', 'categories'));
    }
}
