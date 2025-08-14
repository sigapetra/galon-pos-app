<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function dashboard_updates_after_new_sale()
    {
        // Login user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create product
        $product = Product::factory()->create([
            'name' => 'Galon Air 19L',
            'price' => 15000,
            'stock' => 100,
        ]);

        // Create vehicle
        $vehicle = Vehicle::factory()->create([
            'name' => 'Motor',
            'capacity' => 4,
            'fuel_efficiency' => 40,
            'fuel_price' => 10000,
            'default_toll_fee' => 0,
        ]);

        // Add sale
        Sale::factory()->create([
            'customer_name' => 'Budi',
            'gallons_sold' => 8,
            'price_per_gallon' => 15000,
            'vehicle_id' => $vehicle->id,
            'user_id' => $user->id,
            'product_id' => $product->id,
            'distance_km' => 10,
            'quantity' => 8,
            'price_per_unit' => 15000,
            'total_price' => 8 * 15000,
        ]);

        // Calculate manually
        $jumlah_perjalanan = ceil(8 / $vehicle->capacity);
        $biaya_perjalanan = ($vehicle->fuel_price * (10 / $vehicle->fuel_efficiency)) + $vehicle->default_toll_fee;
        $total_biaya = $jumlah_perjalanan * $biaya_perjalanan;
        $total_pendapatan = 8 * 15000;
        $keuntungan_bersih = $total_pendapatan - $total_biaya;

        // Request dashboard
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        // Verify dashboard data
        $response->assertSee((string) $total_pendapatan);
        $response->assertSee((string) round($keuntungan_bersih, 2));
    }
}
