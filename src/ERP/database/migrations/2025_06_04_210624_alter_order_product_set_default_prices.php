<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->decimal('price_buy', 10, 2)->default(0.00)->change();
            $table->decimal('price_sell', 10, 2)->default(0.00)->change();
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            // Cofnięcie – przywrócenie nullable lub usunięcie defaultu
            $table->decimal('price_buy', 10, 2)->default(null)->change();
            $table->decimal('price_sell', 10, 2)->default(null)->change();
        });
    }
};
