<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = \App\Models\Sale::with(['customer', 'vehicle', 'product', 'user'])
                    ->orderBy('date', 'desc')
                    ->get();

        return view('sales.index', compact('sales'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = \App\Models\Customer::all();
        $vehicles = \App\Models\Vehicle::all();

        return view('sales.create', compact('customers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customer = \App\Models\Customer::findOrFail($request->customer_id);
        $vehicle = \App\Models\Vehicle::findOrFail($request->vehicle_id);

        $distance = $customer->distance_km;
        $fuel_used = $distance * 2 / $vehicle->fuel_efficiency;
        $fuel_cost = round($fuel_used * $vehicle->fuel_price);
        $toll = $vehicle->default_toll_fee;

        $total_revenue = $request->quantity * $customer->price_per_gallon;
        $product = \App\Models\Product::where('name', $customer->gallon_type)->first();
        $total_cost = $request->quantity * ($product->cost_price ?? 0);
        $profit = $total_revenue - $total_cost - $fuel_cost - $toll;

        \App\Models\Sale::create([
            'user_id' => Auth::id(), // <- ID user yang sedang login
            'product_id' => $product->id ?? null, // <- relasi ke tabel product
            'date' => $request->date,
            'customer_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'quantity' => $request->quantity,
            'total_revenue' => $total_revenue,
            'total_cost' => $total_cost,
            'fuel_cost' => $fuel_cost,
            'toll_fee' => $toll,
            'profit' => $profit,
            'note' => null,
        ]);

        return redirect()->route('sales.create')->with('success', 'Transaksi berhasil dicatat!');
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
    public function destroy(string $id)
    {
        //
    }
}
