<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLikeRequest;

class LikeController extends Controller
{
    public function toggleLike($id)
    {
        // Find all likes by the authenticated user for the specific artwork
        $likes = Like::where('art_id', $id)
            ->where('user_id', auth()->id())
            ->get();

        if ($likes->isNotEmpty()) {
            // Unlike: Delete all likes if they exist
            $likes->each(function ($like) {
                $like->delete();
            });
            $success = false; // Indicate that the likes were removed
        } else {
            // Like: Create a new like with count 1
            Like::create([
                'art_id' => $id,
                'user_id' => auth()->id(),
                'likes' => 1, // Set the likes count to 1 when liked
            ]);
            $success = true; // Indicate that the like was added
        }

        return response()->json(['success' => $success]);
    }
}
