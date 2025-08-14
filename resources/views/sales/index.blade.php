@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Transaksi</h1>
        <a href="{{ route('sales.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Transaksi</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-left border">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Pelanggan</th>
                    <th class="px-4 py-2 border">Kendaraan</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Harga Satuan</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $sale->customer->name }}</td>
                    <td class="px-4 py-2 border">{{ $sale->vehicle->name }}</td>
                    <td class="px-4 py-2 border">{{ $sale->quantity }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($sale->price_per_item, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $sale->created_at->format('d-m-Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $sales->links() }}
    </div>
</div>
@endsection
