<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TopUp;
use App\Models\CashOut;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TopUpRequest;
use App\Http\Requests\CashOutRequest;

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

    public function accept($cashoutId)
    {
        $cashout = TopUp::find($cashoutId);

        $amount = $cashout->amount;
        $user = User::find($cashout->user_id);

        $user->wallet += $amount;
        $user->save();

        $cashout->status = 2;
        $cashout->save();

        return redirect()->route('table');
    }

    public function reject($cashoutId)
    {
        $cashout = TopUp::find($cashoutId);

        if ($cashout) {
            $cashout->status = 3;
            $cashout->save();
            alert()->error('Top Up has been rejected');
        }

        return redirect()->route('table');
    }
    public function requestCashOut(CashOutRequest $request)
    {
        $cashOutData = $request->only('cashout', 'number') + ['user_id' => auth()->id(), 'status' => 0];

        $cashOut = CashOut::create($cashOutData);

        return redirect()->route('cashout.table');
    }

    public function cashOutForm()
    {
        $categories = Category::all();
        return view('cashOut.form', compact('categories'));
    }

    public function cashOutTable()
    {
        $cashout = CashOut::with('user')->get();

        $categories = Category::all();

        return view('cashOut.index', compact('categories', 'cashout'));
    }

    public function rejectCashOut(CashOut $cashOut)
    {
        if ($cashOut) {
            $cashOut->status = 3;
            $cashOut->save();
            alert()->error('Cash Out has been rejected');
        }

        return redirect()->route('cashout.table');
    }

    public function acceptCashOut($id)
    {
        $cashout = CashOut::find($id);

        $amount = $cashout->cashout;
        $user = User::find($cashout->user_id);

        if ($user->wallet < $amount) {
            return redirect()->route('cashout.table');
        }

        $user->wallet -= $amount;
        $user->save();

        $cashout->status = 2;
        $cashout->save();

        return redirect()->route('cashout.table');
    }
}
