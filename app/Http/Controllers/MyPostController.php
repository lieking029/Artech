<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Art;
use App\Models\Category;

class MyPostController extends Controller
{
    public function index()
    {
        $arts = Art::where('user_id', auth()->id())
            ->with('user', 'likes')
            ->get();
        $categories = Category::all();

        return view('client.myPost.index', compact('arts', 'categories'));
    }

    public function destroy(Art $art)
    {
        $art->delete();

        return redirect()->route('mypost.index');
    }

    public function getArtDetails($id)
    {
        $art = Art::with('category')->find($id);

        return response()->json($art);
    }

    public function update(ArtUpdateRequest $request, Art $art)
    {
        $art->update($request->only('title', 'category_id', 'sale', 'price', 'description') + ['user_id' => auth()->id(), 'status' => 1]);

        if ($request->hasFile('image')) {
            $art->images()->delete();

            foreach ($request->file('image') as $image) {
                $art->images()->create([
                    'image' => $image->store('arts', 'public'),
                ]);
            }
        }

        return redirect()->route('mypost.index');
    }

    public function artSold($id)
    {
        $artSold = Art::find($id); // Fixing the query to find the art by its id

        if ($artSold) {
            $artSold->update(['sale' => 3]);
        }

        return redirect()->route('mypost.index');
    }
}
