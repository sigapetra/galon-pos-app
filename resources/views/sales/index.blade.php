<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($sales->count())
                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Jenis Galon</th>
                            <th>Kendaraan</th>
                            <th>Jumlah</th>
                            <th>Profit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->date }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->product->name ?? '-' }}</td>
                                <td>{{ $sale->vehicle->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>Rp {{ number_format($sale->profit, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada transaksi dicatat.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('sales.create') }}" class="btn btn-primary">Input Transaksi Baru</a>
            </div>
        </div>
    </div>
</x-app-layout>
