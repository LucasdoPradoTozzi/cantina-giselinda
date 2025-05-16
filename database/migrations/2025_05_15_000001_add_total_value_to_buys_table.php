<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('buys', function (Blueprint $table) {
            $table->bigInteger('total_value')->default(0)->after('title');
        });
    }

    public function down()
    {
        Schema::table('buys', function (Blueprint $table) {
            $table->dropColumn('total_value');
        });
    }
};
