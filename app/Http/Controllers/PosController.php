<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PosController extends Controller
{
    public function index()
    {
        // Show the POS interface
        return view('pos.index');
    }

    public function products(Request $request)
    {
        $products = Product::query();

        if ($request->has('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        return view('pos.products', [
            'products' => $products->get()
        ]);
    }
}
