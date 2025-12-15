<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.index');
    }

    public function add(Request $request, \App\Models\Product $product)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    if ($product->voorraad < $request->quantity) {
        return back()->with('error', 'Niet genoeg voorraad beschikbaar.');
    }

    $product->voorraad -= $request->quantity;
    $product->save();

    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $request->quantity;
    } else {
        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->naam,
            'price' => $product->prijs,
            'quantity' => $request->quantity,
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Product toegevoegd aan winkelmandje!');
}


}
