<?php
// database/migrations/2025_06_05_000000_create_order_product_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Uruchomienie migracji:
     * Tworzymy tabelę pivotową 'order_product':
     * - quantity domyślnie 1,
     * - price_buy i price_sell domyślnie 0.00 (żeby baza nie wymagała jawnego wypełnienia),
     * - klucze obce do tabel 'orders' i 'products',
     * - cascade on delete, żeby usunięcie zamówienia/prod usuwało powiązania.
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();

            // Klucz obcy do tabeli 'orders'
            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');

            // Klucz obcy do tabeli 'products'
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            // Ilość produktu w zamówieniu (domyślnie 1)
            $table->integer('quantity')->default(1);

            // Cena zakupu (domyślnie 0.00)
            $table->decimal('price_buy', 10, 2)->default(0.00);

            // Cena sprzedaży (domyślnie 0.00)
            $table->decimal('price_sell', 10, 2)->default(0.00);

            $table->timestamps();
        });
    }

    /**
     * Cofnięcie migracji:
     * Usuwamy tabelę 'order_product'.
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
