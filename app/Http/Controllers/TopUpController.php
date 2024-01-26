<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TopUp;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TopUpRequest;

class TopUpController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('topUp.index', compact('categories'));
    }

    public function store(TopUpRequest $request)
    {
        $topUpData = $request->only('amount') + ['user_id' => auth()->id(), 'status' => 0];

        if ($request->hasFile('image')) {
            $topUpData['image'] = $request->file('image')->store('topUps', 'public');
        }

        $topUp = TopUp::create($topUpData);

        alert()->success('Top Up has been submitted');

        return redirect()->route('home');
    }

    public function table()
    {
        $categories = Category::all();
        $topUps = TopUp::where('status', 0)->get();

        return view('topUp.table', compact('topUps', 'categories'));
    }

    public function accept($topUpId)
    {
        $topUp = TopUp::find($topUpId);

        $amount = $topUp->amount;
        $user = User::find($topUp->user_id);

        $user->wallet += $amount;
        $user->save();

        $topUp->delete();

        return redirect()->route('table');
    }

    public function reject($topUpId)
    {
        $topUp = TopUp::find($topUpId);

        if ($topUp) {
            $topUp->delete();
            alert()->error('Top Up has been rejected');
        }

        return redirect()->route('table');
    }
}
