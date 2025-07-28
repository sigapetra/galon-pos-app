@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pelanggan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Jarak (km)</th>
                <th>Jenis Galon</th>
                <th>Harga/Galon</th>
                <th>Kendaraan Default</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->distance_km }}</td>
                    <td>{{ $customer->gallon_type }}</td>
                    <td>Rp {{ number_format($customer->price_per_gallon, 0, ',', '.') }}</td>
                    <td>{{ optional($customer->vehicle)->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
