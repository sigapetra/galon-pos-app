@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Transaksi</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Pelanggan</label>
            <select name="customer_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Kendaraan</label>
            <select name="vehicle_id" class="w-full border rounded p-2">
                <option value="">-- Pilih Kendaraan --</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Jumlah</label>
            <input type="number" name="quantity" class="w-full border rounded p-2" min="1">
        </div>

        <div>
            <label class="block">Harga Satuan</label>
            <input type="number" name="price_per_item" class="w-full border rounded p-2" min="0">
        </div>

        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('sales.index') }}" class="ml-2 text-gray-500">Batal</a>
        </div>
    </form>
</div>
@endsection
