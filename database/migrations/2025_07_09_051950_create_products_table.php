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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk, misal: "Galon 19 Liter", "Galon 10 Liter"
            $table->text('description')->nullable(); // Deskripsi produk (opsional)
            $table->decimal('price', 10, 2); // Harga produk, misal: 15000.00
            $table->integer('stock')->default(0); // Jumlah stok galon
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
