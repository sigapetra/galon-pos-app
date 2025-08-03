@extends('layouts.app')

@section('title', 'Daftar Kendaraan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Kendaraan</h2>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">+ Tambah Kendaraan</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Efisiensi BBM</th>
            <th>Harga BBM</th>
            <th>Biaya Tol Default</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->name }}</td>
            <td>{{ $vehicle->fuel_efficiency }}</td>
            <td>{{ $vehicle->fuel_price }}</td>
            <td>{{ $vehicle->default_toll_fee }}</td>
            <td>
                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus kendaraan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Belum ada kendaraan</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
