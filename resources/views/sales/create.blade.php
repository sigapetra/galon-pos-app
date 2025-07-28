@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Input Transaksi Galon</h2>

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label for="customer_id" class="form-label">Tujuan / Pelanggan</label>
            <select name="customer_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->distance_km }} km)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="vehicle_id" class="form-label">Kendaraan</label>
            <select name="vehicle_id" class="form-control" required>
                <option value="">-- Pilih Kendaraan --</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah Galon</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection
