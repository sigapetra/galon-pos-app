<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('vehicle')->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('customers.create', compact('vehicles'));
    }

    public function store(Request $request)
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

        $defaults = [
            'name' => 'Unknown',
            'address' => '',
            'phone' => '',
        ];

        $data = array_merge($defaults, $validated);

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    public function edit(Customer $customer)
    {
        $vehicles = Vehicle::all();
        return view('customers.edit', compact('customer', 'vehicles'));
    }

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

        $defaults = [
            'name' => 'Unknown',
            'address' => '',
            'phone' => '',
        ];

        $data = array_merge($defaults, $validated);

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }
}
