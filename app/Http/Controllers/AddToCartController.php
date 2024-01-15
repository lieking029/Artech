<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $carts = Cart::where('user_id', auth()->id())->with('art', 'user')->get();

        return view('cart.index', compact('carts', 'categories'));
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
    public function addToCart($id)
    {
        // Check if the item already exists in the cart for the authenticated user
        $cartItem = Cart::where('art_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($cartItem) {
            // If the item already exists in the cart, delete it
            $cartItem->delete();
            $success = false; // Indicate that the item was removed from the cart
        } else {
            // Add the item to the cart for the authenticated user
            Cart::create([
                'art_id' => $id,
                'user_id' => auth()->id(),
            ]);
            $success = true; // Indicate that the item was added to the cart
        }

        return response()->json(['success' => $success]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index');
    }
}
