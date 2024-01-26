<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\Cart;
use App\Models\Category;
use App\Models\OwnedArt;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Adyen\Model\Checkout\Amount;
use Adyen\Service\Checkout\PaymentsApi;
use Illuminate\Support\Facades\Session;
use Adyen\Model\Checkout\PaymentRequest;
use Adyen\Model\Checkout\CheckoutPaymentMethod;
use RealRashid\SweetAlert\Facades\Alert;

class AddToCartController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $carts = Cart::where('user_id', auth()->id())
            ->with('art', 'user')
            ->whereHas('art', function ($query) {
                $query->where('sale', 1);
            })
            ->get();

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
    public function checkout($id)
    {
        $categories = Category::all();

        $cart = Cart::with('art')->find($id);

        return view('cart.checkout', compact('categories', 'cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function payment()
    {
        $client = new \Adyen\Client();
        $client->setApplicationName('Test Application');
        $client->setEnvironment(\Adyen\Environment::TEST);
        $client->setXApiKey('AQEhhmfuXNWTK0Qc+iSRoFAdhMwmm6BIO8Yk1jgQiSrw2vrNEMFdWw2+5HzctViMSCJMYAc=-vG+TJD3aO/hlNKimdfu0dgotbELJfwSS0Ye1b035sEs=-7Z>QkmfJ3ECnJS[5');

        // Use the Checkout service for payments
        $service = new \Adyen\Service\Checkout($client);

        $paymentRequest = new PaymentRequest();
        $amount = new Amount(); // Create an instance of Amount
        $amount->setCurrency('PHP');
        $amount->setValue(10);
        $paymentRequest->setAmount($amount);

        $paymentRequest->setReference('asd1231asdasd');

        // Create an instance of CheckoutPaymentMethod
        $checkoutPaymentMethod = new CheckoutPaymentMethod();
        $checkoutPaymentMethod->setType('gcash');
        $checkoutPaymentMethod->setNumber('09770835318');
        $paymentRequest->setPaymentMethod($checkoutPaymentMethod);

        $paymentRequest->setShopperInteraction('Ecommerce');
        $paymentRequest->setRecurringProcessingModel('CardOnFile');
        $paymentRequest->setShopperReference('YOUR_SHOPPER_REFERENCE');
        $paymentRequest->setReturnUrl('https://your-company.com/checkout?shopperOrder=12xy..');
        $paymentRequest->setMerchantAccount('ARTECHECOM');
        // Call the payments method with the PaymentRequest object

        $result = $service->payments($paymentRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function buyProduct($id)
    {
        $art = Art::find($id);
        $user = auth()->user();

        if ($art && $user) {
            $price = $art->price;

            if ($user->wallet >= $price) {
                // Sufficient funds, proceed with the purchase
                $user->wallet -= $price;
                $user->save();

                OwnedArt::create([
                    'user_id' => $user->id,
                    'art_id' => $art->id,
                ]);

                $art->sale = 3;
                $art->save();
                $art->user->wallet += $price;
                $art->user->save();

                // Use SweetAlert to display success message
            }
        }

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index');
    }

    public function ownedArt($id)
    {
        $categories = Category::all();
        $ownedArts = OwnedArt::where('user_id', $id)
            ->with('art')
            ->get();

        return view('cart.ownedArt', compact('ownedArts', 'categories'));
    }
}
