@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
<h2>Tambah Kendaraan</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
@endif

<form action="{{ route('vehicles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Kendaraan</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="fuel_efficiency" class="form-label">Efisiensi BBM (km/liter)</label>
        <input type="number" step="0.01" name="fuel_efficiency" class="form-control">
    </div>

    <div class="mb-3">
        <label for="fuel_price" class="form-label">Harga BBM per Liter</label>
        <input type="number" step="0.01" name="fuel_price" class="form-control">
    </div>

    <div class="mb-3">
        <label for="default_toll_fee" class="form-label">Biaya Tol Default</label>
        <input type="number" step="0.01" name="default_toll_fee" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
