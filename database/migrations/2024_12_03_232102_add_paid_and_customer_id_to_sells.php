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
            $table->foreignIdFor(Customer::class)->nullable()->constrained();
            $table->integer('sale_value')->nullable();
            $table->integer('paid_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            $table->dropForeign(['customer_id']); // Se a chave estrangeira foi criada com o nome 'customer_id'
            $table->dropColumn('customer_id');
            $table->dropColumn('sale_value');
            $table->dropColumn('paid_value');
        });
    }
};
