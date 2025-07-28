<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('address');
        $table->decimal('distance_km', 5, 2);
        $table->string('gallon_type'); // ex: Pristine, Aqua, Le Minerale
        $table->integer('price_per_gallon');
        $table->unsignedBigInteger('default_vehicle_id');
        $table->timestamps();
        $table->foreign('default_vehicle_id')->references('id')->on('vehicles');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
