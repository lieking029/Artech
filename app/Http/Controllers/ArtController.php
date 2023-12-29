<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtRequest;
use App\Models\Art;
use App\Models\ArtImage;
use Illuminate\Http\Request;

class ArtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arts = Art::where('status', 0)->get();

        return view('admin.artPrompt.pending', compact('arts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtRequest $request)
    {
        $art = Art::create($request->only('title', 'category_id', 'sale', 'price', 'description') + ['user_id' => auth()->id(), 'status' => 0]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                ArtImage::create([
                    'art_id' => $art->id,
                    'image' => $image->store('arts', 'public'),
                ]);
            }
        }

        return redirect()->route('home');
    }

    public function adminStore(StoreArtRequest $request)
    {
        Art::create($request->only('title', 'category_id') + ['user_id' => auth()->id(), 'image' => $request->file('image')->store('arts', 'public'), 'status' => 1]);

        return redirect()->route('virtual-gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Art $art)
    {
        $art->load('artImages', 'user');

        return response()->json($art);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Art $art)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Art $art)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Art $art)
    {
        $art->delete();

        return redirect()->route('virtual-gallery.index');
    }

    public function approved(Art $art)
    {
        $art->update(['status' => 1]);

        return redirect()->route('art.index');
    }

    public function disapproved(Art $art)
    {
        $art->update(['status' => 3]);

        return redirect()->route('art.index');
    }
}
