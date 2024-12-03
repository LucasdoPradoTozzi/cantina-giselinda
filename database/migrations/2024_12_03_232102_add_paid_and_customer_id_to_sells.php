<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Customer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            $table->foreignIdFor(Customer::class)->nullable();
            $table->tinyInteger('paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            //
        });
    }
};
