@extends('layouts.app')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Total Penjualan -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Penjualan</h3>
        <p class="text-2xl font-semibold">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
    </div>

    <!-- Total Pelanggan -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Pelanggan</h3>
        <p class="text-2xl font-semibold">{{ number_format($totalCustomers) }}</p>
    </div>

    <!-- Produk Terjual -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Produk Terjual</h3>
        <p class="text-2xl font-semibold">{{ number_format($totalProducts) }}</p>
    </div>

    <!-- Rata-rata Transaksi -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Rata-rata Transaksi</h3>
        <p class="text-2xl font-semibold">Rp {{ number_format($avgTransaction, 0, ',', '.') }}</p>
    </div>

    <!-- Keuntungan Bersih -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Keuntungan Bersih</h3>
        <p class="text-2xl font-semibold">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
    </div>

    <!-- Modal -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Modal Diperlukan</h3>
        <p class="text-2xl font-semibold">Rp {{ number_format($totalCost, 0, ',', '.') }}</p>
    </div>

    <!-- Perbandingan Bulan -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Perbandingan Bulan</h3>
        <p class="text-2xl font-semibold">
            {{ number_format($monthComparison, 2, ',', '.') }}%
            <span class="{{ $monthComparison >= 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $monthComparison >= 0 ? 'Naik' : 'Turun' }}
            </span>
        </p>
    </div>
</div>

<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold">Analisis Penjualan</h2>
    <form method="GET" action="{{ route('dashboard') }}">
        <select name="filter" onchange="this.form.submit()" class="border rounded px-2 py-1">
            <option value="daily" {{ $filter === 'daily' ? 'selected' : '' }}>Harian</option>
            <option value="weekly" {{ $filter === 'weekly' ? 'selected' : '' }}>Mingguan</option>
            <option value="monthly" {{ $filter === 'monthly' ? 'selected' : '' }}>Bulanan</option>
        </select>
    </form>
</div>

<canvas id="monthComparisonChart"></canvas>
@push('scripts')
<canvas id="monthComparisonChart"></canvas>
@extends('layouts.app')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartCanvas = document.getElementById('monthComparisonChart');
    if (chartCanvas) {
        const ctx = chartCanvas.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthLabels),
                datasets: [
                    {
                        label: 'Total Penjualan (Rp)',
                        data: @json($monthSales),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Keuntungan Bersih (Rp)',
                        data: @json($monthProfit),
                        borderColor: '#22c55e',
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Modal (Rp)',
                        data: @json($monthCost),
                        borderColor: '#f97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.2)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
@endpush

