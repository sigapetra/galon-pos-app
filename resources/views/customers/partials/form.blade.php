<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Alamat</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $customer->address ?? '') }}">
</div>

<div class="mb-3">
    <label>No. Telepon</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}">
</div>

<div class="mb-3">
    <label>Jarak (km)</label>
    <input type="number" step="0.01" name="distance_km" class="form-control" value="{{ old('distance_km', $customer->distance_km ?? 0) }}">
</div>

<div class="mb-3">
    <label>Jenis Galon</label>
    <input type="text" name="gallon_type" class="form-control" value="{{ old('gallon_type', $customer->gallon_type ?? 'Pristine') }}">
</div>

<div class="mb-3">
    <label>Harga per Galon</label>
    <input type="number" step="100" name="price_per_gallon" class="form-control" value="{{ old('price_per_gallon', $customer->price_per_gallon ?? 0) }}">
</div>

<div class="mb-3">
    <label>Kendaraan Default</label>
    <select name="default_vehicle_id" class="form-control">
        <option value="">-- Pilih Kendaraan --</option>
        @foreach ($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}"
                {{ old('default_vehicle_id', $customer->default_vehicle_id ?? '') == $vehicle->id ? 'selected' : '' }}>
                {{ $vehicle->name }}
            </option>
        @endforeach
    </select>
</div>
