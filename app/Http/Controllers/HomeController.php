<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\User;
use App\Models\Category;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();

        return view('home', compact('categories'));
    }

    public function adminHome()
    {
        $categories = Category::all();
        $artsUploaded = Art::where('status', 1)->count();
        $artsPending = Art::where('status', 0)->count();
        $clients = User::role(UserTypeEnum::Client)->count();

        return view('admin.dashboard', compact('artsUploaded', 'artsPending', 'clients', 'categories'));
    }
    public function aboutUs()
    {
        $categories = Category::all();

        return view('aboutUs.index', compact('categories'));
    }
}
