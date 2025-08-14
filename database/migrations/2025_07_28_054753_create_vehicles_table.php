<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('capacity')->default(0); // kapasitas galon
            $table->decimal('fuel_efficiency', 5, 2)->nullable(); // langsung ada
            $table->decimal('fuel_price', 10, 2)->nullable(); // harga bahan bakar
            $table->float('default_toll_fee')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
