<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
        });
    }

    public function down(): void {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('address')->nullable(false)->change();
        });
    }
};
// This migration alters the 'address' column in the 'customers' table to be nullable.
// The 'down' method reverts this change, making the 'address' column non-nullable again.
// This is useful for maintaining database integrity and ensuring that the application can handle cases where an address may not be provided.
// The 'up' method modifies the column to allow null values, while the 'down' method restores the original state.
// This migration is part of a series of migrations that modify the 'customers' table, including adding a 'phone' column in a previous migration.
// The 'address' column is now optional, allowing for more flexible customer data management.
// This migration is part of a series of migrations that modify the 'customers' table, including adding a 'phone' column in a previous migration.