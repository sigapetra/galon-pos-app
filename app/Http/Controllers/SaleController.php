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
            $customers = Customer::all();
            $vehicles = Vehicle::all();
            return view('sales.create', compact('customers', 'vehicles'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'gallon_qty' => 'required|integer|min:1',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $vehicle  = Vehicle::findOrFail($request->vehicle_id);
        $qty      = $request->gallon_qty;

        // Harga galon dari pelanggan
        $price_per_gallon = $customer->price_per_gallon ?? 0;
        $jarak            = $customer->distance_km ?? 0;

        // Hitung biaya BBM
        $fuel_needed = $jarak / $vehicle->fuel_efficiency;
        $fuel_cost   = $fuel_needed * $vehicle->fuel_price;

        // Total harga = galon + biaya operasional
        $total = ($price_per_gallon * $qty) + $fuel_cost + $vehicle->default_toll_fee;

        Sale::create([
            'customer_id'  => $request->customer_id,
            'vehicle_id'   => $request->vehicle_id,
            'gallon_qty'   => $qty,
            'total_price'  => (int) $total,
        ]);

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil!');
    }


    /**
     * Search for sales based on customer name, product name, or sale ID.
     */

    public function search(Request $request)
    {
        $query = $request->input('query');

        $sales = Sale::with(['customer', 'product', 'vehicle'])
            ->where('id', 'like', "%$query%")
            ->orWhereHas('customer', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('product', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->get();

        return view('sales.index', compact('sales'));
    }
    /**
     * Generate a sales report.
     */
    public function report(Request $request)
    {
        $sales = Sale::with(['customer', 'vehicle', 'product'])
            ->when($request->has('start_date'), function ($query) use ($request) {
                $query->whereDate('date', '>=', $request->input('start_date'));
            })
            ->when($request->has('end_date'), function ($query) use ($request) {
                $query->whereDate('date', '<=', $request->input('end_date'));
            })
            ->get();

        return view('sales.report', compact('sales'));
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
