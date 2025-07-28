@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pelanggan</h2>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jarak (km)</label>
            <input type="number" name="distance_km" class="form-control" step="0.1">
        </div>

        <div class="mb-3">
            <label>Jenis Galon</label>
            <input type="text" name="gallon_type" class="form-control" placeholder="Contoh: Pristine">
        </div>

        <div class="mb-3">
            <label>Harga per Galon</label>
            <input type="number" name="price_per_gallon" class="form-control" step="0.01">
        </div>

        <div class="mb-3">
            <label>Kendaraan Default</label>
            <select name="default_vehicle_id" class="form-select">
                <option value="">- Pilih Kendaraan -</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
