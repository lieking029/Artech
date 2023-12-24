<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Art;

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
        return view('home');
    }

    public function adminHome()
    {
        $artsUploaded = Art::where('status', 1)->count();
        $artsPending = Art::where('status', 0)->count();
        $clients = User::role(UserTypeEnum::Client)->count();

        return view('admin.dashboard', compact('artsUploaded', 'artsPending', 'clients'));
    }
}
