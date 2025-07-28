<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Menampilkan daftar pelanggan
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // Menampilkan form tambah pelanggan
    public function create()
    {
        return view('customers.create');
    }

    // Menyimpan data pelanggan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    // Menampilkan form edit pelanggan
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Menyimpan perubahan data pelanggan
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'distance_km' => 'nullable|numeric|min:0',
            'gallon_type' => 'nullable|string|max:50',
            'price_per_gallon' => 'nullable|numeric|min:0',
            'default_vehicle_id' => 'nullable|exists:vehicles,id',
            'phone' => 'nullable|string|max:20',
        ]);

        // Default values
        $defaults = [
            'name' => 'Unknown',
            'address' => '',
            'phone' => '',
            'gallon_type' => 'Pristine',
            'price_per_gallon' => 0,
            'distance_km' => 0,
            'default_vehicle_id' => null,
        ];

        // Merge default values
        $validated = array_merge($defaults, $validated);

        // Clean up
        $validated['name'] = trim($validated['name']);
        $validated['address'] = trim($validated['address']);
        $validated['phone'] = trim($validated['phone']);
        $validated['gallon_type'] = trim($validated['gallon_type']);
        $validated['price_per_gallon'] = round($validated['price_per_gallon'], 2);
        $validated['distance_km'] = round($validated['distance_km'], 2);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

// Menghapus pelanggan
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}