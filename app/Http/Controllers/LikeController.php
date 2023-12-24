<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(StoreLikeRequest $request)
    {
        Like::create($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->route('virtual-gallery.index');
    }
}
