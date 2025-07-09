<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang mencatat penjualan
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk apa yang dijual
            $table->integer('quantity'); // Jumlah galon yang terjual
            $table->decimal('price_per_unit', 10, 2); // Harga per unit saat penjualan terjadi
            $table->decimal('total_price', 10, 2); // Total harga penjualan (quantity * price_per_unit)
            $table->string('customer_name')->nullable(); // Nama pelanggan (opsional)
            $table->string('customer_address')->nullable(); // Alamat pelanggan (opsional, untuk pengantaran)
            $table->string('payment_method')->nullable(); // Metode pembayaran (misal: "Cash", "Transfer")
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
