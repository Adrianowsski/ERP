<?php
// database/migrations/2025_06_05_000001_add_order_number_to_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Uruchomienie migracji:
     * Dodajemy do tabeli 'orders' kolumnę 'order_number' (unikalna, nullable),
     * aby móc przypisywać każde zamówienie do czytelnej etykiety.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')
                ->after('id')
                ->unique()
                ->nullable();
        });
    }

    /**
     * Cofnięcie migracji:
     * Usuwamy kolumnę 'order_number' z tabeli 'orders'.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_number');
        });
    }
};
