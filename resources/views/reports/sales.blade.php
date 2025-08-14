<h2>Laporan Penjualan</h2>
<p><strong>Total Penjualan:</strong> Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
<p><strong>Total Modal:</strong> Rp {{ number_format($totalCost, 0, ',', '.') }}</p>
<p><strong>Keuntungan Bersih:</strong> Rp {{ number_format($netProfit, 0, ',', '.') }}</p>

<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Produk</th>
            <th>Kendaraan</th>
            <th>Qty</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $index => $sale)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $sale->created_at->format('d-m-Y') }}</td>
            <td>{{ $sale->customer->name ?? '-' }}</td>
            <td>{{ $sale->product->name ?? '-' }}</td>
            <td>{{ $sale->vehicle->name ?? '-' }}</td>
            <td>{{ $sale->quantity }}</td>
            <td>Rp {{ number_format($sale->price_per_item, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
