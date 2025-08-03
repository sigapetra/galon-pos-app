@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Input Transaksi Galon</h2>

    <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
        @csrf

        <div>
            <label>Pelanggan</label>
            <select name="customer_id" id="customerSelect" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}"
                        data-distance="{{ $customer->distance_km }}"
                        data-price="{{ $customer->price_per_gallon }}">
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Kendaraan</label>
            <select name="vehicle_id" id="vehicleSelect" required>
                <option value="">-- Pilih Kendaraan --</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}"
                        data-efficiency="{{ $vehicle->fuel_efficiency }}"
                        data-fuelprice="{{ $vehicle->fuel_price }}"
                        data-toll="{{ $vehicle->default_toll_fee }}">
                        {{ $vehicle->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Jumlah Galon</label>
            <input type="number" name="gallon_qty" id="gallonQty" min="1" required>
        </div>

        <hr>
        <h4>Rincian Perhitungan</h4>
        <div>Harga per Galon: Rp <span id="pricePerGallon">-</span></div>
        <div>Jarak (km): <span id="distanceKm">-</span></div>
        <div>Efisiensi Kendaraan: <span id="efficiency">-</span> km/liter</div>
        <div>Harga BBM: Rp <span id="fuelPrice">-</span> /liter</div>
        <div>Biaya BBM: Rp <span id="fuelCost">-</span></div>
        <div>Biaya Tol: Rp <span id="tollFee">-</span></div>
        <div><strong>Total Estimasi Harga: Rp <span id="totalCost">-</span></strong></div>

        <button type="submit">Simpan</button>
    </form>
</div>

<script>
    const customerSelect = document.getElementById('customerSelect');
    const vehicleSelect = document.getElementById('vehicleSelect');
    const gallonQtyInput = document.getElementById('gallonQty');

    function formatRupiah(num) {
        return parseInt(num).toLocaleString('id-ID');
    }

    function calculateTotal() {
        const customer = customerSelect.options[customerSelect.selectedIndex];
        const vehicle  = vehicleSelect.options[vehicleSelect.selectedIndex];
        const qty      = parseInt(gallonQtyInput.value) || 0;

        if (!customer || !vehicle || !qty) return;

        const distance = parseFloat(customer.dataset.distance || 0);
        const pricePerGallon = parseFloat(customer.dataset.price || 0);
        const efficiency = parseFloat(vehicle.dataset.efficiency || 1);
        const fuelPrice = parseFloat(vehicle.dataset.fuelprice || 0);
        const tollFee = parseFloat(vehicle.dataset.toll || 0);

        const fuelNeeded = distance / efficiency;
        const fuelCost = fuelNeeded * fuelPrice;

        const total = (pricePerGallon * qty) + fuelCost + tollFee;

        document.getElementById('pricePerGallon').innerText = formatRupiah(pricePerGallon);
        document.getElementById('distanceKm').innerText = distance;
        document.getElementById('efficiency').innerText = efficiency;
        document.getElementById('fuelPrice').innerText = formatRupiah(fuelPrice);
        document.getElementById('fuelCost').innerText = formatRupiah(fuelCost.toFixed(0));
        document.getElementById('tollFee').innerText = formatRupiah(tollFee);
        document.getElementById('totalCost').innerText = formatRupiah(total.toFixed(0));
    }

    customerSelect.addEventListener('change', calculateTotal);
    vehicleSelect.addEventListener('change', calculateTotal);
    gallonQtyInput.addEventListener('input', calculateTotal);
</script>
@endsection
