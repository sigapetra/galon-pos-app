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
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('fuel_efficiency', 5, 2); // km per liter
        $table->integer('fuel_price'); // harga per liter
        $table->integer('default_toll_fee')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vechicels');
    }
};
