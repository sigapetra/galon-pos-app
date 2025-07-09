<?php

namespace App\Http\Controllers; // <-- PASTIKAN INI

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest; // Ini akan kita pakai nanti, sekarang biarkan saja
use App\Http\Requests\UpdateProductRequest; // Ini akan kita pakai nanti, sekarang biarkan saja

class ProductController extends Controller // <-- PASTIKAN INI
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // ... dan seterusnya untuk metode show, edit, update, destroy ...
}