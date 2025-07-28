@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pelanggan</h2>

    <form action="{{ route('customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
        </div>

        <div class="mb-3">
            <label>Jarak (km)</label>
            <input type="number" name="distance_km" class="form-control" step="0.1" value="{{ $customer->distance_km }}">
        </div>

        <div class="mb-3">
            <label>Jenis Galon</label>
            <input type="text" name="gallon_type" class="form-control" value="{{ $customer->gallon_type }}">
        </div>

        <div class="mb-3">
            <label>Harga per Galon</label>
            <input type="number" name="price_per_gallon" class="form-control" step="0.01" value="{{ $customer->price_per_gallon }}">
        </div>

        <div class="mb-3">
            <label>Kendaraan Default</label>
            <select name="default_vehicle_id" class="form-select">
                <option value="">- Pilih Kendaraan -</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $customer->default_vehicle_id == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
